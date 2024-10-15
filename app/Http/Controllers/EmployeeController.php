<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Validator;

class EmployeeController extends Controller
{
    
    public function index()
    {

        $employees = Employee::all();

        $data = [
            'status' => 200,
            'employee' => $employees
        ];

        if ($employees->count() <= 0) {

            return response()->json(['message' => "No data found"], 404);

        } else {

            return response()->json($data, 200);

        }

    }

    public function store(Request $request)
    {

        $validator_istrue = true;

        if ($request->position === "CEO") {

            $validator = Validator::make($request->all(), [

                'position' => 'required|unique:employees,position',
                'report_to' => 'nullable|in:null'

            ]);

            if ($validator->fails()) {

                $validator_istrue = false;

            }

        } else {

            $validator = Validator::make($request->all(), [

                'position' => 'required|unique:employees,position',
                'report_to' => 'required|exists:employees,position'

            ]);

            if ($validator->fails()) {

                $validator_istrue = false;

            }

        }

        if (! $validator_istrue) {

            $data = [

                'status' => 422,
                'message' => $validator->messages()

            ];

            return response()->json($data, 422);

        } else {

            $employee = new Employee;

            $employee->position = $request->position;
            $employee->report_to = $request->report_to;

            $employee->save();

            $data = [

                'status' => 200,
                'message' => 'Data stored successfully.'

            ];

            return response()->json($data, 200);

        }

    }

    public function update(Request $request, $id)
    {

        $employee = Employee::find($id);

        $validator_istrue = true;

        if ($employee->position === $request->position) {

            if ($request->position === "CEO") {

                $validator = Validator::make($request->all(), [
    
                    'position' => 'required',
                    'report_to' => 'nullable|in:null'
    
                ]);
    
                if ($validator->fails()) {
    
                    $validator_istrue = false;
    
                }
    
            } else {
    
                $validator = Validator::make($request->all(), [
    
                    'position' => 'required',
                    'report_to' => 'required|exists:employees,position'
    
                ]);
    
                if ($validator->fails()) {
    
                    $validator_istrue = false;
    
                }
    
            }

        } else {

            if ($request->position === "CEO") {

                $validator = Validator::make($request->all(), [
    
                    'position' => 'required|unique:employees,position',
                    'report_to' => 'nullable|in:null'
    
                ]);
    
                if ($validator->fails()) {
    
                    $validator_istrue = false;
    
                }
    
            } else {
    
                $validator = Validator::make($request->all(), [
    
                    'position' => 'required|unique:employees,position',
                    'report_to' => 'required|exists:employees,position'
    
                ]);
    
                if ($validator->fails()) {
    
                    $validator_istrue = false;
    
                }
    
            }    

        }

        if (! $validator_istrue) {

            $data = [

                'status' => 422,
                'message' => $validator->messages()

            ];

            return response()->json($data, 422);

        } else {

            $employee->position = $request->position;
            $employee->report_to = $request->report_to;

            $employee->save();

            $data = [

                'status' => 200,
                'message' => 'Data updated successfully.'

            ];

            return response()->json($data, 200);

        }

    }

    public function delete(Request $request, $id)
    {

        $employee = Employee::find($id);

        $employee->delete();

        $data = [

            'status' => 200,
            'message' => 'Data deleted successfully.'

        ];

        return response()->json($data, 200);

    }

    public function view(Request $request, $id)
    {

        $employee = Employee::find($id);

        $data = [
            'status' => 200,
            'employee' => $employee
        ];

        if (! $employee) {

            return response()->json(['message' => "No data found"], 404);

        } else {

            return response()->json($data, 200);

        }

    }

    public function sort()
    {

        $employees = Employee::orderBy('position', 'asc')->get();

        $data = [
            'status' => 200,
            'employee' => $employees
        ];

        if ($employees->count() <= 0) {

            return response()->json(['message' => "No data found"], 404);

        } else {

            return response()->json($data, 200);

        }

    }

    public function search(Request $request)
    {

        $search = $request->input('search');

        $employees = Employee::where('position', 'like', '%' . $search . '%')->get();

        $data = [
            'status' => 200,
            'employee' => $employees
        ];

        if (! $employees) {

            return response()->json(['message' => "No data found"], 404);

        } else {

            return response()->json($data, 200);

        }

    }

}
