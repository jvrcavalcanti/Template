<?php

namespace Accolon\Template;

use Accolon\Template\Traits\Components;
use Accolon\Template\Traits\Preset;

class Template 
{
    use Preset;
    use Components;

    protected string $html;
    protected string $title = "Accolon\\Template";
    protected string $lang = "en";
    protected string $charset = "UTF-8";
    protected $libs = [
        "js" => [],
        "css" => []
    ];
    protected $css = [];
    protected $js = [];

    public function __construct(string $template)
    {
        $this->html = $template;
    }

    public function lib($type, $link)
    {
        $this->libs[$type][] = $link;
        return $this;
    }

    public function lang($lang)
    {
        $this->lang = $lang;
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

        $template = "<script>{$template}</script>";

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