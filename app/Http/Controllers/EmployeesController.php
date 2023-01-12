<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;

class EmployeesController extends Controller
{

    public function index()
    {

        $data['cities'] = Employees::distinct()->get(['city']);

        return view('index', $data);
    }

    // Fetch DataTable data
    public function getEmployees(Request $request)
    {

        // Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Custom search filter 
        $searchCity = $request->get('searchCity');
        $searchGender = $request->get('searchGender');
        $searchName = $request->get('searchName');

        // Total records
        $records = Employees::select('count(*) as allcount');

        // Add custom filter conditions
        if (!empty($searchCity)) {
            $records->where('city', $searchCity);
        }
        if (!empty($searchGender)) {
            $records->where('gender', $searchGender);
        }
        if (!empty($searchName)) {
            $records->where('name', 'like', '%' . $searchName . '%');
        }
        $totalRecords = $records->count();

        // Total records with filter
        $records = Employees::select('count(*) as allcount')->where('name', 'like', '%' . $searchValue . '%');

        // Add custom filter conditions
        if (!empty($searchCity)) {
            $records->where('city', $searchCity);
        }
        if (!empty($searchGender)) {
            $records->where('gender', $searchGender);
        }
        if (!empty($searchName)) {
            $records->where('name', 'like', '%' . $searchName . '%');
        }
        $totalRecordswithFilter = $records->count();

        // Fetch records
        $records = Employees::orderBy($columnName, $columnSortOrder)
            ->select('employees.*')
            ->where('employees.name', 'like', '%' . $searchValue . '%');
        // Add custom filter conditions
        if (!empty($searchCity)) {
            $records->where('city', $searchCity);
        }
        if (!empty($searchGender)) {
            $records->where('gender', $searchGender);
        }
        if (!empty($searchName)) {
            $records->where('name', 'like', '%' . $searchName . '%');
        }
        $employees = $records->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();
        foreach ($employees as $employee) {

            $username = $employee->username;
            $name = $employee->name;
            $email = $employee->email;
            $gender = $employee->gender;
            $city = $employee->city;

            $data_arr[] = array(
                "username" => $username,
                "name" => $name,
                "email" => $email,
                "gender" => $gender,
                "city" => $city,
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        return response()->json($response);
    }
}
