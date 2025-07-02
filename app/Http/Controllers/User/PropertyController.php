<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Governorate;
use App\Models\Place;
use App\Enums\PropertyStatus;
use App\Enums\PropertyType;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::query()
            ->where('status', PropertyStatus::AVAILABLE->value);

        if ($request->filled('governorate_id')) {
            $query->where('governorate_id', $request->governorate_id);
        }

        if ($request->filled('place_id')) {
            $query->where('place_id', $request->place_id);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        if ($request->filled('area_min')) {
            $query->where('area', '>=', $request->area_min);
        }

        if ($request->filled('area_max')) {
            $query->where('area', '<=', $request->area_max);
        }

        $properties = $query->with('media')->latest()->paginate(12);

        return view('user.properties.index', [
            'properties' => $properties,
            'governorates' => Governorate::all(),
            'places' => Place::all(),
            'types' => PropertyType::cases(),
            'statuses' => PropertyStatus::cases(),
            'filters' => $request->all(),
        ]);
    }
}
