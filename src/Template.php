<?php

namespace Accolon\Template;

class Template
{
    private string $html;
    private string $title = "Accolon\\Template";
    private string $location = "en";
    private string $charset = "UTF-8";
    private $css = [];
    private $js = [];

    public function __construct(string $template)
    {
        $this->html = $template;
    }

    public function location($location)
    {
        $this->location = $location;
        return $this;
    }

    public function charset($charset)
    {
        $this->charset = $charset;
        return $this;
    }

    public function title($title)
    {
        $this->title = $title;
        return $this;
    }

    public function js($link)
    {
        if(!is_array($link)) {
            $link = [$link];
        }

        foreach($link as $js) {
            $this->js[] = $js;
        }

        return $this;
    }

    public function css($link)
    {
        if(!is_array($link)) {
            $link = [$link];
        }

        foreach($link as $css) {
            $this->css[] = $css;
        }

        return $this;
    }

    public function fecth()
    {
        echo $this->header();
        require_once $this->html;
        echo $this->footer();
    }

    private function header(): string
    {
        $template = "";
        foreach($this->css as $css) {
            $template .= "<link rel='stylesheet' href='{$css}'>";
        }

        $title = $this->title;
        $location = $this->location;
        $charset = $this->charset;

        return "
            <!DOCTYPE html>
            <html lang='{$location}'>
            <head>
                <meta charset='{$charset}'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>{$title}</title>
            {$template}
            </head>
            <body>
        ";
    }

    private function footer(): string
    {
        $template = "";
        foreach($this->js as $js) {
            $template .= "<script async src='{$js}'></script>";
        }

        return "
            {$template}
            </body>
            </html>
        ";
    }
}