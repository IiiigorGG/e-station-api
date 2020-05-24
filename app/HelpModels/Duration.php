<?php


namespace App\HelpModels;


class Duration
{
    public $value;
    public $text;

    function __construct($durationObject) {
        $this->value = $durationObject['value'];
        $this->text = $durationObject['text'];
    }
}
