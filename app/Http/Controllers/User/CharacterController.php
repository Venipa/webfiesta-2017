<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Auth;
use App\Character;
use Illuminate\Support\Facades\Redis;

class CharacterController extends Controller
{
    public function topEXP() {
        $collection = $this->getTopCached();
        $perPage = 20;

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        if ($currentPage == 1) {
            $start = 0;
        }
        else {
            $start = ($currentPage - 1) * $perPage;
        }

        $currentPageCollection = $collection->slice($start, $perPage)->all();

        $paginatedTop100 = new LengthAwarePaginator($currentPageCollection, count($collection), $perPage);

        $paginatedTop100->setPath(LengthAwarePaginator::resolveCurrentPath());
        return view('top.exp')->with(['characters' => $paginatedTop100]);
    }
    private function getTopCached() {
        return Character::select('sID', 'nLevel', 'nExp')->where('nAdminLevel', 0)->where('bDeleted', 0)->where('nLevel', '>', 1)->orderBy('nExp', 'desc')->take(100)->get();
        $redis = Redis::connection();
        if($redis->exists("top:exp")) {
            $chars = json_decode($redis->get("top:exp"), true);
        } else {
            $chars = Character::select('sID', 'nLevel', 'nExp')->where('nAdminLevel', 0)->where('bDeleted', 0)->where('nLevel', '>', 1)->orderBy('nExp', 'desc')->take(100)->get();
            $redis->set("top:exp", $chars->toJson());
            $redis->expire("top:exp", 60*60*12);
        }
        return $chars;
    }
}
