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
    abstract protected function makeHamburger() : Hamburger;

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

echo "<br>";
echo "<h4>Implementation:</h4>";

require_once "Reports/Report.php";
require_once "Reports/InventoryReport.php";
require_once "Reports/SalesReport.php";
require_once "Reports/FinancialReport.php";
require_once "ReportFactory/ReportFactory.php";
require_once "ReportFactory/InventoryReportFactory.php";
require_once "ReportFactory/SalesReportFactory.php";
require_once "ReportFactory/FinancialReportFactory.php";

class ReportHandler
{
    private $report; // Report

    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    // Getter and Setter only for type hinting
    public function getReport() : Report
    {
        return $this->report;
    }
    public function setReport(Report $report) : void
    {
        $this->report = $report;
    }
}

$reportHandler;
$report_type = "financial";

switch ($report_type) {
    case "inventory":
        $reportHandler = new ReportHandler(new InventoryReport());
        break;
    case "sales":
        $reportHandler = new ReportHandler(new SalesReport());
        break;
    case "financial":
        $reportHandler = new ReportHandler(new FinancialReport());
        break;
    default:
        $reportHandler = new ReportHandler(new InventoryReport());
}

$reportHandler->getReport()
    ->generate();