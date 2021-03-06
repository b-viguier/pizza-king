<?php
declare(strict_types=1);

namespace PizzaKing\Model;

interface Pizza
{
    public function getPrix(): float;

    /**
     * @return string[]
     */
    public function getIngredientNames(): array;
}
