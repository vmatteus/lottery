<?php

namespace App\Models;

class Lottery 
{
    private $tens;
    private $result;
    private $game_totals;
    private $games;
    private $numbers_01_60 = [
        '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18',
        '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36',
        '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54',
        '55', '56', '57', '58', '59', '60'
    ];

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

    private function tensToGame($tens=null) {

        if (is_null($tens)) {
            $tens = $this->getTens();
        }

        $raffle = array_rand($this->numbers_01_60, $tens);  

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
