<?php

namespace App\Models;

class Lottery 
{
    private $tens;
    private $result;
    private $game_totals;
    private $games;

    public function __construct($tens, $game_totals)
    {
        $this->setTens($tens);
        $this->setGameTotals($game_totals);
    }

    public function setTens($tens){
        if ($tens < 6 || $tens > 10) {
            throw new \Exception('Numero de dezenas não está entre 6 e 10.');
        }
        $this->tens = $tens;
    }

    public function setResult($result){
        $this->result = $result;
    }

    public function setGameTotals($game_totals){
        $this->game_totals = $game_totals;
    }

    public function getTens(){
        return $this->tens; 
    }

    public function getResult(){
        return $this->result;
    }

    public function getGame(){
        return $this->game_totals;
    }

    public function getGames(){
        return $this->games;
    }

    private function rand60() {
        $num_round = rand(1, 60);
        $num_round = str_pad((string) $num_round, 2, '0', STR_PAD_LEFT);
        return $num_round;
    }

    private function tensToGame($tens=null) {

        if (is_null($tens)) {
            $tens = $this->getTens();
        }

        $raffle = [];  

        for ($i = 1; $i <= $tens; $i++) {
            $num_round = $this->rand60();

            while(in_array($num_round, $raffle)) {
                $num_round = $this->rand60();
            }
            $raffle[] = $num_round;  
        }

        sort($raffle);

        return $raffle;

    }

    public function setGames() {
        $games = []; 

        for ($i = 1; $i <= $this->game_totals; $i++) {
            $games[$i] = $this->tensToGame();
        }

        $this->games = $games;
    }

    public function sortResult() {
        $this->setResult($this->tensToGame(6));
    }

    public function checkResult() {

        $results = [];
        foreach ($this->getGames() as $key => $game) {
            $results[$key] = array_intersect($game, $this->result);
        }
        
        $view = view('gameresult', ['games'=> $this->getGames(), 'results' => $results, 'result' => $this->getResult()]);

        return $view;
        
    }
    
}
