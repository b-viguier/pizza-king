<?php
declare(strict_types=1);

namespace PizzaKing\Test;

use PHPUnit\Framework\TestCase;
use PizzaKing\Model\PizzaCreator;
use PizzaKing\Model\PizzaKebab;

final class PizzaKebabTest extends TestCase
{
    public function testPizzaKebab(): void
    {
        $pizza = new PizzaKebab();
        PizzaCreator::createPizzaKebab($pizza);
        $this->assertEquals(15, $pizza->getPrix());

        // Sans salade
        PizzaCreator::createPizzaKebab($pizza,false);
        $this->assertEquals(14, $pizza->getPrix());

        // Sans oignon
        PizzaCreator::createPizzaKebab($pizza,true, true, false);
        $this->assertEquals(13, $pizza->getPrix());
    }

    public function testPizzaKebabPourDenisse(): void
    {
        $pizza = new PizzaKebab();
        PizzaCreator::createPizzaKebab($pizza,true, true, true, 'PizzaKebabPourDenisse');
        // Pas de viande !
        $this->assertNotContains('kebab', $pizza->getIngredientNames());
        $this->assertEquals(10, $pizza->getPrix());
    }

    public function testUnCodeInconnuNeDoitPasFonctionner(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Partenariat inconnu');

        $p = new PizzaKebab();
        PizzaCreator::createPizzaKebab($p, true, true, true, 'JeVeuxJusteUnKebab');
    }
}
