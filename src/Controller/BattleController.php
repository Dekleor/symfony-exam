<?php

namespace App\Controller;

use App\Services\ActionResolver;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Character;

/**
 * @Route("battle")
 */
class BattleController extends AbstractController
{

    /**
     * @var ActionResolver
     */
    private $actionResolver;

    public function __construct(ActionResolver $actionResolver)
    {
        $this->actionResolver = $actionResolver;
    }

    /**
     * @Route("/", name="battle_test")
     */
    public function test(): Response
    {
        $legolas = new Character();
        $legolas->setHealthPoint(1600);
        $legolas->setName('Legolas');
        $legolas->setDefense('60');
        $legolas->setStrength('60');

        $gimli = new Character();
        $gimli->setHealthPoint(2000);
        $gimli->setName('Gimli');
        $gimli->setDefense('70');
        $gimli->setStrength('50');

        $runs = $this->runBattle($legolas, $gimli);

        return $this->render('battle/test.html.twig', [
            'gimli'   => $gimli,
            'legolas' => $legolas,
            'runs'    => $runs,
        ]);
    }

    /**
     * @param Character $gimli
     * @param Character $legolas
     *
     * @return array
     */
    protected function runBattle(Character $attacker, Character $defender): array
    {
        $attacks = [];

        while (!$attacker->hasGivenUp() && $defender->hasGivenUp()) {
            $attacks[] = $this->runAttack($attacker, $defender);

            if (!$defender->hasGivenUp()) {
                $attacks[] = $this->runAttack($defender, $attacker);
            }
        }

        return $attacks;
    }

    protected function runAttack(Character $attacker, Character $defender): array
    {
        $damage = $this->actionResolver->attack($attacker, $defender);
        if ($damage < 0) {
            $defender->getHit($damage);
        }

        return [
            'attacker'     => $attacker->getName(),
            'defender'     => $defender->getName(),
            'damage'       => $damage,
            'attackerWins' => $defender->hasGivenUp(),
        ];
    }
}
