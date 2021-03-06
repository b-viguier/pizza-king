<?php declare(strict_types=1);

namespace PizzaKing\Model;

use PizzaKing\Model\Fromage\Chevre;
use PizzaKing\Model\Fromage\Mozzarella;
use PizzaKing\Model\Kebab\Oignon;
use PizzaKing\Model\Kebab\Salade;
use PizzaKing\Model\Kebab\Tomate;
use PizzaKing\Model\Kebab\ViandeKebab;
use PizzaKing\Model\Sauce\SauceCreme;
use PizzaKing\Model\Sauce\SauceTomate;
use PizzaKing\Model\Viande\Jambon;
use PizzaKing\Model\Viande\Pepperoni;

class PizzaCreator
{
    public static function byName(string $name): Pizza
    {
        switch ($name) {
            case 'Reine':
                return self::byIngredients([
                    'sauce tomate',
                    'jambon',
                    'mozzarella',
                ]);
            case 'Napolitana':
                return self::byIngredients([
                    'sauce tomate',
                    'mozzarella',
                ]);
            case 'Carnivore':
                return self::byIngredients([
                    'sauce creme',
                    'pepperoni',
                    'jambon',
                    'mozzarella',
                ]);
            default:
                throw new \Exception('Pizza inconnue');
        }
    }

    public static function byIngredients(array $ingredients): Pizza
    {
        $sauce = null;
        $fromage = null;
        $viandes = [];



        foreach ($ingredients as $ingredient) {
            switch ($ingredient) {
                case 'sauce tomate':
                    $sauce = new SauceTomate();
                    break;
                case 'sauce creme':
                    $sauce = new SauceCreme();
                    break;
                case 'mozzarella':
                    $fromage = new Mozzarella();
                    break;
                case 'chevre':
                    $fromage = new Chevre();
                    break;
                case 'jambon':
                    $viandes[] = new Jambon();
                    break;
                case 'pepperoni':
                    $viandes[] = new Pepperoni();
                    break;
                case 'kebab':
                    $viandes[] = new ViandeKebab();
                    break;
                default:
                    throw new \Exception("Ingrédient \"$ingredient\" inconnu au bataillon");
            }
        }

        if ($sauce === null) {
            throw new \Exception('Sauce manquante');
        }
        if ($fromage === null) {
            throw new \Exception('Fromage manquant');
        }

        return new PizzaClassique($sauce, $fromage, $viandes);
    }

    public static function createPizzaKebab(Pizza &$return, bool $salade = true, bool $tomate = true, bool $oignon = true, string $codeClient = null)
    {
        $return->__construct(
            ...array_filter([
                $salade ? new Salade() : null,
                $oignon ? new Oignon() : null,
                $tomate ? new Tomate() : null,
                $codeClient === 'PizzaKebabPourDenisse' ? null : new Kebab\ViandeKebab(),
            ])
        );

        if(null !== $codeClient) {
            if($codeClient !== 'PizzaKebabPourDenisse') {
                throw new \Exception('Partenariat inconnu');
            }
        }
    }
}
