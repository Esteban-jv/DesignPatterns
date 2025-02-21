<?php
/**
 * ! Patrón Prototype:
 *
 * Es un patrón de diseño creacional que nos permite copiar objetos existentes sin tener que hacer
 * que el código dependa de sus clases.
 *
 * Es útil cuando queremos duplicar el contenido,
 * el título y el autor de un documento, por ejemplo cualquier objeto complejo
 */

class Pokemon
{
    public string $name;
    public string $type;
    private int $level;
    public Array $attacks;

    public function __construct(string $name, string $type, int $level, Array $attacks)
    {
        $this->name = $name;
        $this->type = $type;
        $this->level = $level;
        $this->attacks = $attacks;
    }

    public function displayInfo()
    {
        echo "Name: {$this->name} <br>";
        echo "Type: {$this->type} <br>";
        echo "Level: {$this->level} <br>";
        echo "Attacks: ";
        foreach ($this->attacks as $attack) {
            echo $attack . " ";
        }
    }

    public function __clone()
    {
        return new Pokemon($this->name, $this->type, $this->level, $this->attacks);
    }
}