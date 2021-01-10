<?php

namespace BoostNet\Http\Controllers\Admin;

use BoostNet\Helpers\ImageSaver;
use BoostNet\Models\Brand;
use BoostNet\Http\Controllers\Controller;
use BoostNet\Http\Requests\BrandCatalogRequest;

class BrandController extends Controller
{

    private $imageSaver;

    public function __construct(ImageSaver $imageSaver)
    {
        $this->imageSaver = $imageSaver;
    }

    /**
     * Показывает список всех брендов
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('admin.catalog.brand.index', compact('brands'));
    }

    /**
     * Показывает форму для создания бренда
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.catalog.brand.create');
    }

    /**
     * Сохраняет новый бренд в базу данных
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandCatalogRequest $request)
    {
        $data = $request->all();
        $data['image'] = $this->imageSaver->upload($request, null, 'brand');
        $brand = Brand::create($data);
        return redirect()
            ->route('admin.catalog.brand.show', ['brand' => $brand->id])
            ->with('success', 'Новый бренд успешно создан');
    }

    /**
     * Показывает страницу бренда
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return view('admin.catalog.brand.show', compact('brand'));
    }

    /**
     * Показывает форму для редактирования бренда
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('admin.catalog.brand.edit', compact('brand'));
    }

    /**
     * Обновляет бренд (запись в таблице БД)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(BrandCatalogRequest $request, Brand $brand)
    {
        $data = $request->all();
        $data['image'] = $this->imageSaver->upload($request, $brand, 'brand');
        $brand->update($data);
        return redirect()
            ->route('admin.catalog.brand.show', ['brand' => $brand->id])
            ->with('success', 'Бренд был успешно отредактирован');
    }

    /**
     * Удаляет бренд (запись в таблице БД)
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        if ($brand->products->count()) {
            return back()->withErrors('Нельзя удалить бренд, у которого есть товары');
        }
        $this->imageSaver->remove($brand, 'brand');
        $brand->delete();
        return redirect()
            ->route('admin.catalog.brand.index')
            ->with('success', 'Бренд каталога успешно удален');
    }
}
