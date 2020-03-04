<?php

namespace Accolon\Template\Traits;

use Accolon\Template\Component;

trait Components
{
    protected $components = [];

    public function components($components)
    {
        $this->components = $components;
        return $this;
    }

    public function component(string $name, string $component)
    {
        $this->components[$name] = $component;
        return $this;
    }

    public function getComponent(string $name): ?Component
    {
        return new $this->components[$name] ?? null;
    }

    public function getComponents(): array
    {
        return $this->components;
    }

    public function getBody(Component $component): void
    {
        $template = "";
        foreach($this->css as $css) {
            $template .= file_get_contents($css);
        }
        echo "<style>{$template}</style>";

        require_once $this->html;

        $template = "";
        foreach($this->js as $js) {
            $template .= file_get_contents($js);
        }
        echo "<script>{$template}</script>";
    }
}