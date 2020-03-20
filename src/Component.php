<?php

namespace Accolon\Template;

class Component
{
    protected string $dir;

    public function __construct($options)
    {
        foreach($options as $option => $value) {
            $this->$option = $value;
        }
    }

    public function render(): void
    {
        echo "<style>" . file_get_contents("../view/{$this->dir}/style.css") . "</style>";
        require_once "../view/{$this->dir}/index.php";
        echo "<script>" . file_get_contents("../view/{$this->dir}/style.css") . "</script>";
    }
}