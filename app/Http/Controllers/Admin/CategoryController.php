<?php

namespace BoostNet\Http\Controllers\Admin;

use BoostNet\Helpers\ImageSaver;
use BoostNet\Models\Category;
use Illuminate\Http\Request;
use BoostNet\Http\Controllers\Controller;
use BoostNet\Http\Requests\CategoryCatalogRequest;

class CategoryController extends Controller
{

    private $imageSaver;

    public function __construct(ImageSaver $imageSaver)
    {
        $this->imageSaver = $imageSaver;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Category::all();
        return view('admin.catalog.category.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // все категории для возможности выбора родителя
        $items = Category::all();
        return view('admin.catalog.category.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryCatalogRequest $request)
    {
        $data = $request->all();
        $data['image'] = $this->imageSaver->upload($request, null, 'category');
        $category = Category::create($data);
        return redirect()
            ->route('admin.catalog.category.show', ['category' => $category->id])
            ->with('success', 'Новая категория успешно создана');
    }

    /**
     * Display the specified resource.
     *
     * @param  \BoostNet\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.catalog.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \BoostNet\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        // все категории для возможности выбора родителя
        $items = Category::all();
        return view('admin.catalog.category.edit', compact('category', 'items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \BoostNet\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryCatalogRequest $request, Category $category)
    {
        $data = $request->all();
        $data['image'] = $this->imageSaver->upload($request, $category, 'category');
        $category->update($data);
        return redirect()
            ->route('admin.catalog.category.show', ['category' => $category->id])
            ->with('success', 'Категория была успешно исправлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \BoostNet\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($category->children->count()) {
            $errors[] = 'Нельзя удалить категорию с дочерними категориями';
        }
        if ($category->products->count()) {
            $errors[] = 'Нельзя удалить категорию, которая содержит товары';
        }
        if (!empty($errors)) {
            return back()->withErrors($errors);
        }
        $category->delete();
        return redirect()
            ->route('admin.catalog.category.index')
            ->with('success', 'Категория каталога успешно удалена');
    }
}
