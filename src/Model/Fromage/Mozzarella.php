<?php declare(strict_types=1);

namespace PizzaKing\Model\Fromage;

class Mozzarella implements Fromage
{
    public function getName(): string
    {
        return 'mozzarella';
    }

    public function getPrix(): float
    {
        return 3;
    }
}
