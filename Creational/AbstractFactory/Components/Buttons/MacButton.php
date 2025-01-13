<?php

class MacButton extends Button
{
    public function onClick() : void
    {
        echo "Opening Shell\n";
        call_user_func($this->callback);
    }
}