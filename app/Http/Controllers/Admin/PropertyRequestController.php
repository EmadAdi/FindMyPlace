<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\Auth\AdminPermissionEnum;
use App\Http\Requests\UpdatePropertyRequestStatusRequest;
use App\Models\PropertyRequest;
use App\Enums\PropertyRequestStatus;

class PropertyRequestController extends Controller
{
      public function __construct()
    {
        $this->middleware('permission:' . AdminPermissionEnum::VIEW_PROPERTYREQUESTS->value)->only('index');
        $this->middleware('permission:' . AdminPermissionEnum::APPROVE_PROPERTYREQUESTS->value)->only('approve');
        $this->middleware('permission:' . AdminPermissionEnum::REJECT_PROPERTYREQUESTS->value)->only('reject');
    }

    public function index()
    {
        $requests = PropertyRequest::with('user', 'media')->latest()->paginate(10);
        return view('admin.property_requests.index', compact('requests'));
    }

    public function approve(UpdatePropertyRequestStatusRequest $request, $id)
    {
        $requestModel = PropertyRequest::findOrFail($id);
        $requestModel->update(['status' => PropertyRequestStatus::APPROVED->value]);

        return back()->with('success', 'Request approved.');
    }

    public function reject(UpdatePropertyRequestStatusRequest $request, $id)
    {
        $requestModel = PropertyRequest::findOrFail($id);
        $requestModel->update(['status' => PropertyRequestStatus::REJECTED->value]);

        return back()->with('success', 'Request rejected.');
    }
}
