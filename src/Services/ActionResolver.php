<?php

namespace App\Services;

use App\Entity\Character;


class ActionResolver
{
    /**
     * @var DiceThrower
     */
    private $diceThrower;

    public function __construct(DiceThrower $diceThrower)
    {
        $this->diceThrower = $diceThrower;
    }

    public function attack(Character $attacker, Character $defender)
    {
        $testAttack = $this->diceThrower->rollHundred(1);

        if ($testAttack > $attacker->getStrength()) {
            return null;
        }

        $testDefense = $this->diceThrower->rollHundred(1);

        if ($testDefense <= $defender->getDefense()) {
            return null;
        }

        $damages = $this->diceThrower->rollTwenty(6);

        return array_sum($damages);
    }
}