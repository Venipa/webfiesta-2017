<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shop;
use App\ShopCats;

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
    private $allowed_uniq = ["Vji9vcA2AGdPxFXSKCYL", "LwRDDuKUlpqyVn17SYBZ", "fvHt9ewNu4UcKvZN7pa0"];
    public function generateCode($uniq, Request $r) {
        if($uniq == null && ($uniq != null && !in_array($uniq, $allowed_uniq))) {
            abort(404);
        }
        if($r->has('webhook_type') && $r->input('webhook_type') == "3" && $r->has('id') && $r->has('email') && $r->has('value')) {
            $gc = GiftCard::create([
                'giftcard' => strtoupper(str_random(20)),
                'sellyID' => $r->input('id'),
                'email' => $r->input('email'),
                'price' => ceil(floatval($r->input('value'))),
                'enabled' => 1
            ]);
            return response("Your GiftCard Code: \"{$gc->giftcard}\", you can redeem it under your Profile.\nRegards,\nYour Pephix Team");
        } else {
            abort(404);
        }
    }
    public function rate() {
        $rates = Web::table('dbo.rate', false)->get();
        $base = intval(Web::getSetting("mall:currency:base", false));
        $base = $base <= 50 ? 100 : $base;
        return view('shop.rates')->with(['rates' => $rates, 'base' => $base]);
    }

    public function redeemCode(Request $r) {
        $validator=Validator::make($r->all(), [
            'code' => 'required|min:20|max:20'
        ]);

        if($r->has('code')) {
            $code = GiftCard::where('giftcard', trim(strtoupper($r->input('code'))))->first();
        }
        if(!$validator->fails() && count($code) > 0) {
            $user = \Auth::user();
            $coins = $this->getCoins($code);
            $user->nCoins += $coins;
            if($user->nCoins >= 0) {
                $code->usedby = $user->nEMID;
                $user->save();
                $code->save();
                return response()->json(['message' => "{$coins} Coins has been added successfully to your Account."],200);
            } else {
                return response()->json(['message' => 'Something wrong happened, contact the Support!'],406);
            }
        } else {
            return response()->json(['message' => 'Make sure your Code\'s length is 20. Otherwise this Code has already been used or could not be found.'],406);
        }
    }
    private function getCoins($code) {
        $rate = Web::table('dbo.rate', false)->orderBy('amount', 'desc')->where('amount', '<=', $code->price)->first();
        $base = intval(Web::getSetting("mall:currency:base", false));
        $base = $base <= 50 ? 100 : $base;
        return (($base*$rate->amount)*((100-$rate->bonusPercentage) / 100));
    }
}
