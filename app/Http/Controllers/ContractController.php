<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Validator;
use Yajra\DataTables\DataTables;
use App\Models\AdminInfo;
use App\Models\Contract;
use PDF;

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
            'contract.id as ID',
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
            'admin_info.admin_ID as SaleID',
            'admin_info.first_name as FirstName',
            'admin_info.last_name as LastName',
            'admin_info.tel as Phone',
        )->where("admin_info.admin_ID", $checkUserLogin->id)->first();

        return view("contract.contract-create", compact('sale', 'provinces', 'districts', 'wards', 'car'));
    }

    public function adminGetDistrictInfo(Request $request) {
        $data = $request->all();
        if (!empty($data["idContract"])) {
            $contractDetail = Contract::where("id", $data["idContract"])->first();
        } else {
            $contractDetail = null;
        }

        if (!empty($data["detailProvinceID"])) {
            $data["provinceCode"] = $data["detailProvinceID"];
        }
        $user = Auth::guard('admin')->user();

        $district = DB::table("districts")->select('*')->where("districts.province_id", '=', $data["provinceCode"])->get();
        $returnView = view("contract.admin-get-district")->with(['contract' => $contractDetail,'options' => $district, 'user' => $user])->render();
        return response()->json(["html" => $returnView, "district_id" => $user->district_id], 200);
    }

    public function adminGetWardInfo(Request $request) {
        $data = $request->all();
        $user = Auth::guard('admin')->user();
        if (!empty($data["districtCodeDetail"])) {
            $data["districtCode"] = $data["districtCodeDetail"];
        }

        if (!empty($data["idContract"])) {
            $contractDetail = Contract::where("id", $data["idContract"])->first();
        } else {
            $contractDetail = null;
        }

        $ward = DB::table("wards")->select('*')->where("wards.district_id", '=', $data["districtCode"])->get();
        $returnView = view("contract.admin-get-ward")->with(['contract' => $contractDetail, 'options' => $ward, 'user' => $user])->render();
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
                'customer_type' => $request->customerType,
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
                'amount' => $request->amount,
                'deposit' => $deposit,
                'car_delivery_time' => $request->carDeliveryTime,
                'promotion' => $request->promotionalContent,
                'gift' => $request->gift,
            ]);
            return redirect()->back();
            
        });
        return redirect()->route('contract.list.get')->with('success', 'Tạo hợp đồng thành công');
    }

    public function updateContract(Request $request) {
        // dd($request->all());
        DB::transaction(function() use($request) {
            $contractNum = $request->headerContract."-".$request->contractNum;
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

            if ($request->deposit != null) {
                $deposit = str_replace('.', '', preg_replace('/,/', '', $request->deposit));
            } else {
                $deposit = null;
            } 

            Contract::where("id", $request->id)->update([
                'contract_num' => $contractNum, 
                'contract_type' => $request->contractType, 
                'customer_type' => $request->customerType,
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
                'amount' => $request->amount,
                'deposit' => $deposit,
                'car_delivery_time' => $request->carDeliveryTime,
                'promotion' => $request->promotionalContent,
                'gift' => $request->gift,
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

    public function contractDetail(Request $request) {
        $contractID = $request->get('contractID');
        $contractDetail = Contract::where("id", $contractID)->first();
        // dd($contractDetail);

        $provinces = \Kjmtrue\VietnamZone\Models\Province::get();
        $districts = \Kjmtrue\VietnamZone\Models\District::get();
        $wards = \Kjmtrue\VietnamZone\Models\Ward::get();
        $car = DB::table("suzuki_car")->get();
        $sale = AdminInfo::select(
            'admin_info.admin_ID as SaleID',
            'admin_info.first_name as FirstName',
            'admin_info.last_name as LastName',
            'admin_info.tel as Phone',
        )->where("admin_info.admin_ID", $contractDetail->admin_id)->first();

        // dd($contractDetail);

        return view("contract.contract-detail", compact('contractDetail', 'provinces', 'districts', 'wards', 'car', 'sale'));
    }

    public function contractExport(Request $request) 
    {
        // ini_set('max_execution_time', 300);

        // $dataExport = Contract::where("id", $request->contractID)->first()->toArray();

        // dd($dataExport);

        // $pdf = PDF::loadView('contract.contract', $dataExport)->setPaper('a4', 'portrait');
        // $pdf = PDF::loadView('contract.contract', $dataExport);

        // return $pdf->stream();
    }

    public function printPreviewContract($id) {
        $contract = Contract::where("id", $id)->first();
        $noticePrice = $this->convert_number_to_words($contract->notice_price);
        $realPrice = $this->convert_number_to_words($contract->real_price);
        $depositAmount = $this->convert_number_to_words($contract->deposit);

        $contract = Contract::where("id", $id)->first();
        $saler = AdminInfo::where("id", $contract->admin_id)->first();
        $car = DB::table("suzuki_car")->where("id", $contract->car_id)->first();

        return view('contract.contract', compact('contract', 'saler', 'car', 'noticePrice', 'realPrice', 'depositAmount'));
    }

    public function convert_number_to_words($number) {
		$hyphen      = ' ';
		$conjunction = ' ';
		$separator   = ' ';
		$negative    = 'âm ';
		$decimal     = ' phẩy ';
		$one		 = 'mốt';
		$ten         = 'lẻ';
		$dictionary  = array(
		0                   => 'Không',
		1                   => 'Một',
		2                   => 'Hai',
		3                   => 'Ba',
		4                   => 'Bốn',
		5                   => 'Năm',
		6                   => 'Sáu',
		7                   => 'Bảy',
		8                   => 'Tám',
		9                   => 'Chín',
		10                  => 'Mười',
		11                  => 'Mười một',
		12                  => 'Mười hai',
		13                  => 'Mười ba',
		14                  => 'Mười bốn',
		15                  => 'Mười lăm',
		16                  => 'Mười sáu',
		17                  => 'Mười bảy',
		18                  => 'Mười tám',
		19                  => 'Mười chín',
		20                  => 'Hai mươi',
		30                  => 'Ba mươi',
		40                  => 'Bốn mươi',
		50                  => 'Năm mươi',
		60                  => 'Sáu mươi',
		70                  => 'Bảy mươi',
		80                  => 'Tám mươi',
		90                  => 'Chín mươi',
		100                 => 'trăm',
		1000                => 'nghìn',
		1000000             => 'triệu',
		1000000000          => 'tỷ',
		1000000000000       => 'nghìn tỷ',
		1000000000000000    => 'ngàn triệu triệu',
		1000000000000000000 => 'tỷ tỷ'
		);
		 
		if (!is_numeric($number)) {
			return false;
		}
		 
		if ($number < 0) {
			return $negative . $this->convert_number_to_words(abs($number));
		}
		 
		$string = $fraction = null;
		 
		if (strpos($number, '.') !== false) {
			list($number, $fraction) = explode('.', $number);
		}
		 
		switch (true) {
			case $number < 21:
				$string = $dictionary[$number];
			break;
			case $number < 100:
				$tens   = ((int) ($number / 10)) * 10;
				$units  = $number % 10;
				$string = $dictionary[$tens];
				if ($units) {
					$string .= strtolower( $hyphen . ($units==1?$one:$dictionary[$units]) );
				}
			break;
			case $number < 1000:
				$hundreds  = $number / 100;
				$remainder = $number % 100;
				$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
				if ($remainder) {
					$string .= strtolower( $conjunction . ($remainder<10?$ten.$hyphen:null) . $this->convert_number_to_words($remainder) );
				}
			break;
			default:
				$baseUnit = pow(1000, floor(log($number, 1000)));
				$numBaseUnits = (int) ($number / $baseUnit);
				$remainder = $number - ($numBaseUnits*$baseUnit);
				$string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
				if ($remainder) {
					$string .= strtolower( $remainder < 100 ? $conjunction : $separator );
					$string .= strtolower( $this->convert_number_to_words($remainder) );
				}
			break;
		}
		 
		if (null !== $fraction && is_numeric($fraction)) {
			$string .= $decimal;
			$words = array();
			foreach (str_split((string) $fraction) as $number) {
				$words[] = $dictionary[$number];
			}
			$string .= implode(' ', $words);
		}
		 
		return $string;
	}

}