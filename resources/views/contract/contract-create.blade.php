@extends('layout.master')
@section('header_section')
    <link href="{{ asset('css/dashboard/tab.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="mb-3"><strong>Quản lý hợp đồng</strong></h1>
            <form action="{{ route('contract.preview') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="card flex-fill w-100">
                        <div class="card-header list-title">
                            <h5 class="card-title mb-0">Tạo hợp đồng mới</h5>
                            <button class="create-button" type="submit">Tạo</button>
                        </div>
                        @if (isset($errors) && $errors->any())
                            <div style="text-align: center; color: red; font-size: 20px">
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                            </div>
                        @endif 
                        <div class="card-body py-3">
                            <!-- Tabs navs -->
                            <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="ex1-tab-1" data-mdb-toggle="tab" href="#ex1-tabs-1"
                                        role="tab" aria-controls="ex1-tabs-1" aria-selected="true">Thông tin hợp
                                        đồng</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="ex1-tab-2" data-mdb-toggle="tab" href="#ex1-tabs-2"
                                        role="tab" aria-controls="ex1-tabs-2" aria-selected="false">Thông tin khách
                                        hàng</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="ex1-tab-3" data-mdb-toggle="tab" href="#ex1-tabs-3"
                                        role="tab" aria-controls="ex1-tabs-3" aria-selected="false">Thông tin sản phẩm
                                        xe</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="ex1-tab-4" data-mdb-toggle="tab" href="#ex1-tabs-4"
                                        role="tab" aria-controls="ex1-tabs-4" aria-selected="false">Thông tin người môi giới</a>
                                </li>
                            </ul>
                            <!-- Tabs navs -->

                            <!-- Tabs content -->
                            <div class="tab-content" id="ex1-content">
                                <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel"
                                    aria-labelledby="ex1-tab-1">
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
                                                                <input readOnly type="text"
                                                                    class="form-control header-contract-num"
                                                                    id="headerContract" name="headerContract">
                                                            </span>
                                                        </div>
                                                        <input type="text" required class="form-control"
                                                            placeholder="Nhập vào Số hợp đồng..." id="contractNum"
                                                            name="contractNum" aria-describedby="header-cont">
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="checkContractNum" id="checkContractNum">
                                            <div>
                                                <label for="contractType">
                                                    <h4>Loại hợp đồng</h4>
                                                </label>
                                                <select class="form-control" name="contractType" id="contractType">
                                                    <option value="0">Loại hợp đồng</option>
                                                    <option value="1">Trả thẳng</option>
                                                    <option value="2">Trả góp</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="customerType">
                                                    <h4>Kiểu hợp đồng</h4>
                                                </label>
                                                <select class="form-control" name="customerType" id="customerType">
                                                    <option value="0">Loại khách hàng</option>
                                                    <option value="1">Cá nhân</option>
                                                    <option value="2">Công ty</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <label for="contractSignDate">
                                                    <h4>Ngày ký hợp đồng</h4>
                                                </label>
                                                <input type="date" class="form-control" id="contractSignDate"
                                                    name="contractSignDate">
                                            </div>
                                            <div>
                                                <label for="salesConsultant">
                                                    <h4>Tư vấn Bán hàng</h4>
                                                </label>
                                                <select class="form-control" name="saleName" id="saleName">
                                                    <option value="0">Chọn nhân viên bán hàng</option>
                                                    @foreach($saler as $s) 
                                                        <option value="{{ $s->id }}">{{ $s->first_name . ' ' . $s->last_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div>
                                                <label for="salesPhone">
                                                    <h4>Số điện thoại</h4>
                                                </label>
                                                <input type="number" class="form-control"
                                                    placeholder="Nhập vào Số điện thoại..." id="salesPhone"
                                                    name="salesPhone" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                                    <div class="row">
                                        <div class="col">
                                            <div>
                                                <label for="customerName">
                                                    <h4>Tên khách hàng</h4>
                                                </label>
                                                <input type="text" class="form-control"
                                                    placeholder="Nhập vào Tên khách hàng..." id="customerName"
                                                    name="customerName">
                                            </div>
                                            <div id="gender-area">
                                                <label for="customerGender">
                                                    <h4>Giới tính</h4>
                                                </label>
                                                <select name="customerGender" id="customerGender" class="form-control">
                                                    <option value="0">Chọn giới tính</option>
                                                    <option value="1">Nam</option>
                                                    <option value="2">Nữ</option>
                                                    <option value="3">Khác</option>
                                                </select>
                                            </div>
                                            <div id="representative-area">
                                                <label for="representative">
                                                    <h4>Người đại diện</h4>
                                                </label>
                                                <input type="text" class="form-control" id="representative"
                                                    name="representative" placeholder="Nhập vào Người đại diện...">
                                            </div>
                                            <div id="position-area">
                                                <label for="position">
                                                    <h4>Chức vụ</h4>
                                                </label>
                                               <input type="text" class="form-control" id="position"
                                                    name="position" placeholder="Nhập vào Chức vụ...">
                                            </div>
                                            <div id="birthday-area">
                                                <label for="customerBirthday">
                                                    <h4>Ngày sinh</h4>
                                                </label>
                                                <input type="date" class="form-control" id="customerBirthday"
                                                    name="customerBirthday">
                                            </div>
                                            <div>
                                                <label for="customerAddress">
                                                    <h4>Địa chỉ</h4>
                                                </label>
                                                <select name="province" id="province" class="form-control"
                                                    placeholder="Tỉnh/Thành" data-type="province">
                                                    <option value="">Tỉnh/Thành phố</option>
                                                    @foreach ($provinces as $province)
                                                        <option value="{{ $province->id . '.' . $province->name }}"
                                                            @if (isset($admin) && $admin->province_id == $province->id) selected="selected" @endif>
                                                            {{ $province->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div>
                                                <label for="customerPhone"></label>
                                                <select name="district" id="district" class="form-control"
                                                    placeholder="Quận/Huyện" data-type="district">
                                                    <option value="">Quận/Huyện</option>
                                                </select>
                                                <input type="hidden" id="old_value_province"
                                                    value="{{ old('province_id') }}">
                                            </div>
                                            <div>
                                                <label for="customerPhone"></label>
                                                <select name="ward" id="ward" class="form-control"
                                                    placeholder="Phường/Xã">
                                                    <option value="">Phường/Xã</option>
                                                </select>
                                                <input type="hidden" id="old_value_ward" value="{{ old('ward') }}">
                                            </div>
                                            <div>
                                                <label for="customerPhone"></label>
                                                <input name="address" class="form-control" placeholder="Đường/Số nhà"
                                                    value="{{ old('street') ?? ($admin->address ?? '') }}" />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <label for="customerPhone">
                                                    <h4>Số điện thoại</h4>
                                                </label>
                                                <input type="number" class="form-control" id="customerPhone"
                                                    placeholder="Nhập vào Số điện thoại..." name="customerPhone">
                                            </div>
                                            <div id="customerIDCard-area">
                                                <label for="customerIDCard">
                                                    <h4>CMT/CCCD</h4>
                                                </label>
                                                <input type="number" class="form-control"
                                                    placeholder="Nhập vào CMT/CCCD..." id="customerIDCard"
                                                    name="customerIDCard">
                                            </div>
                                            <div id="icCardDateRegister-area">
                                                <label for="icCardDateRegister">
                                                    <h4>Ngày cấp</h4>
                                                </label>
                                                <input type="date" class="form-control"
                                                    id="icCardDateRegister"
                                                    name="icCardDateRegister">
                                            </div>
                                            <div id="issuedBy-area">
                                                <label for="issuedBy">
                                                    <h4>Nơi cấp</h4>
                                                </label>
                                                <input type="text" class="form-control"
                                                    placeholder="Nhập vào Nơi cấp CMT/CCCD..." id="issuedBy"
                                                    name="issuedBy">
                                            </div>
                                            <div id="tax-area">
                                                <label for="taxCode">
                                                    <h4>Mã số thuế</h4>
                                                </label>
                                                <input type="number" class="form-control" id="taxCode"
                                                    name="taxCode" placeholder="Nhập vào Mã số thuế...">
                                            </div>
                                            <div id="tax-issuance-area">
                                                <label for="taxCodeIssuanceDate">
                                                    <h4>Ngày cấp MST</h4>
                                                </label>
                                                <input type="date" class="form-control" id="taxCodeIssuanceDate"
                                                    name="taxCodeIssuanceDate">
                                            </div>
                                            <div id="tax-place-area">
                                                <label for="taxCodeIssuancePlace">
                                                    <h4>Nơi cấp MST</h4>
                                                </label>
                                                <input type="text" class="form-control" id="taxCodeIssuancePlace"
                                                    name="taxCodeIssuancePlace" placeholder="Nhập vào Nơi cấp Mã số thuế...">
                                            </div>
                                            <div>
                                                <label for="mailAddress">
                                                    <h4>Địa chỉ Email</h4>
                                                </label>
                                                <input type="text" class="form-control"
                                                    placeholder="Nhập vào Địa chỉ Email..." id="mailAddress"
                                                    name="mailAddress">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="ex1-tabs-3" role="tabpanel" aria-labelledby="ex1-tab-3">
                                    <div class="row">
                                        <div class="col">
                                            <div>
                                                <label for="carID">
                                                    <h4>Tên hiệu xe</h4>
                                                </label>
                                                <select name="carID" id="carID" class="form-control">
                                                    <option value="0">Chọn loại xe</option>
                                                    @foreach ($car as $c)
                                                        <option value="{{ $c->id }}">{{ $c->car_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div>
                                                <label for="carType">
                                                    <h4>Loại xe</h4>
                                                </label>
                                                <select class="form-control" name="carType" id="carType">
                                                    <option value="0">Vui lòng lựa chọn</option>
                                                    <option value="1">Nhập khẩu nguyên chiếc</option>
                                                    <option value="2">Lắp ráp trong nước</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="carColor">
                                                    <h4>Màu xe</h4>
                                                </label>
                                                <input type="text" class="form-control"
                                                    placeholder="Nhập vào Màu xe..." id="carColor" name="carColor">
                                            </div>
                                            <div>
                                                <label for="yearOfCar">
                                                    <h4>Năm sản xuất</h4>
                                                </label>
                                                <input type="text" class="form-control"
                                                    placeholder="Nhập vào Năm sản xuất xe..." id="yearOfCar" name="yearOfCar">
                                            </div>
                                            <div>
                                                <label for="noticePrice">
                                                    <h4>Giá thông báo (VNĐ)</h4>
                                                </label>
                                                <input type="text" class="form-control" id="noticePrice"
                                                    placeholder="Nhập vào Giá thông báo..." name="noticePrice">
                                            </div>
                                            <div>
                                                <label for="realPrice">
                                                    <h4>Giá thực tế (VNĐ)</h4>
                                                </label>
                                                <input type="text" class="form-control" id="realPrice"
                                                    placeholder="Nhập vào Giá thực tế..." name="realPrice">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <label for="amount">
                                                    <h4>Số lượng</h4>
                                                </label>
                                                <input type="number" class="form-control"
                                                    placeholder="Nhập vào Số lượng..." id="amount" name="amount">
                                            </div>
                                            <div>
                                                <label for="deposit">
                                                    <h4>Tiền cọc (VNĐ)</h4>
                                                </label>
                                                <input type="text" class="form-control"
                                                    placeholder="Nhập vào Tiền cọc..." id="deposit" name="deposit">
                                            </div>
                                            <div>
                                                <label for="carDeliveryTime">
                                                    <h4>Thời gian giao xe</h4>
                                                </label>
                                                <input class="form-control" id="carDeliveryTime" autocomplete="off"
                                                    name="carDeliveryTime" placeholder="Chọn thời gian giao xe...">
                                            </div>
                                            <div>
                                                <label for="promotionalContent">
                                                    <h4>Nội dung khuyến mại</h4>
                                                </label>
                                                <input type="text" class="form-control"
                                                    placeholder="Nhập vào Nội dung khuyến mại..." id="promotionalContent"
                                                    name="promotionalContent">
                                            </div>
                                            <div>
                                                <label for="gift">
                                                    <h4>Nội dung khác</h4>
                                                </label>
                                                <input type="text" class="form-control"
                                                    placeholder="Nhập vào Quà tặng..." id="gift" name="gift">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="ex1-tabs-4" role="tabpanel" aria-labelledby="ex1-tab-4">
                                    <div class="row">
                                        <div class="col">
                                            <div>
                                                <label for="brokerName">
                                                    <h4>Họ và tên</h4>
                                                </label>
                                                <input type="text" class="form-control" name="brokerName" id="brokerName" placeholder="Nhập vào Họ tên người môi giới...">
                                                
                                            </div>
                                            <div>
                                                <label for="brokerAddress">
                                                    <h4>Địa chỉ</h4>
                                                </label>
                                                <input type="text" class="form-control" name="brokerAddress" id="brokerAddress" placeholder="Nhập vào Địa chỉ...">
                                            </div>
                                            <div>
                                                <label for="brokerIDCard">
                                                    <h4>Số CCCD/CMND</h4>
                                                </label>
                                                <input type="number" class="form-control"
                                                    placeholder="Nhập vào số CCCD/CMND..." id="brokerIDCard" name="brokerIDCard">
                                            </div>
                                            <div>
                                                <label for="brokerPhone">
                                                    <h4>Số điện thoại</h4>
                                                </label>
                                                <input type="number" class="form-control" id="brokerPhone"
                                                    placeholder="Nhập vào Số điện thoại..." name="brokerPhone">
                                            </div>
                                            <div>
                                                <label for="amountOfCommission">
                                                    <h4>Số tiền hoa hồng (VNĐ)</h4>
                                                </label>
                                                <input type="text" class="form-control" id="amountOfCommission"
                                                    placeholder="Nhập vào Số tiền hoa hồng..." name="amountOfCommission">
                                            </div>
                                        </div>
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
        var getTypeCar = '{{ route('car.type.get') }}';
        var getSalerPhone = '{{ route('sale.phone.get') }}';
    </script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
    <script src="{{ URL::asset('js/dashboard/tab-footer.js') }}"></script>
@endsection
