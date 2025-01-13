<?php

include_once 'Components\Buttons\Button.php';
include_once 'Components\Inputs\Input.php';

interface GUI
{
    public function createButton($text, $callback) : Button;
    public function createInput($value) : Input;
}