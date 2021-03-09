<?php


namespace App\Services;


class DiceThrower
{
    public function rollDices(int $diceRolled, int $side)
    {
        if ($diceRolled > 0 && $side > 1) {

            for ($i = 1; $i <= $diceRolled; $i++){

                $die = mt_rand(1, $side);
                $diceResult[] = $die;

            }
            return $diceResult;
        }
    }

    public function rollTwenty(int $diceRolled)
    {
        if ($diceRolled > 0) {

            for ($i = 1; $i <= $diceRolled; $i++){

                $die = mt_rand(1, 20);
                $diceResult[] = $die;

            }
            return $diceResult;
        }
    }

    public function rollHundred(int $diceRolled)
    {
        if ($diceRolled > 0) {

            for ($i = 1; $i <= $diceRolled; $i++){

                $die = mt_rand(1, 100);
                $diceResult[] = $die;

            }
            return $diceResult;
        }
    }
}
