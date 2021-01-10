<?php

namespace BoostNet\Http\Controllers\Admin;

use BoostNet\Helpers\ImageSaver;
use BoostNet\Http\Controllers\Controller;
use BoostNet\Models\Brand;
use BoostNet\Models\Category;
use BoostNet\Models\Product;
use BoostNet\Http\Requests\ProductCatalogRequest;

class ProductController extends Controller
{

    private $imageSaver;

    public function __construct(ImageSaver $imageSaver)
    {
        $this->imageSaver = $imageSaver;
    }

    /**
     * Показывает список всех товаров каталога
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // корневые категории для возможности навигации
        $roots = Category::where('parent_id', 0)->get();
        $products = Product::paginate(5);
        return view('admin.catalog.product.index', compact('products', 'roots'));
    }

    /**
     * Показывает товары выбранной категории
     *
     * @return \Illuminate\Http\Response
     */
    public function category(Category $category)
    {
        $products = $category->products()->paginate(5);
        return view('admin.catalog.product.category', compact('category', 'products'));
    }

    /**
     * Показывает форму для создания товара
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // все категории для возможности выбора родителя
        $items = Category::all();
        // все бренды для возмозжности выбора подходящего
        $brands = Brand::all();
        return view('admin.catalog.product.create', compact('items', 'brands'));
    }

    /**
     * Сохраняет новый товар в базу данных
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCatalogRequest $request)
    {
        $data = $request->all();
        $data['image'] = $this->imageSaver->upload($request, null, 'product');
        $product = Product::create($data);
        return redirect()
            ->route('admin.catalog.product.show', ['product' => $product->id])
            ->with('success', 'Новый товар успешно создан');
    }

    /**
     * Показывает страницу товара каталога
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.catalog.product.show', compact('product'));
    }

    /**
     * Показывает форму для редактирования товара
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        // все категории для возможности выбора родителя
        $items = Category::all();
        // все бренды для возмозжности выбора подходящего
        $brands = Brand::all();
        return view('admin.catalog.product.edit', compact('product', 'items', 'brands'));
    }

    /**
     * Обновляет товар каталога в базе данных
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductCatalogRequest $request, Product $product)
    {
        $data = $request->all();
        $data['image'] = $this->imageSaver->upload($request, $product, 'product');
        $product->update($data);
        return redirect()
            ->route('admin.catalog.product.show', ['product' => $product->id])
            ->with('success', 'Товар был успешно обновлен');
    }

    /**
     * Удаляет товар каталога из базы данных
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->imageSaver->remove($product, 'product');
        $product->delete();
        return redirect()
            ->route('admin.catalog.category.index')
            ->with('success', 'Товар каталога успешно удален');
    }
}
