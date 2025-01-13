<?php

require_once dirname(__DIR__).'/Component.php';

class MacInput implements Input
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
        return $this->value;
    }

    public function render() : void
    {
        echo "<input style='border-radius: 20px; color: $this->color' type='text' value='$this->value'>";
    }
}