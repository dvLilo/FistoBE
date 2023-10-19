<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubUnitRequest;
use App\Http\Resources\SubUnitResource;
use App\Models\SubUnit;
use Symfony\Component\HttpFoundation\Request;

class SubUnitController extends Controller
{
    public function index(Request $request)
    {
        $status =  $request['status'];
        $rows =  $request->input('rows', 10);
        $search =  $request['search'];
        $paginate = $request->input('paginate', 1);

        $subunit = SubUnit::withTrashed()
            ->where(function ($query) use ($status) {
            return $status ? $query->whereNull('deleted_at') : $query->whereNotNull('deleted_at');
        })->where(function ($query) use ($search) {
            $query->where('subunit', 'like', '%' . $search . '%')
                ->orWhere('code', 'like', '%' . $search . '%');
        })->select(['id','code', 'subunit','updated_at', 'deleted_at', 'department_id'])
            ->latest('updated_at');

        if ($paginate == 1) {
            $subunit = $subunit->paginate($rows);
        } else if ($paginate == 0) {
            $subunit = $subunit->get(['id','code', 'subunit']);
        }
        $subunit->transform(function ($value) {
            return [
                'id' => $value->id,
                'code' => $value->code,
                'subunit' => $value->subunit,
                'department' => [
                    'id' => $value->department->id,
                    'name' => $value->department->department,
                ],
                'updated_at' => $value->updated_at->format('d-m-Y'),
                'deleted_at' => $value->deleted_at,
            ];
        });

        if (count($subunit)) {
            return $this->resultResponse('fetch', 'Sub Unit', $subunit);
        } else {
            return $this->resultResponse('not-found', 'Sub Unit', []);
        }
    }

    public function store(SubUnitRequest $request)
    {
        $new_subunit = SubUnit::create([
            'department_id' => $request->department_id,
            'code' => $request->code,
            'subunit' => $request->subunit,
        ]);

        return $this->resultResponse('save','Sub Unit', $new_subunit);
    }

    public function show($id)
    {
        $subunit = SubUnit::where('id', $id)->first();
        return $subunit ? $this->resultResponse('fetch','Sub Unit', $subunit) : $this->resultResponse('not-found','Sub Unit', []);
    }

    public function update(SubUnitRequest $request, $id)
    {
        $subunit = SubUnit::where('id', $id)->first();

        if ($subunit) {
            $subunit->update([
                'department_id' => $request->department_id,
                'code' => $request->code,
                'subunit' => $request->subunit,
            ]);

            return $this->resultResponse('update','Sub Unit', $subunit);
        } else {
            return $this->resultResponse('not-found','Sub Unit', []);
        }
    }

    public function change_status($id)
    {
        $data = SubUnit::withTrashed()->find($id);

        if ($data) {
            if ($data->trashed()) {
                $data->restore();

                return $this->resultResponse("restore", 'Sub unit', []);
            } else {
                $data->delete();

                return $this->resultResponse("archive", 'Sub unit', []);
            }
        } else {

            return $this->resultResponse('not-found','Sub Unit', []);
        }
    }
}
