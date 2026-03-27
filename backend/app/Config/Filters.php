<?php

namespace Config;

use CodeIgniter\Config\Filters as BaseFilters;

class Filters extends BaseFilters
{
    public array $aliases = [
        'auth'       => \App\Filters\AuthFilter::class,
        'cors'       => \App\Filters\Cors::class,
        'auth' => \App\Filters\AuthFilter::class,

        'forcehttps' => \CodeIgniter\Filters\ForceHTTPS::class,
        'pagecache'  => \CodeIgniter\Filters\PageCache::class,
    ];

    public array $globals = [
    'before' => [
        'cors'  
    ],
    'after' => [
        'cors'   
    ],
];

    // ✅ THIS IS THE IMPORTANT FIX
    public array $required = [
        'before' => [],
        'after'  => []
    ];
}
