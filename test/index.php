<?php

use Accolon\Template\Template;

require_once "../vendor/autoload.php";

function component($name, $options = []) {
    $name = "\\Components\\{$name}";
    $component = new $name($options);
    $component->render("../view");
}

$tpl = new Template("../view/index.php");
$tpl->css("../view/style.scss")
    ->title("Teste")
    ->preset("vue")
    ->js("../view/main.js")
    ->fecth([
        "user" => [
            "name" => "a"
        ]
    ]);