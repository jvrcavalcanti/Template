<?php

use Accolon\Template\Template;

require_once "../vendor/autoload.php";

function component($name, $options = []) {
    $name = "\\Components\\{$name}";
    $component = new $name($options);
    $component->render("../view");
}

$tpl = new Template("../view/index.php");
$tpl->css("../view/style.css")
    ->title("Teste")
    ->preset("bootstrap-css")
    ->js("../view/main.js")
    ->fecth();