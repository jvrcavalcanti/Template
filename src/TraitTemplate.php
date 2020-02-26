<?php

namespace Accolon\Template;

trait TraitTemplate
{
    protected string $html;
    protected string $title = "Accolon\\Template";
    protected string $lang = "en";
    protected string $charset = "UTF-8";
    protected bool $babel = false;
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
    }

    public function babel($version = "6.24.0")
    {
        $this->lib("js", "https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/{$version}/babel.js");
        $this->babel = true;

        return $this;
    }

    public function preset($op)
    {
        if($op == "react") {
            $this->react();
        }

        if($op == "bootstrap") {
            $this->bootstrap();
        }

        if($op == "bootstrap-css") {
            $this->bootstrapCss();
        }

        if($op == "vue") {
            $this->vue();
        }

        return $this;
    }

    public function bootstrapCss($bootstrap = "4.1.3")
    {
        $this->lib("css", "https://stackpath.bootstrapcdn.com/bootstrap/{$bootstrap}/css/bootstrap.min.css");
    }

    public function bootstrap($bootstrap = "4.1.3", $jquery = "3.3.1", $pooper = "1.14.3")
    {
        $this->bootstrapCss();

        $this->lib("js", "https://code.jquery.com/jquery-{$jquery}.slim.min.js");
        $this->lib("js", "https://cdnjs.cloudflare.com/ajax/libs/popper.js/{$pooper}/umd/popper.min.js");
        $this->lib("js", "https://stackpath.bootstrapcdn.com/bootstrap/{$bootstrap}/js/bootstrap.min.js");

        return $this;
    }

    public function vue($version = "2.6.11")
    {
        $this->lib("js", "https://cdn.jsdelivr.net/npm/vue@2.6.0");

        return $this;
    }

    public function react($version = "16.3.1")
    {
        $this->lib("js", "https://unpkg.com/react@{$version}/umd/react.production.min.js");
        $this->lib("js", "https://unpkg.com/react-dom@{$version}/umd/react-dom.production.min.js");
        $this->babel();

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
}