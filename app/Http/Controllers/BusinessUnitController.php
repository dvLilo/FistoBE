<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessUnitRequest;
use App\Http\Resources\BusinessUnitResource;
use App\Models\BusinessUnit;
use Illuminate\Http\Request;

class BusinessUnitController extends Controller
{

    public function index(Request $request)
    {
        $status =  $request['status'];
        $rows =  $request->input('rows', 10);
        $search =  $request['search'];
        $paginate = $request->input('paginate', 1);

        $business_unit = BusinessUnit::withTrashed()->where(function ($query) use ($status) {
            return $status ? $query->whereNull('deleted_at') : $query->whereNotNull('deleted_at');
        })->where(function ($query) use ($search) {
            $query->where('business_unit', 'like', '%' . $search . '%')
                ->orWhere('code', 'like', '%' . $search . '%');
        })->latest('updated_at');

        if ($paginate == 1) {
            $business_unit = $business_unit->paginate($rows);
        } else if ($paginate == 0) {
            $business_unit = $business_unit->get();
        }

        if (count($business_unit)) {
            return $this->resultResponse('fetch', 'Business Unit', BusinessUnitResource::collection($business_unit)->response()->getData(true));
        } else {
            return $this->resultResponse('not-found', 'Business Unit', []);
        }
    }


    public function store(BusinessUnitRequest $request)
    {
        $new_business_unit = BusinessUnit::create([
            'company_id' => $request->company_id,
            'code' => $request->code,
            'business_unit' => $request->business_unit,
        ]);

        $associates = $request->users;

        if (isset($associates)) {
            foreach ($associates as $associate) {
                $new_business_unit->users()->attach($associate);
            }
        }

        return $this->resultResponse('save','Business Unit', $new_business_unit);
    }


    public function show($id)
    {
        $business_unit = BusinessUnit::where('id', $id)->first();
        return $business_unit ? $this->resultResponse('fetch','Business Unit', $business_unit) : $this->resultResponse('not-found','Sub Unit', []);
    }


    public function update(BusinessUnitRequest $request, $id)
    {
        $businessunit = BusinessUnit::where('id', $id)->first();

        if ($businessunit) {
            $businessunit->update([
                'company_id' => $request->company_id,
                'code' => $request->code,
                'business_unit' => $request->business_unit,
            ]);

            $associates = $request->users;

            $businessunit->users()->detach();
            $businessunit->users()->attach($associates);

            return $this->resultResponse('update','Business Unit', $businessunit);
        } else {
            return $this->resultResponse('not-found','Business Unit', []);
        }
    }

    public function change_status($id) {
        $data = BusinessUnit::withTrashed()->find($id);

        if ($data) {
            if ($data->trashed()) {
                $data->restore();

                return $this->resultResponse("restore", 'Business Unit', []);
            } else {
                $data->delete();

                return $this->resultResponse("archive", 'Business Unit', []);
            }
        } else {

            return $this->resultResponse('not-found','Business Unit', []);
        }
    }
}
