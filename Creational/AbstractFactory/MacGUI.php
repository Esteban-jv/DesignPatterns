<?php

class MacGUI implements GUI
{
    private $textColor = 'white';

    public function createButton($text, $callback) : Button
    {
        return new MacButton($text, $callback, 'black', $this->textColor);
    }

    public function createInput($value) : Input
    {
        $input = new MacInput();
        $input->setValue($value); // This is not necesary but I want to do it this way
        $input->setColor('gray');
        return $input;
    }
}