<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGovernorateRequest;
use App\Http\Requests\UpdateGovernorateRequest;
use App\Enums\Auth\AdminPermissionEnum;

class GovernorateController extends Controller
{
    public function __construct()
  {
    $this->middleware('permission:' . AdminPermissionEnum::VIEW_GOVERNORATES->value)->only(['index']);
    $this->middleware('permission:' . AdminPermissionEnum::CREATE_GOVERNORATES->value)->only(['create', 'store']);
    $this->middleware('permission:' . AdminPermissionEnum::EDIT_GOVERNORATES->value)->only(['edit', 'update']);
    $this->middleware('permission:' . AdminPermissionEnum::DELETE_GOVERNORATES->value)->only(['destroy']);
 }
    public function index()
    {
        $governorates = Governorate::latest()->paginate(10);
        return view('admin.governorates.index', compact('governorates'));
    }

    public function create()
    {
        return view('admin.governorates.create');
    }

    public function store(StoreGovernorateRequest $request)
  {
    Governorate::create($request->validated());

    return redirect()->route('admin.governorates.index')->with('success', 'تمت إضافة المحافظة.');
  }

    public function edit(Governorate $governorate)
    {
        return view('admin.governorates.edit', compact('governorate'));
    }

    public function update(UpdateGovernorateRequest $request, Governorate $governorate)
  {
    $governorate->update($request->validated());

    return redirect()->route('admin.governorates.index')->with('success', 'تم تحديث المحافظة.');
  }

    public function destroy(Governorate $governorate)
    {
        $governorate->delete();
        return back()->with('success', 'تم حذف المحافظة.');
    }
}
