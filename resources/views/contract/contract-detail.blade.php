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
                <a href="{{ route('contract.show', $contractDetail->id) }}" class="btn btn-info">Xem hợp đồng</a>
                <button class="btn btn-primary" id="btnUpdate">Chỉnh sửa hợp đồng</button>
                <!-- <form method="POST" action="{{ route('contract.export') }}" target="__blank">
                        <input type="hidden" name="contractID" value="{{ $contractDetail->id }}">
                        @csrf
                        <button class="btn btn-success" type="submit">Xuất hợp đồng</button>
                    </form> -->
            </div>
        </div>
        <form action="{{ route('contract.update') }}" method="POST">
            @csrf
            <input type="hidden" name="id" id="idContract" value="{{ $contractDetail->id }}">
            <div class="row">
                <div class="card flex-fill w-100">
                    <div class="card-header list-title">
                        <h2 class="card-title mb-0">Thông tin hợp đồng</h2>
                        <button style="display: none" type="submit" id="btnUpdateSubmit" class="btn btn-outline-primary">Cập nhật</button>
                    </div>
                    <div class="card-body py-3">
                        <div class="row">
                            <div class="col">
                                <div>
                                    <label for="contractNum">
                                        <h4>Số hợp đồng</h4>
                                    </label>
                                    <div>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="header-cont">
                                                    @php 
                                                        $contractHeader = explode("-", $contractDetail->contract_num)[0];
                                                        $contractNum = explode("-", $contractDetail->contract_num)[1];
                                                    @endphp
                                                    <input readOnly type="text"
                                                        class="form-control header-contract-num" id="headerContract"
                                                        name="headerContract" value="{{ $contractHeader }}">
                                                </span>
                                            </div>
                                            <input readOnly type="text" required class="form-control"
                                                placeholder="Nhập vào Số hợp đồng..." id="contractNum"
                                                name="contractNum" id="contractNum" aria-describedby="header-cont" value="{{ $contractNum }}">
                                            <input type="hidden" id="contractID" value="{{ $contractDetail->id }}">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label for="contractType">
                                        <h4>Loại hợp đồng</h4>
                                    </label>
                                    <select disabled="true" class="form-control" name="contractType" id="contractType">
                                        <option value="0">Loại hợp đồng</option>
                                        @if($contractDetail->contract_type == 1)
                                            <option value="1" selected>Trả thẳng</option>
                                            <option value="2">Trả góp</option>
                                        @else
                                            <option value="1">Trả thẳng</option>
                                            <option value="2" selected>Trả góp</option>
                                        @endif
                                    </select>
                                </div>
                                <div>
                                    <label for="customerType">
                                        <h4>Kiểu hợp đồng</h4>
                                    </label>
                                    <select disabled="true" class="form-control" name="customerType" id="customerType">
                                        <option value="0">Loại khách hàng</option>
                                        @if($contractDetail->customer_type == 1)
                                            <option value="1" selected>Cá nhân</option>
                                            <option value="2">Công ty</option>
                                        @else
                                            <option value="1">Cá nhân</option>
                                            <option value="2" selected>Công ty</option>
                                        @endif
                                    </select>
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
                                        <select disabled="true" class="form-control" name="saleName" id="saleName">
                                            <option value="0">Chọn nhân viên bán hàng</option>
                                            @foreach($salers as $s) 
                                                <option value="{{ $s->id }}"
                                                @if(isset($contractDetail) && $contractDetail->admin_id == $s->id)
                                                    selected="selected"
                                                @endif
                                                >{{ $s->first_name . ' ' . $s->last_name }}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div>
                                    <label for="salesPhone">
                                        <h4>Số điện thoại</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" placeholder="Nhập vào Số điện thoại..."
                                        id="salesPhone" name="salesPhone" value="{{ isset($saler) ? $saler->tel : '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tabs content -->
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
                                    <input readOnly type="text" class="form-control" placeholder="Nhập vào Tên khách hàng..."
                                        id="customerName" name="customerName" value="{{ $contractDetail->customer_name }}">
                                </div>
                                @if($contractDetail->customer_type == 1)
                                <div>
                                    <label for="customerGender">
                                        <h4>Giới tính</h4>
                                    </label>
                                    <select disabled="true" name="customerGender" id="customerGender" class="form-control">
                                        <option value="0">Chọn giới tính</option>
                                        @if($contractDetail->contract_type == 1)
                                            <option value="1" selected>Nam</option>
                                            <option value="2">Nữ</option>
                                            <option value="3">Khác</option>
                                        @elseif($contractDetail->contract_type == 2)
                                            <option value="1">Nam</option>
                                            <option value="2" selected>Nữ</option>
                                            <option value="3">Khác</option>
                                        @else 
                                            <option value="1">Nam</option>
                                            <option value="2">Nữ</option>
                                            <option value="3" selected>Khác</option>
                                        @endif
                                    </select>
                                </div>
                                <div>
                                    <label for="customerBirthday">
                                        <h4>Ngày sinh</h4>
                                    </label>
                                    <input readOnly type="date" class="form-control" id="customerBirthday"
                                        name="customerBirthday" value="{{ $contractDetail->customer_birthday }}">
                                </div>
                                @endif
                                @if($contractDetail->customer_type == 2)
                                <div>
                                    <label for="representative">
                                        <h4>Người đại diện</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" id="representative"
                                        name="representative" value="{{ $contractDetail->representative }}">
                                </div>
                                <div>
                                    <label for="position">
                                        <h4>Chức vụ</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" id="position"
                                        name="position" value="{{ $contractDetail->position }}">
                                </div>
                                <div id="tax-area">
                                    <label for="taxCode">
                                        <h4>Mã số thuế</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" id="taxCode"
                                        name="taxCode" value="{{ $contractDetail->tax_code }}">
                                </div>
                                @endif
                                <div>
                                    <label for="province">
                                        <h4>Địa chỉ</h4>
                                    </label>
                                    <select readOnly name="province" id="province" class="form-control" placeholder="Tỉnh/Thành"
                                        data-type="province">
                                        <option value="">Tỉnh/Thành phố</option>
                                        @foreach ($provinces as $province)
                                        <option value="{{ $province->id . '.' . $province->name }}" @if (isset($contractDetail)
                                        && $contractDetail->province_id == $province->id) selected="selected" @endif>
                                        {{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="district"></label>
                                    <select readOnly name="district" id="district" class="form-control" placeholder="Quận/Huyện"
                                        data-type="district">
                                        <option value="">Quận/Huyện</option>
                                    </select>
                                    <input type="hidden" id="value_province" value="{{ $contractDetail->province_id }}">
                                    <input type="hidden" id="value_district" value="{{ $contractDetail->district_id }}">
                                </div>
                                <div>
                                    <label for="ward"></label>
                                    <select readOnly name="ward" id="ward" class="form-control" placeholder="Phường/Xã">
                                        <option value="">Phường/Xã</option>
                                    </select>
                                    <input type="hidden" id="old_value_ward" value="{{ old('ward') }}">
                                </div>
                                <div>
                                    <label for="address"></label>
                                    <input readOnly name="address" id="address" class="form-control" placeholder="Đường/Số nhà"
                                        value="{{ $contractDetail->address }}" />
                                </div>
                            </div>
                            <div class="col">
                                <div>
                                    <label for="customerPhone">
                                        <h4>Số điện thoại</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" id="customerPhone"
                                        placeholder="Nhập vào Số điện thoại..." name="customerPhone" value="{{ $contractDetail->customer_phone }}">
                                </div>
                                @if($contractDetail->customer_type == 1)
                                <div>
                                    <label for="customerIDCard">
                                        <h4>CMT/CCCD</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" placeholder="Nhập vào CMT/CCCD..."
                                        id="customerIDCard" name="customerIDCard" value="{{ $contractDetail->customer_id_card }}">
                                </div>
                                <div>
                                    <label for="icCardDateRegister">
                                        <h4>Ngày cấp</h4>
                                    </label>
                                    <input readOnly type="date" class="form-control" placeholder="Nhập vào Số điện thoại..."
                                        id="icCardDateRegister" name="icCardDateRegister" value="{{ $contractDetail->customer_id_card_register }}">
                                </div>
                                <div>
                                    <label for="issuedBy">
                                        <h4>Nơi cấp</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" placeholder="Nhập vào Nơi cấp CMT/CCCD..."
                                        id="issuedBy" name="issuedBy" value="{{ $contractDetail->issued_by }}">
                                </div>
                                @endif
                                <div>
                                    <label for="mailAddress">
                                        <h4>Địa chỉ Email</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" placeholder="Nhập vào Địa chỉ Email..."
                                        id="mailAddress" name="mailAddress" value="{{ $contractDetail->mail_address }}">
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
                                    <select disabled="true" name="carID" id="carID" class="form-control">
                                        <option value="0">Chọn loại xe</option>
                                        @foreach ($car as $c)
                                        <option value="{{ $c->id }}"
                                            @if($contractDetail->car_id == $c->id)
                                        selected="selected
                                        @endif
                                        >{{ $c->car_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="carType">
                                        <h4>Loại xe</h4>
                                    </label>
                                    <select disabled="true" class="form-control" name="carType" id="carType">
                                        <option value="0">Vui lòng lựa chọn</option>
                                        @if($contractDetail->car_type == 1)
                                            <option value="1" selected>Nhập khẩu nguyên chiếc</option>
                                            <option value="2">Lắp ráp trong nước</option>
                                        @else 
                                            <option value="1">Nhập khẩu nguyên chiếc</option>
                                            <option value="2" selected>Lắp ráp trong nước</option>
                                        @endif
                                    </select>
                                </div>
                                <div>
                                    <label for="carColor">
                                        <h4>Màu xe</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" placeholder="Nhập vào Màu xe..."
                                        id="carColor" name="carColor" value="{{ $contractDetail->car_color }}">
                                </div>
                                <div>
                                    <label for="noticePrice">
                                        <h4>Giá thông báo (VNĐ)</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" id="noticePrice"
                                        placeholder="Nhập vào Giá thông báo..." name="noticePrice" value="{{ number_format($contractDetail->notice_price, 0, '', ',') }}">
                                </div>
                                <div>
                                    <label for="realPrice">
                                        <h4>Giá thực tế (VNĐ)</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" id="realPrice"
                                        placeholder="Nhập vào Giá thực tế..." name="realPrice" value="{{ number_format($contractDetail->real_price, 0, '', ',') }}">
                                </div>
                            </div>
                            <div class="col">
                                <div>
                                    <label for="amount">
                                        <h4>Số lượng</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" placeholder="Nhập vào Số lượng..."
                                        id="amount" name="amount" value="{{ $contractDetail->amount }}">
                                </div>
                                <div>
                                    <label for="deposit">
                                        <h4>Tiền cọc (VNĐ)</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" placeholder="Nhập vào Tiền cọc..."
                                        id="deposit" name="deposit" value="{{ number_format($contractDetail->deposit, 0, '', ',') }}">
                                </div>
                                <div>
                                    <label for="carDeliveryTime">
                                        <h4>Thời gian giao xe</h4>
                                    </label>
                                    <input readOnly type="date" class="form-control" id="carDeliveryTime" name="carDeliveryTime" value="{{ $contractDetail->car_delivery_time }}">
                                </div>
                                <div>
                                    <label for="promotionalContent">
                                        <h4>Nội dung khuyến mại</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control"
                                        placeholder="Nhập vào Nội dung khuyến mại..." id="promotionalContent"
                                        name="promotionalContent" value="{{ $contractDetail->promotion }}">
                                </div>
                                <div>
                                    <label for="gift">
                                        <h4>Quà tặng</h4>
                                    </label>
                                    <input readOnly type="text" class="form-control" placeholder="Nhập vào Quà tặng..." id="gift"
                                        name="gift" value="{{ $contractDetail->gift }}">
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
<script>
$("nav#sidebar li.sidebar-item").removeClass("active");
$("nav#sidebar li.contract-list").addClass("active");

$("#back_btn").click(function() {
    window.history.back();
});

$("#btnUpdate").on("click", function() {
    $("#contractNum, #contractSignDate, #customerName, #salesPhone, #customerBirthday, #position, #representative, #taxCode, #province, #district, #ward, #address, #customerPhone, #customerIDCard, #icCardDateRegister, #issuedBy, #mailAddress, #carColor, #noticePrice, #realPrice, #amount, #deposit, #carDeliveryTime, #promotionalContent, #gift").attr("readonly", false)
    $("#btnUpdateSubmit").show();
    $('#saleName, #contractType, #customerType, #carID, #carType, #customerGender')
        .attr('disabled', false);
});
</script>
<script>
var listContract = '{{ route('contract.list.get') }}';
var getTypeCar = '{{ route('car.type.get') }}';
var getSalerPhone = '{{ route('sale.phone.get') }}';

</script>
<script src="{{ URL::asset('js/dashboard/contract-detail.js') }}"></script>

@endsection