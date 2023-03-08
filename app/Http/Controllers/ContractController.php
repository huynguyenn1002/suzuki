<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\AdminInfo;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getContractForm()
    {
        $provinces = \Kjmtrue\VietnamZone\Models\Province::get();
        $districts = \Kjmtrue\VietnamZone\Models\District::get();
        $wards = \Kjmtrue\VietnamZone\Models\Ward::get();
        $car = DB::table("suzuki_car")->get();
        $checkUserLogin = Auth::guard("admin")->user();

        $sale = AdminInfo::select(
            'admin_info.first_name as FirstName',
            'admin_info.last_name as LastName',
            'admin_info.citizen_identification as CCCD',
            'admin_info.tel as Phone',
        )->where("admin_info.admin_ID", $checkUserLogin->id)->first();

        return view("contract.tabs", compact('sale', 'provinces', 'districts', 'wards', 'car'));
    }

    public function adminGetDistrictInfo(Request $request) {
        $data = $request->all();
        $user = Auth::guard('admin')->user();

        $district = DB::table("districts")->select('*')->where("districts.province_id", '=', $data["provinceCode"])->get();
        $returnView = view("contract.admin-get-district")->with(['options' => $district, 'admin' => $user])->render();
        return response()->json(["html" => $returnView, "district_id" => $user->district_id], 200);
    }

    public function adminGetWardInfo(Request $request) {
        $data = $request->all();
        $user = Auth::guard('admin')->user();

        $ward = DB::table("wards")->select('*')->where("wards.district_id", '=', $data["districtCode"])->get();
        $returnView = view("contract.admin-get-ward")->with(['options' => $ward, 'admin' => $user])->render();
        return response()->json(["html" => $returnView], 200);
    }

    public function getTypeCar(Request $request) {

        $type = DB::table("suzuki_car")->where("suzuki_car.id", $request->car_id)->first();

        return response()->json(['success'=>$type]);
    }

}
