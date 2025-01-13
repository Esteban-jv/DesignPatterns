<?php

class WindowsInput implements Input
{
    private $value;
    private $color = 'black';

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        echo "Windows Input get value $this->value\n";
    }

    public function render() : void
    {
        echo "<input style='color: $this->color' type='text' value='$this->value'>";
    }
}