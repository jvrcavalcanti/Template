<?php

namespace Accolon\Template;

interface Component
{
    public function render(): void;
    public function attributes(): array;
}