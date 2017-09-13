<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shop;
use App\ShopCats;
use App\Rate;
use App\GC;
use Validator;

class ShopController extends Controller
{
    public function index() {
        $cats = ShopCats::get();
        return view('shop.index')->with(['cats' => $cats]);
    }
    public function index_wCat($cat) {
        $cats = ShopCats::get();
        $items = Shop::where('nCat', $cat)->where('nEnabled', 1)->paginate(10);
        return view('shop.cat')->with(['items' => $items, 'cats' => $cats, 'currentCat' => $cat]);
    }
    public function buy($item) {
        $item = Shop::where('nEnabled', 1)->where('nID', $item)->first();
        return view('shop.buyitem')->with(['item' => $item]);
    }
    public function buy_post(Request $r) {
        $this->validate($r, [
            'itemid' => 'required|exists:mssql_mall.tItems,nID'
        ]);

    }
    public function generateCode(Request $r, $uniq = null) {
        \Log::debug("New Request on GenCode Page from {$r->ip()}");
        if($uniq == null || ($uniq != null && !in_array($uniq, config('fiesta.shop.uniqKey')))) {
            abort(404, "$uniq is not a valid Secret!");
        }
        //\Log::debug("UNIQ($uniq) :: ".json_encode($r->all()));
        if($r->has(['webhook_type', 'email', 'id', 'value', 'gateway', 'ip_address']) && $r->input('webhook_type') == "3") {
            $newcode = strtoupper(str_random(5)."-".str_random(5)."-".str_random(5)."-".str_random(5));
            $gc = GC::create([
                'giftcard' => str_replace("-", "", $newcode),
                'sellyID' => $r->input('id'),
                'email' => $r->input('email'),
                'price' => ceil(floatval($r->input('value'))),
                'enabled' => 1,
                'gateway' => $r->input('gateway'),
                'ip' => $r->input('ip_address')
            ]);
            return response("Your GiftCard Code: \"{$newcode}\", you can redeem it under your Profile.\nRegards,\nYour Pephix Team");
        } else {
            return abort(404);
        }
    }
    public function rate() {
        $rates = Rate::get();
        $base = intval(config('fiesta.currency.base', 100));
        $base = $base <= 50 ? 100 : $base;
        return view('shop.rates')->with(['rates' => $rates, 'base' => $base]);
    }

    public function redeemCard(Request $r) {
        $validator=Validator::make($r->all(), [
            'code' => 'required|min:23|max:23'
        ]);

        if($r->has('code')) {
            $code = GC::where('giftcard', trim(strtoupper(str_replace('-', '', $r->input('code')))))->first();
        }
        if(!$validator->fails() && count($code) > 0) {
            $user = \Auth::user();
            $coins = $this->getCoins($code);
            $user->nCoins += $coins;
            if($user->nCoins >= 0) {
                $code->usedby = $user->nEMID;
                $user->save();
                $code->save();
                return redirect()->back()->with(['message' => "{$coins} Coins has been added successfully to your Account.", 'error' => false]);
            } else {
                return redirect()->back()->with(['message' => 'Something wrong happened, contact the Support!', 'error' => true]);
            }
        } else {
            return redirect()->back()->with(['message' => 'Make sure your Code\'s length is 20. Otherwise this Code has already been used or could not be found.', 'error' => true]);
        }
    }
    private function getCoins($code) {
        $rate = Rate::orderBy('amount', 'desc')->where('amount', '<=', $code->price)->first();
        $base = intval(config('fiesta.currency.base', 100));
        $base = $base <= 50 ? 100 : $base;
        return (($base*$rate->amount)*((100-$rate->bonusPercentage) / 100));
    }
}
