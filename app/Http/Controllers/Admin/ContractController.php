<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\ContractStatus;
use App\Enums\ContractDuration;
use App\Enums\Auth\AdminPermissionEnum;
use App\Models\Contract;
use App\Models\Property;
use App\Models\User;
use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateontractRequest;

class ContractController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:' . AdminPermissionEnum::VIEW_CONTRACTS->value)->only('index');
        $this->middleware('permission:' . AdminPermissionEnum::CREATE_CONTRACTS->value)->only(['create', 'store']);
        $this->middleware('permission:' . AdminPermissionEnum::EDIT_CONTRACTS->value)->only(['edit', 'update']);
        $this->middleware('permission:' . AdminPermissionEnum::DELETE_CONTRACTS->value)->only('destroy');
    }

    public function index()
    {
        $contracts = Contract::with(['user', 'property'])->latest()->paginate(10);
        return view('admin.contracts.index', compact('contracts'));
    }

    public function create()
    {
        $users = User::all();
        $properties = Property::all();
        $statuses = ContractStatus::cases();
        $durations = ContractDuration::cases();

        return view('admin.contracts.create', compact('users', 'properties', 'statuses', 'durations'));
    }

    public function store(StoreContractRequest $request)
   {
    Contract::create($request->validated());

    return redirect()
        ->route('admin.contracts.index')
        ->with('success', 'Contract created successfully.');
  }

   public function edit($id)
 {
    $contract = Contract::findOrFail($id); // يبحث عن العقد حسب الـ ID
    $users = User::all();
    $properties = Property::all();
    $statuses = ContractStatus::cases();
    $durations = ContractDuration::cases();

    return view('admin.contracts.edit', compact('contract', 'users', 'properties', 'statuses', 'durations'));
 }


    public function update(UpdateContractRequest $request, Contract $contract)
  {
    $contract->update($request->validated());

    return redirect()
        ->route('admin.contracts.index')
        ->with('success', 'Contract updated successfully.');
 }
   public function destroy($id)
  {
    $contract = Contract::findOrFail($id);
    $contract->delete(); // سيتم تنفيذ soft delete

    return redirect()->route('admin.contracts.index')->with('success', 'Contract deleted successfully.');
  }
  public function restore($id)
 {
    $contract = Contract::withTrashed()->findOrFail($id);
    $contract->restore();

    return redirect()->route('admin.contracts.index')->with('success', 'Contract restored successfully.');
 }

}
