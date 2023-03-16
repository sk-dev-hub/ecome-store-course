<?php

namespace App\Menu;

use Support\Traits\Makeable;

final class MenuItem
{

    use Makeable;

    public function __construct(
        protected string $link,
        protected string $lable
        )
    {
    }

    public function link(): string
    {
        return $this->link;
    }

    public function lable(): string
    {
        return $this->lable;
    }

    public function isActive(): bool
    {
        $path = parse_url($this->link(), PHP_URL_PATH) ?? '/';

        if($path === '/'){
           return request()->path() === $path;     
        }

        return request()->fullUrlIs($this->link() . '*');
    }
}