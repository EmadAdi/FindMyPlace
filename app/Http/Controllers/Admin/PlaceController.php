<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Requests\StorePlaceRequest;
use App\Http\Requests\UpdatePlaceRequest;
use App\Enums\Auth\AdminPermissionEnum;

class PlaceController extends Controller
{

    public function __construct()
  {
    $this->middleware('permission:' . AdminPermissionEnum::VIEW_PLACES->value)->only(['index']);
    $this->middleware('permission:' . AdminPermissionEnum::CREATE_PLACES->value)->only(['create', 'store']);
    $this->middleware('permission:' . AdminPermissionEnum::EDIT_PLACES->value)->only(['edit', 'update']);
    $this->middleware('permission:' . AdminPermissionEnum::DELETE_PLACES->value)->only(['destroy']);
 }
    public function index()
    {
        $places = Place::with('governorate')->latest()->paginate(10);
        return view('admin.places.index', compact('places'));
    }

    public function create()
    {
        $governorates = Governorate::all();
        return view('admin.places.create', compact('governorates'));
    }

public function store(StorePlaceRequest $request)
{
    Place::create($request->validated());

    return redirect()->route('admin.places.index')->with('success', 'تمت إضافة المكان.');
}

    public function edit(Place $place)
    {
        $governorates = Governorate::all();
        return view('admin.places.edit', compact('place', 'governorates'));
    }

  public function update(UpdatePlaceRequest $request, Place $place)
{
    $place->update($request->validated());

    return redirect()->route('admin.places.index')->with('success', 'تم تحديث المكان.');
}

    public function destroy(Place $place)
    {
        $place->delete();
        return back()->with('success', 'تم حذف المكان.');
    }
}
