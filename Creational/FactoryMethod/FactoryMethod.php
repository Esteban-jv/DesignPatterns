<?php
/**
 * Factory Method
 *
 * El patrón Factory method permite crear objetos sin especificar la clase exacta del objeto que se creará
 *
 * En lugar de eso, delegamos la creación de objetos a las subclases o métodos que encapsulan esa lógica
 *
 * Es útil cuando una clase no puede antoicipar la clase de objetos que debe crear.
 *
 * https://refactoring.guru/design-patterns/factory-method
 */

// Producto abstracto
interface Hamburger
{
    public function prepare() : void;
}

// Productos concretos
class Cheeseburger implements Hamburger
{
    public function prepare() : void
    {
        echo "Cheeseburger preparado\n";
    }
}
class Chickenburger implements Hamburger
{
    public function prepare() : void
    {
        echo "Chickenburger preparado\n";
    }
}
class Beefburger implements Hamburger
{
    public function prepare() : void
    {
        echo "Beefburger preparado\n";
    }
}
class Beanburger implements Hamburger
{
    public function prepare() : void
    {
        echo "Beanburger preparado\n";
    }
}

// Restaurante abstracto
abstract class Restaurant
{
    abstract function makeHamburger() : Hamburger;

    public function orderHamburger() : void
    {
        $hamburger = $this->makeHamburger();
        $hamburger->prepare();
    }
}

// Restaurantes concretos
class ChickenRestaurant extends Restaurant
{
    public function makeHamburger() : Hamburger
    {
        return new Chickenburger();
    }
}
class BeefRestaurant extends Restaurant
{
    public function makeHamburger() : Hamburger
    {
        return new Beefburger();
    }
}
class CheeseRestaurant extends Restaurant
{
    public function makeHamburger() : Hamburger
    {
        return new Cheeseburger();
    }
}
class BeanRestaurant extends Restaurant
{
    public function makeHamburger() : Hamburger
    {
        return new Beanburger();
    }
}

echo "<h1>Factory Method</h1>";

class Client
{
    private $restaurant; // Restaurant

    public function __construct(Restaurant $restaurant)
    {
        $this->restaurant = $restaurant;
    }

    // Getter and Setter only for type hinting
    public function getRestaurant() : Restaurant
    {
        return $this->restaurant;
    }
    public function setRestaurant(Restaurant $restaurant) : void
    {
        $this->restaurant = $restaurant;
    }
}

$restaurantClient;
$restaurant_type = "bean";

switch ($restaurant_type) {
    case "chicken":
        $restaurantClient = new Client(new ChickenRestaurant());
        break;
    case "beef":
        $restaurantClient = new Client(new BeefRestaurant());
        break;
    case "cheese":
        $restaurantClient = new Client(new CheeseRestaurant());
        break;
    case "bean":
        $restaurantClient = new Client(new BeanRestaurant());
        break;
    default:
        $restaurantClient = new Client(new BeefRestaurant());
}

$restaurantClient->getRestaurant()
    ->orderHamburger();