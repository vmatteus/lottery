<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Lottery;


class LotteryController extends Controller
{
    
    public function getGame($tens, $game_totals) 
    {  
        try{
            $lottery = new Lottery($tens, $game_totals);

            $lottery->setGames();
            $lottery->sortResult();

            return $lottery->checkResult();

        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

}
