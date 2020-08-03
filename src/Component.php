<?php

namespace Accolon\Template;

class Component
{
    protected string $dir;

    public function __construct($options)
    {
        foreach ($options as $option => $value) {
            $this->$option = $value;
        }
    }

    public function render(string $path): void
    {
        echo "<style>" . file_get_contents("{$path}/{$this->dir}/style.css") . "</style>";
        include "{$path}/{$this->dir}/index.php";
        echo "<script>" . file_get_contents("{$path}/{$this->dir}/main.js") . "</script>";
    }
}
