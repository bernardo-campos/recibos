<?php

namespace App\Filters;

use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;

class HasRoleFilter implements FilterInterface
{
    public function transform($item)
    {
        if ( isset($item['hasRole']) &&
            (!auth()->check() || !auth()->user()->hasAnyRole($item['hasRole'])) )
        {
            $item['restricted'] = true;
        }

        return $item;
    }
}
