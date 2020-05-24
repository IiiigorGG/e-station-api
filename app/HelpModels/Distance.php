<?php


namespace App\HelpModels;


class Distance
{
    public $value;
    public $text;

    function __construct($distanceObject) {
        $this->value = $distanceObject['value'];
        $this->text = $distanceObject['text'];
    }
}
