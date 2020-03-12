<?php

use Accolon\Template\Template;

require_once "../vendor/autoload.php";

$tpl = new Template("../view/index.php");
$tpl->css("../view/style.css")
    ->title("Teste")
    ->preset("bootstrap-css")
    ->js("../view/main.js")
    ->fecth();