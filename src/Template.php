<?php

namespace Accolon\Template;

use Accolon\Template\TraitTemplate;

class Template 
{
    use TraitTemplate;

    protected function header(): string
    {
        $template = "";

        foreach($this->libs["css"] as $css) {
            $template .= "<link rel='stylesheet' href='{$css}'>";
        }

        foreach($this->css as $css) {
            $template .= "<link rel='stylesheet' href='{$css}'>";
        }

        $title = $this->title;
        $lang = $this->lang;
        $charset = $this->charset;

        return "
            <!DOCTYPE html>
            <html lang='{$lang}'>
            <head>
                <meta charset='{$charset}'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>{$title}</title>
            {$template}
            </head>
            <body>
        ";
    }

    protected function footer(): string
    {
        $template = "";

        foreach($this->libs["js"] as $js) {
            $template .= "<script src='{$js}'></script>";
        }

        foreach($this->js as $js) {
            $tmp = "<script src='{$js}'></script>";
            if($this->babel) {
                $tmp = "<script type='text/babel' src='{$js}'></script>";
            }
            $template .= $tmp;
        }

        return "
            {$template}
            </body>
            </html>
        ";
    }
}