<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCatRequest;
use App\Http\Requests\UpdateCatRequest;
use App\Models\Cat;
use App\Services\CatService;

class CatController extends Controller
{
    public function __construct(private CatService $catService)
    {
    }

    public function index()
    {
        $cats = $this->catService->getAllCats();
        return view('admin.cats.index', compact('cats'));
    }

    public function create()
    {
        return view('admin.cats.create');
    }

    public function store(StoreCatRequest $request)
    {
        $this->catService->storeCat($request->validated());

        return redirect()->route('admin.cats.index')->with('success', 'Cat added successfully.');
    }

    public function edit(Cat $cat)
    {
        return view('admin.cats.edit', compact('cat'));
    }

    public function update(UpdateCatRequest $request, Cat $cat)
    {
        $this->catService->updateCat($cat, $request->validated());

        return redirect()->route('admin.cats.index')->with('success', 'Cat updated successfully.');
    }

    public function destroy(Cat $cat)
    {
        $this->catService->deleteCat($cat);

        return redirect()->route('admin.cats.index')->with('success', 'Cat deleted successfully.');
    }
}
