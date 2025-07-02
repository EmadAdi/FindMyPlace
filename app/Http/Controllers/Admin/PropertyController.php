<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Models\Property;
use App\Enums\Enums\Media\PropertyMediaEnum;


class PropertyController extends Controller
{
       public function index()
    {
        $properties = Property::paginate();
        return view('admin.properties.index', compact('properties'));
    }


        public function create()
    {
        return view('admin.properties.create');
    }


       public function edit($id)
    { 
        $property = Property::findOrFail($id);
        return view('admin.properties.edit', compact('property'));
    }

    
public function store(StorePropertyRequest $request)
{
    // إنشاء العقار بعد التحقق من صحة البيانات
    $property = Property::create($request->validated());

    // رفع الصورة الرئيسية إن وُجدت
    if ($request->hasFile('main_image')) {
        $property->addMedia($request->file('main_image'))
                 ->toMediaCollection(
                     PropertyMediaEnum::MAIN_IMAGE->value,
                     PropertyMediaEnum::MAIN_IMAGE->disk()
                 );
    }

    // رفع صور المعرض إن وُجدت
    if ($request->hasFile('gallery')) {
        foreach ($request->file('gallery') as $file) {
            $property->addMedia($file)
                     ->toMediaCollection(
                         PropertyMediaEnum::GALLERY->value,
                         PropertyMediaEnum::GALLERY->disk()
                     );
        }
    }

    return redirect()
        ->route('admin.properties.index')
        ->with('success', 'تم إنشاء العقار بنجاح');
}

public function update(UpdatePropertyRequest $request, Property $property)
{
    // تحديث بيانات العقار
    $property->update($request->validated());

    // إن وُجدت صورة رئيسية جديدة ➜ نحذف القديمة ونضيف الجديدة
    if ($request->hasFile('main_image')) {
        $property->clearMediaCollection(PropertyMediaEnum::MAIN_IMAGE->value);
        $property->clearMediaCollection(PropertyMediaEnum::GALLERY->value);

        $property->addMedia($request->file('main_image'))
                 ->toMediaCollection(
                     PropertyMediaEnum::MAIN_IMAGE->value,
                     PropertyMediaEnum::MAIN_IMAGE->disk()
                 );
    }

    // إن وُجدت صور معرض جديدة ➜ تُضاف مع الحالية (أو احذف حسب اختيارك)
    if ($request->hasFile('gallery')) {
        foreach ($request->file('gallery') as $file) {
            $property->addMedia($file)
                     ->toMediaCollection(
                         PropertyMediaEnum::GALLERY->value,
                         PropertyMediaEnum::GALLERY->disk()
                     );
        }
    }

    return redirect()
        ->route('admin.properties.index')
        ->with('success', 'تم تحديث العقار بنجاح');
}

      public function destroy($id)
    {
       $property = Property::findOrFail($id);
       $property->delete();

       return redirect()->route('admin.properties.index')->with('success', 'تم حذف العقار بنجاح');
    }


    public function deleteMedia(Media $media)
    {
        $media->delete();
        return back()->with('success', 'تم حذف الصورة');
    }
}
