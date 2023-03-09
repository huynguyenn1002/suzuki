<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Validator;
use Yajra\DataTables\DataTables;
use App\Models\AdminInfo;
use App\Models\Contract;

class ContractController extends Controller
{
    public function getContractList(Request $request)
    {
        if ($request->ajax()) {
            return $this->datatables();
        }
        return view('contract.contract-list');
    }

    public function datatables()
    {
        $contract = Contract::select(
            'contract.contract_num as contractNum',
            'contract.contract_type as contractType',
            'contract.contract_sign_date as contractSignDate',
            'contract.customer_name as cusName',
            'admin_info.first_name as FirstName',
            'admin_info.last_name as LastName',
        )
        ->leftJoin("admin", "admin.id", "=", "contract.admin_id")
        ->leftJoin("admin_info", "admin_info.admin_ID", "=", "admin.id")
        ->get();

        return DataTables::of($contract)
        ->editColumn('saleName', function ($contract)
        {
            return $contract->FirstName.' '.$contract->LastName;
        })
        ->make(true);
    }


    public function getContractForm()
    {
        $provinces = \Kjmtrue\VietnamZone\Models\Province::get();
        $districts = \Kjmtrue\VietnamZone\Models\District::get();
        $wards = \Kjmtrue\VietnamZone\Models\Ward::get();
        $car = DB::table("suzuki_car")->get();
        $checkUserLogin = Auth::guard("admin")->user();

        $sale = AdminInfo::select(
            'admin_info.first_name as FirstName',
            'admin_info.admin_ID as SaleID',
            'admin_info.last_name as LastName',
            'admin_info.citizen_identification as CCCD',
            'admin_info.tel as Phone',
        )->where("admin_info.admin_ID", $checkUserLogin->id)->first();

        return view("contract.contract-create", compact('sale', 'provinces', 'districts', 'wards', 'car'));
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

        $price = number_format($type->price, 0, '', ',');

        return response()->json(['success'=>$type, 'price'=>$price]);
    }

    public function createContract(Request $request) {
        // dd($request->all());
        DB::transaction(function() use($request) {
            if ($request->province != null) {
                $province_id = explode('.', $request->province)[0];
                $province = explode('.', $request->province)[1];
            } else {
                $province_id = null;
                $province = null;
            }

            if ($request->district != null) {
                $district_id = explode('.', $request->district)[0];
                $district = explode('.', $request->district)[1];
            } else {
                $district_id = null;
                $district = null;
            }

            if ($request->ward != null) {
                $ward_id = explode('.', $request->ward)[0];
                $ward = explode('.', $request->ward)[1];
            } else {
                $ward_id = null;
                $ward = null;
            }

            if ($request->noticePrice != null) {
                $notice_price = str_replace('.', '', preg_replace('/,/', '', $request->noticePrice));
            } else {
                $notice_price = null;
            } 

            if ($request->realPrice != null) {
                $real_price = str_replace('.', '', preg_replace('/,/', '', $request->realPrice));
            } else {
                $real_price = null;
            } 

            if ($request->invoiceSellingPrice != null) {
                $invoice_selling_price = str_replace('.', '', preg_replace('/,/', '', $request->invoiceSellingPrice));
            } else {
                $invoice_selling_price = null;
            } 

            if ($request->deposit != null) {
                $deposit = str_replace('.', '', preg_replace('/,/', '', $request->deposit));
            } else {
                $deposit = null;
            } 

            if ($request->paymentAmount != null) {
                $payment_amount = str_replace('.', '', preg_replace('/,/', '', $request->paymentAmount));
            } else {
                $payment_amount = null;
            } 

            Contract::create([
                'contract_num' => $request->contractNum, 
                'contract_type' => $request->contractType, 
                'contract_sign_date' => $request->contractSignDate,
                'admin_id' => $request->salesConsultant,
                'customer_name' => $request->customerName,
                'customer_gender' => $request->customerGender,
                'customer_birthday' => $request->customerBirthday,
                'province_id' => $province_id,
                'district_id' => $district_id,
                'ward_id' => $ward_id,
                'province_name' => $province,
                'district_name' => $district,
                'ward_name' => $ward,
                'address' => $request->address,
                'customer_phone' => $request->customerPhone,
                'customer_id_card' => $request->customerIDCard,
                'customer_id_card_register' => $request->icCardDateRegister,
                'issued_by' => $request->issuedBy,
                'mail_address' => $request->mailAddress,
                'car_id' => $request->carID,
                'car_type' => $request->carType,
                'car_color' => $request->carColor,
                'notice_price' => $notice_price,
                'real_price' => $real_price,
                'invoice_selling_price' => $invoice_selling_price,
                'amount' => $request->amount,
                'deposit' => $deposit,
                'car_delivery_time' => $request->carDeliveryTime,
                'promotion' => $request->promotionalContent,
                'gift' => $request->gift,
                'chassis_number' => $request->chassisNumber,
                'engine_number' => $request->engineNumber,
                'pdi_time' => $request->pdiTime,
                'pdi_confirm_time' => $request->pdiConfirmTime,
                'note' => $request->note,
                'dnxhs_date' => $request->dnxhsDate,
                'payment_date' => $request->paymentDate,
                'payment_amount' => $payment_amount,
                'receipt_type' => $request->receiptType,
                'banking_from' => $request->bankingFrom,
                'banking_to' => $request->bankingTo,
            ]);
            return redirect()->back();
            
        });
        return redirect()->route('contract.list.get')->with('success', 'Cập nhật thông tin thành công');
    }

    public function previewContract(Request $request) {
        // dd($request->all());
        $province_id = explode('.', $request->province)[0];
        $district_id = explode('.', $request->district)[0];
        $ward_id = explode('.', $request->ward)[0];

        $province = \Kjmtrue\VietnamZone\Models\Province::where("provinces.id", $province_id)->first();
        $district = \Kjmtrue\VietnamZone\Models\District::where("districts.id", $district_id)->first();
        $ward = \Kjmtrue\VietnamZone\Models\Ward::where("wards.id", $ward_id)->first();
        $car = DB::table("suzuki_car")->where("suzuki_car.id", $request->carID)->first();

        $validator = Validator::make($request->all(), [
            'contractNum' => 'string|max:45|unique:contract,contract_num',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $dataPreview = $request->all();

        return view("contract.preview-contract", compact('dataPreview', 'province', 'district', 'ward', 'car'));
    }

}