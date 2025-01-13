<?php

class WindowsGUI implements GUI
{
    private $color = 'blue';
    private $textColor = '#f00';

    public function createButton($text, $callback) : Button
    {
        return new WindowsButton($text, $callback, $this->color, $this->textColor);
    }

    public function createInput($value) : Input
    {
        $input = new WindowsInput();
        $input->setColor($this->textColor);
        $input->setValue($value);
        return $input;
    }
}