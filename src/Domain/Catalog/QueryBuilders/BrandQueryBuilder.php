<?php

namespace Domain\Catalog\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class BrandQueryBuilder extends Builder
{
    public function HomePage()
    {
        return $this->where('on_home_page', true)
        ->orderBy('sorting')
        ->limit(6);
    }
}
