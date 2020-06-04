<?php

namespace Accolon\Template;

use Accolon\Template\Traits\Preset;
use ScssPhp\ScssPhp\Compiler;

class Template 
{
    use Preset;

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

    public function css($links)
    {
        if(!is_array($links)) {
            $links = [$links];
        }

        foreach($links as $link) {
            $this->css[] = $link;
        }

        return $this;
    }

    public function fecth($data = [])
    {
        foreach($data as $key => $value) {
            $$key = $value;
        }
        
        echo $this->header();
        require_once $this->html;
        echo $this->footer();
    }

    protected function header(): string
    {
        $template = "";

        $scss = new Compiler();

        foreach($this->libs["css"] as $css) {
            $content = file_get_contents($css);
            if (strpos($css, ".scss") !== false) {
                $content = $scss->compile(file_get_contents($css));
            }
            $template .= $content;
        }

        foreach($this->css as $css) {
            $content = file_get_contents($css);
            if (strpos($css, ".scss") !== false) {
                $content = $scss->compile(file_get_contents($css));
            }
            $template .= $content;
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
                <link rel='shortcut icon' type='image/x-icon' href='favicon.ico?v=" . md5(microtime(true)) . "' />
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