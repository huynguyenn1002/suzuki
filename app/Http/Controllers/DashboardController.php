<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\AdminInfo;
use Validator;
use Auth;

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
            'admin.is_admin as adminType',
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
            'password' => $request->password,
            'is_admin' => 0,
        ]);

        return redirect()->route('user.get');
    }

    public function getProfile(Request $request) {
        $admin = Auth::guard('admin')->user();
        $detailInfo = AdminInfo::where('admin_id', $admin->id)->first();

        $provinces = \Kjmtrue\VietnamZone\Models\Province::get();
        $districts = \Kjmtrue\VietnamZone\Models\District::get();
        $wards = \Kjmtrue\VietnamZone\Models\Ward::get();

        return view("dashboard.user-detail", compact("detailInfo", "provinces", "districts", "wards"));
    }

    public function getUserDetail(Request $request) {
        $userDetail = Admin::where("id", $request->id)->first();

        return response()->json(['admin'=>$userDetail, 'userDetail' => $userDetail->infoDetail]);
    }

    public function updateUser(Request $request) {
        $userDetail = Admin::where("id", $request->userID)->update([
            'password' => bcrypt($request->newPassword)
        ]);

        return response()->json("success");
    }

    public function deleteUser(Request $request) {
        $userDetail = Admin::where("id", $request->id)->delete();

        return redirect()->route('user.get');
    }

    public function updateProfile(Request $request) {
        // dd($request->all());
        DB::transaction(function() use($request) {
            $province_id = explode('.', $request->province)[0];
            $province = explode('.', $request->province)[1];
            $district_id = explode('.', $request->district)[0];
            $district = explode('.', $request->district)[1];
            $ward_id = explode('.', $request->ward)[0];
            $ward = explode('.', $request->ward)[1];

            $user = AdminInfo::where('admin_id', $request->userID)->first();
            if($user == null) {
                AdminInfo::create([
                    'admin_ID' => Auth::guard("admin")->user()->id,
                    'first_name' => $request->firstname,
                    'last_name' => $request->lastname,
                    'citizen_identification' => $request->citizen_identification,
                    'tel' => $request->tel,
                    'province_id' => $province_id,
                    'province_name' => $province,
                    'district_id' => $district_id,
                    'district_name' => $district,
                    'ward_id' => $ward_id,
                    'ward_name' => $ward,
                    'address' => $request->address,
                ]);
            } else {
                $user->update([
                    'first_name' => $request->firstname,
                    'last_name' => $request->lastname,
                    'citizen_identification' => $request->citizen_identification,
                    'tel' => $request->tel,
                    'province_id' => $province_id,
                    'province_name' => $province,
                    'district_id' => $district_id,
                    'district_name' => $district,
                    'ward_id' => $ward_id,
                    'ward_name' => $ward,
                    'address' => $request->address,
                ]);
            }
            
            if($request->has('password')){
                Admin::where('id', $request->userID)->update(['password'=>bcrypt($request->password)]);
            }

            if($request->hasFile('avatar')){
                $filename = $request->avatar->getClientOriginalName();
                $request->avatar->storeAs('avatar',$filename,'public');
                AdminInfo::where('admin_id', $request->userID)->update(['avatar'=>$filename]);
            }

            return redirect()->back();
        });

        return redirect('/admin/profile')->with('success', 'Cập nhật thông tin thành công');
    }

    public function adminGetDistrictInfo(Request $request) {
        $data = $request->all();
        $user = Auth::guard('admin')->user();

        $district = DB::table("districts")->select('*')->where("districts.province_id", '=', $data["provinceCode"])->get();
        $returnView = view("dashboard.admin-get-district")->with(['options' => $district, 'user' => $user])->render();
        return response()->json(["html" => $returnView], 200);
    }

    public function adminGetWardInfo(Request $request) {
        $data = $request->all();
        $user = Auth::guard('admin')->user();

        $districtCode = array_key_exists("districtCode", $data) ? $data["districtCode"] : "";

        if (!empty($data["districtCodeDetail"])) {
            $districtCode = $data["districtCodeDetail"];
        } 

        $ward = DB::table("wards")->select('*')->where("wards.district_id", '=', $districtCode)->get();

        $returnView = view("dashboard.admin-get-ward")->with(['options' => $ward, 'user' => $user])->render();
        return response()->json(["html" => $returnView], 200);
    }
}
