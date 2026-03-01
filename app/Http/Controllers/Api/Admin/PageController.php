<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return Page::all();
    }

    public function show(Page $page)
    {
        return $page;
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:pages,slug,' . $page->id,
            'content' => 'sometimes|required|string',
        ]);

        $page->update($validated);

        return $page;
    }
}
