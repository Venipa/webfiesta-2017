<?php

namespace App\Http\Controllers\Shop;

use Composer\DependencyResolver\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shop;
use App\ShopCats;
use App\Rate;
use App\GC;
use Validator;
use App\User;
use App\Purchases;
use App\ItemUse;
use Carbon\Carbon;
use App\Transactions;
use CF;

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
            'itemid' => 'required'
        ]);
        $item = Shop::where('nID', $r->input('itemid'))->first();

        if(count($item) > 0) {
            $user = \Auth::user();
            $user->nCoins -= $item->nPrice;
            if($user->nCoins >= 0) {

                //Ordering
                $order = Purchases::create([
                    'nAGID' => $user->nEMID,
                    'nPrice' => $item->nPrice,
                    'nGoodsNo' => $item->nGoodsNo,
                    'nQuantity' => $item->nLot,
                    'sIP' => $r->ip(),
                    'nIsGift' => 0,
                    'userNo' => $user->nEMID
                ]);
                //Putting Item into User's Inventory
                $itemUse = ItemUse::create([
                    'nOrderID' => $order->nID,
                    'nAGID' => 1,
                    'nCharNo' => 0,
                ]);
                $user->save();
                return redirect()->back()->with(['message' => 'Item Bought!', 'error' => false]);
            } else {
                return redirect()->back()->with(['message' => 'Not enough Coins!', 'error' => true]);
            }
        } else {
            return redirect()->back()->with(['message' => 'Item not Found!', 'error' => true]);
        }
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
            return response("Your GiftCard Code: \"{$newcode}\", you can redeem it under your Profile.\nRegards,\nYour ".config('app.name', 'Fiesta')." Team");
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
    public function getCoinPage() {
        return view('shop.buycoins');
    }
    public function postCoins(Request $r) {
        if($r->has(['id', 'uid', 'oid', 'new', 'sig'])) {
            $data = [
                'transaction_id' => $r->input('id'),
                'user_id' => $r->input('uid'),
                'offer_id' => $r->input('oid'),
                'new_currency' => $r->input('new'),
                'hash_signature' => $r->input('sig'),
                'ip' => CF::ip()
            ];
            $hash = md5($data["transaction_id"].":".$data["new_currency"].":".$data["user_id"].":".config('fiesta.srr.secret'));
            if($hash == $data['hash_signature']) {
                $user = User::find($data["user_id"]);
                if(count($user) > 0) {
                    $coins = $this->calculateExtra($data["new_currency"]);
                    $user->nCoins += $coins;
                    if($user->nCoins >= 0) {
                        $trans = Transactions::where('transaction_id', $data["transaction_id"])->first();
                        if(count($trans) > 0) {
                            return response(0);
                        }
                        $trans = Transaction::create($data);
                        $user->save();
                    }
                    return response(1);
                }

            }
        }
        return response(0);
    }

    private function getCoins($code) {
        $rate = Rate::orderBy('amount', 'desc')->where('amount', '<=', $code->price)->first();
        $base = intval(config('fiesta.currency.base', 100));
        $base = $base <= 50 ? 100 : $base;
        return (($base*$rate->amount)*((100+$rate->bonusPercentage) / 100));
    }
    private function calculateExtra($points) {
        $rate = Rate::orderBy('amount', 'desc')->where('amount', '<=', $points/100)->first();
        $base = intval(config('fiesta.currency.base', 100));
        return (($base*$rate->amount)*((100+$rate->bonusPercentage) / 100));
    }
}
