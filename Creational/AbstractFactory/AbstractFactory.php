<?php

/**
 * Abstract Factory
 *
 * Es un patron de diseño que permite crear familias de objetos relacionados sin
 * especificar sus clases concretas.
 *
 * En lugar de crear objetos individuales directamente, creamos fábricas que
 * producen un conjunto de objetos relacionados.
 *
 * Es útil cuando necesitamos crear objetos que son parte de una familia y quieres
 * asegurarte de que estos objetos se complementen entre sí
 *
 * https://refactoring.guru/design-patterns/abstract-factory
 */

// Productos abstractos
interface Hamburger
{
    public function prepare();
}
interface Drink
{
    public function pour();
}

// Productos concretos
class ChickenHamburger implements Hamburger
{
    public function prepare()
    {
        echo "Chicken Hamburger prepared\n";
    }
}
class BeefHamburger implements Hamburger
{
    public function prepare()
    {
        echo "Beef Hamburger prepared\n";
    }
}
class Water implements Drink
{
    public function pour()
    {
        echo "Water poured\n";
    }
}
class Coke implements Drink
{
    public function pour()
    {
        echo "Coke poured\n";
    }
}

// Fábrica abstracta
interface restaurantFactory
{
    public function createHamburger(): Hamburger;
    public function createDrink(): Drink;
}

// Fábricas concretas
class FastFoodRestaurantFactory implements restaurantFactory
{
    public function createHamburger(): Hamburger
    {
        return new BeefHamburger();
    }
    public function createDrink(): Drink
    {
        return new Coke();
    }
}
class HealthyFoodRestaurantFactory implements restaurantFactory
{
    public function createHamburger(): Hamburger
    {
        return new ChickenHamburger();
    }
    public function createDrink(): Drink
    {
        return new Water();
    }
}

// Cliente
class Client {
    private $hamburger;
    private $drink;

    public function __construct(restaurantFactory $factory)
    {
        $this->hamburger = $factory->createHamburger();
        $this->drink = $factory->createDrink();
    }

    public function getHamburger() : Hamburger
    {
        return $this->hamburger;
    }
    public function setHamburger(Hamburger $hamburger)
    {
        $this->hamburger = $hamburger;
    }

    public function getDrink() : Drink
    {
        return $this->drink;
    }
    public function setDrink(Drink $drink)
    {
        $this->drink = $drink;
    }
}

$client = null;
$restaurant_type = 'healthy';

switch ($restaurant_type) {
    case 'fastfood':
        $client = new Client(new FastFoodRestaurantFactory());
        break;
    case 'healthy':
        $client = new Client(new HealthyFoodRestaurantFactory());
        break;
    default:
        throw new Exception('Invalid restaurant type');
}

$client->getHamburger()->prepare();
$client->getDrink()->pour();

// Implementation
require_once 'Components/Inputs/Input.php';
require_once 'Components/Buttons/Button.php';
require_once 'Components/Inputs/MacInput.php';
require_once 'Components/Buttons/MacButton.php';
require_once 'Components/Inputs/WindowsInput.php';
require_once 'Components/Buttons/WindowsButton.php';
require_once 'GUI.php';
require_once 'WindowsGUI.php';
require_once 'MacGUI.php';

echo "<h2>Implementation</h2>\n";

$clientGUI;
$os = 'windows';

switch ($os) {
    case 'windows':
        $clientGUI = new WindowsGUI();
        break;
    case 'mac':
        $clientGUI = new MacGUI();
        break;
    default:
        throw new Exception('Invalid OS');
}

$clientGUI->createButton('Click me', function() {
    echo "Button clicked\n";
})->render();
echo "<br>\n";
$clientGUI->createInput('Hello world')->render();