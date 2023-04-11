<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saler;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class SalerController extends Controller
{
    public function getListSaler(Request $request) {
        if ($request->ajax()) {
            return $this->datatables();
        }
        return view('dashboard.list-saler');
    } 

    public function datatables()
    {
        $user = Saler::select(
            'saler.id as ID',
            'saler.tel as Phone',
            'saler.first_name as FirstName',
            'saler.last_name as LastName',
        )->get();

        return DataTables::of($user)
        ->editColumn('Name', function ($user)
        {
            return $user->FirstName.' '.$user->LastName;
        })
        ->make(true);
    }

    public function addNewSaler(Request $request) {
        if($request->salerId != null) {
            Saler::where("id", $request->salerId)->update([
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'tel' => $request->tel,
            ]);
        } else {
            Saler::insert([
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'tel' => $request->tel,
            ]);
        }

        return redirect()->route('saler.get');
    }

    public function salerDetail(Request $request) {
        $salerDetail = Saler::where("id", $request->id)->first();

        return response()->json(['salerDetail'=>$salerDetail]);
    }

    public function salerDelete(Request $request) {
        $userDetail = Saler::where("id", $request->id)->delete();

        return redirect()->route('saler.get');
    }
}
