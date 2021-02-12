<?php declare(strict_types=1);

namespace PizzaKing\Model;

use PizzaKing\Model\Fromage\Fromage;
use PizzaKing\Model\Sauce\Sauce;
use PizzaKing\Model\Sauce\SauceCreme;
use PizzaKing\Model\Viande\Viande;

class PizzaKebab implements Pizza
{
    /** @var Viande[] */
    //private array $ingredients;

    /**
     * @param Viande[] $viandes
     */
    public function __construct(Ingredient ...$ingredients)
    {
        $this->ingredients = $ingredients;
    }

    public function getPrix(): float
    {
        $f = function(Ingredient $first, Ingredient ... $ingredients) use(&$f) {
            if(count($ingredients) === 0) {
                return $first->getPrix();
            }

            return $f(...$ingredients) + $first->getPrix();
        };

        return 4 + $f(...$this->getIngredients());
    }

    /**
     * @return string[]
     */
    public function getIngredientNames(): array
    {
        return array_map(function (Ingredient $ingredient) {
            return $ingredient->getName();
        }, $this->getIngredients());
    }

    /**
     * @return Ingredient[]
     */
    private function getIngredients(): array
    {
        return array_merge($this->ingredients, [new SauceCreme()]);
    }
}
