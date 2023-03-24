<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use Validator;
use Illuminate\Support\Facades\Hash;

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
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:255',
            'password' => 'required|string',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Admin::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => 0,
        ]);

        return redirect()->route('user.get');
    }
}
