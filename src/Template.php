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
            $template .= file_get_contents($css);
        }

        foreach($this->css as $css) {
            $template .= file_get_contents($css);
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
            <style>
            {$template}
            </style>
            </head>
            <body>
        ";
    }

    protected function footer(): string
    {
        $lib = "";

        foreach($this->libs["js"] as $js) {
            $lib .= file_get_contents($js);
        }

        $template = "";

        foreach($this->js as $js) {
            $template .= file_get_contents($js);
        }

        $template = ($this->babel) ? "<script type='text/babel'>{$template}</script>" : "<script>{$template}</script>";

        return "
            <script>
            {$lib}
            </script>
            {$template}
            </body>
            </html>
        ";
    }
}