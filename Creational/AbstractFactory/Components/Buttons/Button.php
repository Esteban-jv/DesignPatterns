<?php

require_once dirname(__DIR__).'/Component.php';

abstract class Button implements Component
{
    // Button text
    protected $text;
    protected $callback;
    protected $color;
    protected $textColor;

    // Initialize button text
    public function __construct($text, $callback, $color, $textColor)
    {
        $this->text = $text;
        $this->callback = $callback;
        $this->color = $color;
        $this->textColor = $textColor;
    }

    // get Button text
    public function getText() : string
    {
        return $this->text;
    }

    // The render method will be the same for all buttons in this particular case (Buttons)
    public function render() : void
    {
        echo "<button onclick='".$this->onClick()."' style='background-color: $this->color; color: $this->textColor'> ".$this->text."</button>";
    }

    // Ovcerload this method in child classes
    abstract function onClick() : void;
}