<?php

use Accolon\Template\Template;

require_once "../vendor/autoload.php";

$tpl = new Template("./view/index.html");
$tpl->css("./view/style.css")
    ->title("Teste")
    ->js("./view/main.js")
    ->fecth();