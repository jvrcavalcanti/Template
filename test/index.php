<?php

use Accolon\Template\Template;
use Components\Alert;

require_once "../vendor/autoload.php";

$tpl = new Template("../view/index.php");
$tpl->css("../view/style.css")
    ->title("Teste")
    ->component("alert", Alert::class)
    ->preset("bootstrap-css")
    ->js("../view/main.js")
    ->fecth();