<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;

class DashboardController extends Controller
{

    public function getListUser(Request $request)
    {
        if ($request->ajax()) {
            return $this->datatables();
        }
        return view('dashboard.listUser');
    }

    public function datatables()
    {
        $user = Admin::select(
            'admin.ID as ID',
            'admin.email as Email',
            'admin_info.first_name as FirstName',
            'admin_info.last_name as LastName',
            'admin_info.tel as Phone',
        )->leftJoin("admin_info", "admin_info.admin_ID", "=", "admin.ID")->get();
        return DataTables::of($user)
        ->editColumn('Name', function ($user)
        {
            return $user->FirstName.' '.$user->LastName;
        })
        ->make(true);
    }

    public function addNewUser(Request $request) {
        dd($request->all());
    }
}
