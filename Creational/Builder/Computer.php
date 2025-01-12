<?php

class Computer {
    public $cpu;
    public $ram;
    public $storage;
    public $gpu = null;

    public function displaySettings() {
        echo "CPU: {$this->cpu}<br>";
        echo "RAM: {$this->ram}<br>";
        echo "Storage: {$this->storage}<br>";
        echo "GPU: {$this->gpu}<br>";
    }
}

class ComputerBuilder {

    private Computer $computer;

    public function __construct()
    {
        $this->computer = new Computer();
    }

    public function setCPU($cpu) : ComputerBuilder
    {
        $this->computer->cpu = $cpu;
        return $this;
    }

    public function setRAM($ram) : ComputerBuilder
    {
        $this->computer->ram = $ram;
        return $this;
    }

    public function setStorage($storage) : ComputerBuilder
    {
        $this->computer->storage = $storage;
        return $this;
    }

    public function setGPU($gpu) : ComputerBuilder
    {
        $this->computer->gpu = $gpu;
        return $this;
    }

    public function build() : Computer
    {
        return $this->computer;
    }
}

class Director {
    public function buildGamingComputer() : Computer
    {
        return (new ComputerBuilder())
            ->setCPU("Intel i9")
            ->setRAM("32GB")
            ->setStorage("1TB SSD")
            ->setGPU("Nvidia RTX 3090")
            ->build();
    }

    public function buildOfficeComputer() : Computer
    {
        return (new ComputerBuilder())
            ->setCPU("Intel i5")
            ->setRAM("16GB")
            ->setStorage("512GB SSD")
            ->build();
    }
}

echo "<h1>Builder</h1>";
$director = new Director();

echo "<h4>Office Computer</h4>";
echo $director->buildOfficeComputer()->displaySettings();

echo "<h4>Gaming Computer</h4>";
echo $director->buildGamingComputer()->displaySettings();

// Now we use QueryBuilder Class

require_once __DIR__ . '/QueryBuilder.php';

echo "<h1>Query Builder</h1>";

$builder = new QueryBuilder('users');
$builder
    ->select(['name', 'email'])
    ->where('id > 100')
    ->where('name LIKE "%A%"')
    ->orderBy('id')
    ->orderBy('name', 'DESC')
    ->limit(5);

echo $builder->getQuery();