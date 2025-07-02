<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\Auth\AdminPermissionEnum;
use App\Models\Discount;
use App\Models\Property;
use App\Http\Requests\StoreDiscountRequest;
use App\Http\Requests\UpdateDiscountRequest;

class DiscountController extends Controller
{
     public function __construct()
    {
        $this->middleware('permission:' . AdminPermissionEnum::VIEW_DISCOUNTS->value)->only('index');
        $this->middleware('permission:' . AdminPermissionEnum::CREATE_DISCOUNTS->value)->only(['create', 'store']);
        $this->middleware('permission:' . AdminPermissionEnum::EDIT_DISCOUNTS->value)->only(['edit', 'update']);
        $this->middleware('permission:' . AdminPermissionEnum::DELETE_DISCOUNTS->value)->only('destroy');
    }

    public function index()
    {
        $discounts = Discount::with('property')->latest()->paginate(10);
        return view('admin.discounts.index', compact('discounts'));
    }

    public function create()
    {
        $properties = Property::all();
        return view('admin.discounts.create', compact('properties'));
    }
    public function store(StoreDiscountRequest $request)
   {
       Discount::create($request->validated());
        return redirect()
              ->route('admin.discounts.index')
              ->with('success', 'Discount created successfully.');
   }   
       public function edit($id)
    {
        $discount = Discount::findOrFail($id);
        $properties = Property::all();

        return view('admin.discounts.edit', compact('discount', 'properties'));
    }
    public function update(UpdateDiscountRequest $request, Discount $discount)
   {
       $discount->update($request->validated());

        return redirect()
              ->route('admin.discounts.index')
              ->with('success', 'Discount updated successfully.');
   }

   public function destroy($id)
    {
        $discount = Discount::findOrFail($id);
        $discount->delete();

        return redirect()->route('admin.discounts.index')->with('success', 'Discount deleted.');
    }

}
