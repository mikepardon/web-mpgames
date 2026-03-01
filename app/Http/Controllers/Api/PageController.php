<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;

class PageController extends Controller
{
    public function show(string $slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        return $page;
    }
}
