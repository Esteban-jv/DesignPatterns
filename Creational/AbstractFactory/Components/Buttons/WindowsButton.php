<?php

class WindowsButton extends Button
{
    public function onClick() : void
    {
        echo "Opening PowerShell\n";
        call_user_func($this->callback);
    }
}