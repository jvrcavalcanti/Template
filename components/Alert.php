<?php

namespace Components;

use Accolon\Template\Component;
use Accolon\Template\Template;

class Alert implements Component
{
    private string $type = "info";

    public function setType(string $type): void
    {
        $types = ["danger", "success", "info", "primary", "secodary"];
        if(in_array($type, $types)){
            $this->type = $type;
        }
    }

    public function attributes(): array
    {
        return [
            "type" => $this->type
        ];
    }

    public function render(): void
    {
        $path = "../view/Alert/";
        $tcp = new Template($path . "index.php");
        $tcp->css($path . "style.css")
            ->js($path . "main.js")
            ->getBody($this);
    }
}