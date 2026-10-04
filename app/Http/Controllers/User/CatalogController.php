<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\CatService;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function __construct(private CatService $catService)
    {
    }

    public function index(Request $request)
    {
        $breed = $request->input('breed');
        $age = $request->input('age');

        $cats = $this->catService->getFilteredCats($breed, $age);

        return view('user.catalog.index', compact('cats'));
    }
}
