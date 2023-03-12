@extends('layout.master')
@section('header_section')
    <link href="{{ asset('css/dashboard/contractDetail.css') }}" rel="stylesheet">
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="list-title">
                <h1 class="h3 mb-3"><strong>Chi tiết hợp đồng</strong></h1>
                <div>
                    <button id="back_btn" class="btn btn-link" type="button">Quay lại</button>
                    <button class="btn btn-primary">Chỉnh sửa hợp đồng</button>
                    <form method="POST" action="{{ route('contract.export') }}" target="__blank">
                        <input type="hidden" name="contractID" value="{{ $contractDetail->id }}">
                        @csrf
                        <button class="btn btn-success" type="submit">Xuất hợp đồng</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="card-body py-3">
                    <div class="row">
                        <div class="card flex-fill w-100">
                            <div class="card-header list-title">
                                <h2 class="card-title mb-0">Thông tin hợp đồng</h2>
                            </div>
                            <div class="card-body py-3">
                                <div class="row">
                                    <div class="col">
                                        <div>
                                            <label for="contractNum">
                                                <h4>Số hợp đồng</h4>
                                            </label>
                                            <input type="text" readOnly class="form-control" id="contractNum"
                                                name="contractNum" value="{{ $contractDetail->contract_num }}">
                                        </div>
                                        <div>
                                            @php
                                                $contractType = '';
                                                if ($contractDetail->contract_type == 1) {
                                                    $contractType = 'Trả thẳng';
                                                } elseif ($contractDetail->contract_type == 2) {
                                                    $contractType = 'Trả góp';
                                                } else {
                                                    $gender = '';
                                                }
                                            @endphp
                                            <label for="contractType">
                                                <h4>Loại hợp đồng</h4>
                                            </label>
                                            <input readOnly type="text" class="form-control" id="contractType"
                                                name="contractType" value="{{ $contractType }}">
                                        </div>
                                        <div>
                                            @php
                                                $customerType = '';
                                                if ($contractDetail->customer_type == 1) {
                                                    $customerType = 'Cá nhân';
                                                } elseif ($contractDetail->customer_type == 2) {
                                                    $customerType = 'Doanh nghiệp';
                                                } else {
                                                    $customerType = '';
                                                }
                                            @endphp
                                            <label for="customerType">
                                                <h4>Kiểu hợp đồng</h4>
                                            </label>
                                            <input readOnly type="text" class="form-control" id="customerType"
                                                name="customerType" value="{{ $customerType }}">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div>
                                            <label for="contractSignDate">
                                                <h4>Ngày ký hợp đồng</h4>
                                            </label>
                                            <input readOnly type="date" class="form-control" id="contractSignDate"
                                                name="contractSignDate" value="{{ $contractDetail->contract_sign_date }}">
                                        </div>
                                        <div>
                                            <label for="salesConsultant">
                                                <h4>Tư vấn Bán hàng</h4>
                                            </label>
                                            <input readOnly type="text" class="form-control"
                                                value="{{ $sale->FirstName . ' ' . $sale->LastName }}">
                                        </div>
                                        <div>
                                            <label for="salesPhone">
                                                <h4>Số điện thoại</h4>
                                            </label>
                                            <input readOnly type="text" class="form-control" id="salesPhone"
                                                name="salesPhone" value="{{ $sale->Phone }}">
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
                                            <input readOnly type="text" class="form-control" id="customerName"
                                                name="customerName" value="{{ $contractDetail->customer_name }}">
                                        </div>
                                        <div>
                                            @php
                                                $gender = '';
                                                if ($contractDetail->customer_gender == 1) {
                                                    $gender = 'Nam';
                                                } elseif ($contractDetail->customer_gender == 2) {
                                                    $gender = 'Nữ';
                                                } elseif ($contractDetail->customer_gender == 3) {
                                                    $gender = 'Khác';
                                                } else {
                                                    $gender = '';
                                                }
                                            @endphp
                                            <label for="customerGender">
                                                <h4>Giới tính</h4>
                                            </label>

                                            <input readOnly type="text" class="form-control"
                                                value="{{ $gender }}">
                                        </div>
                                        <div>
                                            <label for="customerBirthday">
                                                <h4>Ngày sinh</h4>
                                            </label>
                                            <input readOnly type="date" class="form-control" id="customerBirthday"
                                                name="customerBirthday" value="{{ $contractDetail->customer_birthday }}">
                                        </div>
                                        <div>
                                            <label for="customerAddress">
                                                <h4>Địa chỉ</h4>
                                            </label>
                                            <input readOnly type="text" class="form-control"
                                                value="{{ isset($province) ? $province->name : '' }}">
                                        </div>
                                        <div>
                                            <label for="district"></label>
                                            <input readOnly type="text" class="form-control"
                                                value="{{ isset($district) ? $district->name : '' }}">
                                        </div>
                                        <div>
                                            <label for="ward"></label>
                                            <input readOnly type="text" class="form-control"
                                                value="{{ isset($ward) ? $ward->name : '' }}">
                                        </div>
                                        <div>
                                            <label for="address"></label>
                                            <input readOnly name="address" class="form-control"
                                                value="{{ $contractDetail->address }}" />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div>
                                            <label for="customerPhone">
                                                <h4>Số điện thoại</h4>
                                            </label>
                                            <input readOnly type="text" class="form-control" id="customerPhone"
                                                name="customerPhone" value="{{ $contractDetail->customer_phone }}">
                                        </div>
                                        <div>
                                            <label for="customerIDCard">
                                                <h4>CMT/CCCD</h4>
                                            </label>
                                            <input readOnly type="text" class="form-control" id="customerIDCard"
                                                name="customerIDCard" value="{{ $contractDetail->customer_id_card }}">
                                        </div>
                                        <div>
                                            <label for="icCardDateRegister">
                                                <h4>Ngày cấp</h4>
                                            </label>
                                            <input readOnly type="date" class="form-control" id="icCardDateRegister"
                                                name="icCardDateRegister"
                                                value="{{ $contractDetail->customer_id_card_register }}">
                                        </div>
                                        <div>
                                            <label for="issuedBy">
                                                <h4>Nơi cấp</h4>
                                            </label>
                                            <input readOnly type="text" class="form-control" id="issuedBy"
                                                name="issuedBy" value="{{ $contractDetail->issued_by }}">
                                        </div>
                                        <div>
                                            <label for="mailAddress">
                                                <h4>Địa chỉ gửi thư</h4>
                                            </label>
                                            <input readOnly type="text" class="form-control" id="mailAddress"
                                                name="mailAddress" value="{{ $contractDetail->mail_address }}">
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
                                        </div>
                                        <div>
                                            @php
                                                $carType = '';
                                                if (isset($car) && $car->type == 1) {
                                                    $carType = 'Nhập khẩu nguyên chiếc';
                                                } elseif (isset($car) && $car->type == 2) {
                                                    $carType = 'Lắp ráp trong nước';
                                                } else {
                                                    $carType = '';
                                                }
                                            @endphp
                                            <label for="carType">
                                                <h4>Loại xe</h4>
                                            </label>
                                            <input readOnly type="text" class="form-control"
                                                value="{{ $carType }}">
                                        </div>
                                        <div>
                                            <label for="carColor">
                                                <h4>Màu xe</h4>
                                            </label>
                                            <input readOnly type="text" class="form-control" id="carColor"
                                                name="carColor" value="{{ $contractDetail->car_color }}">
                                        </div>
                                        <div>
                                            <label for="noticePrice">
                                                <h4>Giá thông báo (VNĐ)</h4>
                                            </label>
                                            <input readOnly type="text" class="form-control" id="noticePrice"
                                                name="noticePrice" value="{{ $contractDetail->notice_price }}">
                                        </div>
                                        <div>
                                            <label for="realPrice">
                                                <h4>Giá thực tế (VNĐ)</h4>
                                            </label>
                                            <input readOnly type="text" class="form-control" id="realPrice"
                                                name="realPrice" value="{{ $contractDetail->real_price }}">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div>
                                            <label for="amount">
                                                <h4>Số lượng</h4>
                                            </label>
                                            <input readOnly type="text" class="form-control" id="amount"
                                                name="amount" value="{{ $contractDetail->amount }}">
                                        </div>
                                        <div>
                                            <label for="deposit">
                                                <h4>Tiền cọc (VNĐ)</h4>
                                            </label>
                                            <input readOnly type="text" class="form-control" id="deposit"
                                                name="deposit" value="{{ $contractDetail->deposit }}">
                                        </div>
                                        <div>
                                            <label for="carDeliveryTime">
                                                <h4>Thời gian giao xe</h4>
                                            </label>
                                            <input readOnly type="date" class="form-control" id="carDeliveryTime"
                                                name="carDeliveryTime" value="{{ $contractDetail->car_delivery_time }}">
                                        </div>
                                        <div>
                                            <label for="promotionalContent">
                                                <h4>Nội dung khuyến mại</h4>
                                            </label>
                                            <input readOnly type="text" class="form-control" id="promotionalContent"
                                                name="promotionalContent" value="{{ $contractDetail->promotion }}">
                                        </div>
                                        <div>
                                            <label for="gift">
                                                <h4>Quà tặng</h4>
                                            </label>
                                            <input readOnly type="text" class="form-control" id="gift"
                                                name="gift" value="{{ $contractDetail->gift }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script>
        $("#back_btn").click(function() {
            window.history.back();
        });
    </script>
    <script>
        var listContract = '{{ route('contract.list.get') }}';
    </script>
    <script src="{{ URL::asset('js/dashboard/list-contract.js') }}"></script>
@endsection
