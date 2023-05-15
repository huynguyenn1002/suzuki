@extends('layout.master')
@section('header_section')
<link href="{{ asset('css/dashboard/preview.css') }}" rel="stylesheet">
@endsection
@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <h1 class="mb-3"><strong>Quản lý hợp đồng</strong></h1>
        <form action="{{ route('contract.form.register') }}" method="POST">
            @csrf
            <div class="row">
                <div class="card flex-fill w-100">
                    <div class="card-header list-title">
                        <h2 class="card-title mb-0">Thông tin hợp đồng</h2>
                        <div>
                            <button id="back_btn" class="btn btn-link" type="button">Quay lại</button>
                            <button class="btn btn-primary" type="submit">Tạo hợp đồng</button>
                        </div>
                    </div>
                    <div class="card-body py-3">
                        <div class="row">
                            <div class="col">
                                <div>
                                    <label for="contractNum">
                                        <h4>Số hợp đồng</h4>
                                    </label>
                                    <input type="text" readOnly class="form-control" id="contractNum" name="contractNum"
                                        value="{{ (isset($dataPreview['headerContract']) && isset($dataPreview['contractNum'])) ? $dataPreview['headerContract'].''.$dataPreview['contractNum'] : ''}}">
                                </div>
                                <div>
                                    @php
                                    $contractType = "";
                                    if(isset($dataPreview['contractType']) && $dataPreview['contractType'] == 1) {
                                        $contractType = "Trả thẳng";
                                    } else if(isset($dataPreview['contractType']) && $dataPreview['contractType'] == 2) {
                                        $contractType = "Trả góp";
                                    } else {
                                    $gender = "";
                                    }
                                    @endphp
                                    <label for="contractType">
                                        <h4>Loại hợp đồng</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" 
                                        value="{{ $contractType }}">
                                    <input id="contractType" name="contractType" type="hidden" value="{{ isset($dataPreview['contractType']) ? $dataPreview['contractType'] : '' }}">
                                </div>
                                <div>
                                    @php
                                    $customerType = "";
                                    if(isset($dataPreview['customerType']) && $dataPreview['customerType'] == 1) {
                                        $customerType = "Cá nhân";
                                    } else if(isset($dataPreview['customerType']) && $dataPreview['customerType'] == 2) {
                                        $customerType = "Doanh nghiệp";
                                    } else {
                                        $customerType = "";
                                    }
                                    @endphp
                                    <label for="customerType">
                                        <h4>Kiểu hợp đồng</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control"
                                        value="{{ $customerType }}">
                                    <input id="customerType" name="customerType" type="hidden" value="{{ isset($dataPreview['customerType']) ? $dataPreview['customerType'] : '' }}">
                                </div>
                            </div>
                            <div class="col">
                                <div>
                                    <label for="contractSignDate">
                                        <h4>Ngày ký hợp đồng</h4>
                                    </label>
                                    <input readOnly type="date" class="form-control" id="contractSignDate"
                                        name="contractSignDate"
                                        value="{{ isset($dataPreview['contractSignDate']) ? $dataPreview['contractSignDate'] : '' }}">
                                </div>
                                <div>
                                    <label for="salesConsultant">
                                        <h4>Tư vấn Bán hàng</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" value="{{ isset($saler) ? $saler->first_name.' '.$saler->last_name : '' }}">
                                        <input type="hidden" id="salesConsultant" name="salesConsultant" value="{{ isset($dataPreview['saleName']) ? $dataPreview['saleName'] : '' }}">
                                </div>
                                <div>
                                    <label for="salesPhone">
                                        <h4>Số điện thoại</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" id="salesPhone" name="salesPhone"
                                        value="{{ isset($saler) ? $saler->tel : '' }}">
                                </div>
                            </div>
                        </div>
                        <!-- Tabs content -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card flex-fill w-100">
                    <div class="card-header list-title">
                        <h5 class="card-title mb-0">Thông tin khách hàng</h5>
                    </div>
                    <div class="card-body py-3">
                        <div class="row">
                            <div class="col">
                                <div>
                                    <label for="customerName">
                                        <h4>Tên khách hàng</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" id="customerName" name="customerName"
                                        value="{{ isset($dataPreview['customerName']) ? $dataPreview['customerName'] : '' }}">
                                </div>
                                @if($dataPreview['customerType'] == 1)
                                <div>
                                    @php
                                    $gender = "";
                                    if(isset($dataPreview['customerGender']) && $dataPreview['customerGender'] == 1) {
                                    $gender = "Nam";
                                    } else if(isset($dataPreview['customerGender']) && $dataPreview['customerGender'] ==
                                    2) {
                                    $gender = "Nữ";
                                    } else if(isset($dataPreview['customerGender']) && $dataPreview['customerGender'] ==
                                    3) {
                                    $gender = "Khác";
                                    } else {
                                    $gender = "";
                                    }
                                    @endphp
                                    <label for="customerGender">
                                        <h4>Giới tính</h4>
                                    </label>

                                    <input readOnly type="text" class="form-control" value="{{ $gender }}">
                                    <input type="hidden" class="form-control" id="customerGender" name="customerGender"
                                        value="{{ $dataPreview['customerGender'] }}">
                                </div>
                                <div>
                                    <label for="customerBirthday">
                                        <h4>Ngày sinh</h4>
                                    </label>
                                    <input readOnly type="date" class="form-control" id="customerBirthday"
                                        name="customerBirthday"
                                        value="{{ isset($dataPreview['customerBirthday']) ? $dataPreview['customerBirthday'] : '' }}">
                                </div>
                                @endif
                                @if($dataPreview['customerType'] == 2)
                                <div id="representative-area">
                                    <label for="representative">
                                        <h4>Người đại diện</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" id="representative"
                                        name="representative" value="{{ isset($dataPreview['representative']) ? $dataPreview['representative'] : '' }}">
                                </div>
                                <div id="position-area">
                                    <label for="position">
                                        <h4>Chức vụ</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" id="position"
                                        name="position" value="{{ isset($dataPreview['position']) ? $dataPreview['position'] : '' }}">
                                </div>
                                <div id="tax-area">
                                    <label for="taxCode">
                                        <h4>Mã số thuế</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" id="taxCode"
                                        name="taxCode" value="{{ isset($dataPreview['taxCode']) ? $dataPreview['taxCode'] : '' }}">
                                </div>
                                @endif
                                <div>
                                    <label for="customerAddress">
                                        <h4>Địa chỉ</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control"
                                        value="{{ isset($province) ? $province->name : ''}}">
                                    <input type="hidden" id="province" name="province"
                                        value="{{ isset($dataPreview['province']) ? $dataPreview['province'] : '' }}">
                                </div>
                                <div>
                                    <label for="district"></label>
                                    <input readOnly type="text" class="form-control"
                                        value="{{ isset($district) ? $district->name : '' }}">
                                    <input type="hidden" id="district" name="district"
                                        value="{{ isset($dataPreview['district']) ? $dataPreview['district'] : '' }}">
                                </div>
                                <div>
                                    <label for="ward"></label>
                                    <input readOnly type="text" class="form-control"
                                        value="{{ isset($ward) ? $ward->name : '' }}">
                                    <input type="hidden" id="ward" name="ward"
                                        value="{{ isset($dataPreview['ward']) ? $dataPreview['ward'] : '' }}">
                                </div>
                                <div>
                                    <label for="address"></label>
                                    <input readOnly name="address" class="form-control"
                                        value="{{ isset($dataPreview['address']) ? $dataPreview['address'] : '' }}" />
                                </div>
                            </div>
                            <div class="col">
                                <div>
                                    <label for="customerPhone">
                                        <h4>Số điện thoại</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" id="customerPhone" name="customerPhone"
                                        value="{{ isset($dataPreview['customerPhone']) ? $dataPreview['customerPhone'] : '' }}">
                                </div>
                                @if($dataPreview['customerType'] == 1)
                                <div>
                                    <label for="customerIDCard">
                                        <h4>CMT/CCCD</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" id="customerIDCard" name="customerIDCard"
                                        value="{{ isset($dataPreview['customerIDCard']) ? $dataPreview['customerIDCard'] : '' }}">
                                </div>
                                <div>
                                    <label for="icCardDateRegister">
                                        <h4>Ngày cấp</h4>
                                    </label>
                                    <input readOnly type="date" class="form-control" id="icCardDateRegister"
                                        name="icCardDateRegister"
                                        value="{{ isset($dataPreview['icCardDateRegister']) ? $dataPreview['icCardDateRegister'] : ''}}">
                                </div>
                                <div>
                                    <label for="issuedBy">
                                        <h4>Nơi cấp</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" id="issuedBy" name="issuedBy"
                                        value="{{ isset($dataPreview['issuedBy']) ? $dataPreview['issuedBy'] : '' }}">
                                </div>
                                @endif
                                <div>
                                    <label for="mailAddress">
                                        <h4>Địa chỉ gửi thư</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" id="mailAddress" name="mailAddress"
                                        value="{{ isset($dataPreview['mailAddress']) ? $dataPreview['mailAddress'] : ''}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card flex-fill w-100">
                    <div class="card-header list-title">
                        <h5 class="card-title mb-0">Thông tin sản phẩm xe</h5>
                    </div>
                    <div class="card-body py-3">

                        <div class="row">
                            <div class="col">
                                <div>

                                    <label for="carID">
                                        <h4>Tên hiệu xe</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control"
                                        value="{{ isset($car) ? $car->car_name : '' }}">
                                    <input type="hidden" id="carID" name="carID"
                                        value="{{ isset($dataPreview['carID']) ? $dataPreview['carID'] : '' }}">
                                </div>
                                <div>
                                    @php
                                    $carType = "";
                                    if(isset($car) && $car->type == 1) {
                                    $carType = "Nhập khẩu nguyên chiếc";
                                    } else if(isset($car) && $car->type == 2) {
                                    $carType = "Lắp ráp trong nước";
                                    } else {
                                    $carType = "";
                                    }
                                    @endphp
                                    <label for="carType">
                                        <h4>Loại xe</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" value="{{ $carType }}">
                                    <input type="hidden" id="carType" name="carType"
                                        value="{{ isset($dataPreview['carType']) ? $dataPreview['carType'] : '' }}">
                                </div>
                                <div>
                                    <label for="carColor">
                                        <h4>Màu xe</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" id="carColor" name="carColor"
                                        value="{{ isset($dataPreview['carColor']) ? $dataPreview['carColor'] : '' }}">
                                </div>
                                <div>
                                    <label for="noticePrice">
                                        <h4>Giá thông báo (VNĐ)</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" id="noticePrice" name="noticePrice"
                                        value="{{ isset($dataPreview['noticePrice']) ? $dataPreview['noticePrice'] : '' }}">
                                </div>
                                <div>
                                    <label for="realPrice">
                                        <h4>Giá thực tế (VNĐ)</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" id="realPrice" name="realPrice"
                                        value="{{ isset($dataPreview['realPrice']) ? $dataPreview['realPrice'] : ''}}">
                                </div>
                            </div>
                            <div class="col">
                                <div>
                                    <label for="amount">
                                        <h4>Số lượng</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" id="amount" name="amount"
                                        value="{{ isset($dataPreview['amount']) ? $dataPreview['amount'] : '' }}">
                                </div>
                                <div>
                                    <label for="deposit">
                                        <h4>Tiền cọc (VNĐ)</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" id="deposit" name="deposit"
                                        value="{{ isset($dataPreview['deposit']) ? $dataPreview['deposit'] : '' }}">
                                </div>
                                <div>
                                    <label for="carDeliveryTime">
                                        <h4>Thời gian giao xe</h4>
                                    </label>
                                    <input readOnly type="date" class="form-control" id="carDeliveryTime" name="carDeliveryTime"
                                        value="{{ isset($dataPreview['carDeliveryTime']) ? $dataPreview['carDeliveryTime'] : '' }}">
                                </div>
                                <div>
                                    <label for="promotionalContent">
                                        <h4>Nội dung khuyến mại</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" id="promotionalContent"
                                        name="promotionalContent"
                                        value="{{ isset($dataPreview['promotionalContent']) ? $dataPreview['promotionalContent'] : '' }}">
                                </div>
                                <div>
                                    <label for="gift">
                                        <h4>Quà tặng</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" id="gift" name="gift"
                                        value="{{ isset($dataPreview['gift']) ? $dataPreview['gift'] : '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection

@section('js')
<script src="{{ URL::asset('js/dashboard/tab-footer.js') }}"></script>
@endsection