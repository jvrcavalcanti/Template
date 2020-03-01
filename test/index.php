<?php

use Accolon\Template\Template;

require_once "../vendor/autoload.php";

$tpl = new Template("../view/index.html");
$tpl->css("../view/style.css")
    ->title("Teste")
    ->preset("vue")
    ->preset("bootstrap-css")
    ->js("../view/main.js")
    ->fecth();