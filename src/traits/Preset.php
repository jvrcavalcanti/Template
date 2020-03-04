<?php

namespace Accolon\Template\Traits;

trait Preset
{
    public function preset($op)
    {
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
}