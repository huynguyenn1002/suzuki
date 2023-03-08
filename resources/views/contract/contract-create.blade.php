@extends('layout.master')
@section('header_section')
    <link href="{{ asset('css/dashboard/tab.css') }}" rel="stylesheet">
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Quản lý hợp đồng</strong></h1>
            <form action="{{ route('contract.form.register') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="card flex-fill w-100">
                        <div class="card-header list-title">
                            <h5 class="card-title mb-0">Tạo hợp đồng mới</h5>
                            <button class="create-button" type="submit">Tạo</button>
                        </div>
                        <div class="card-body py-3">
                            <!-- Tabs navs -->
                            <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="ex1-tab-1" data-mdb-toggle="tab" href="#ex1-tabs-1"
                                        role="tab" aria-controls="ex1-tabs-1" aria-selected="true">Thông tin hợp
                                        đồng</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="ex1-tab-2" data-mdb-toggle="tab" href="#ex1-tabs-2"
                                        role="tab" aria-controls="ex1-tabs-2" aria-selected="false">Thông tin khách
                                        hàng</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="ex1-tab-3" data-mdb-toggle="tab" href="#ex1-tabs-3"
                                        role="tab" aria-controls="ex1-tabs-3" aria-selected="false">Thông tin sản phẩm
                                        xe</a>
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
                                                    <h6>Số hợp đồng</h6>
                                                </label>
                                                <input type="text" required class="form-control"
                                                    placeholder="Nhập vào Số hợp đồng..." id="contractNum"
                                                    name="contractNum">
                                            </div>
                                            <div>
                                                <label for="contractType">
                                                    <h6>Loại hợp đồng</h6>
                                                </label>
                                                <input type="text" class="form-control"
                                                    placeholder="Nhập vào Loại hợp đồng..." id="contractType"
                                                    name="contractType">
                                            </div>
                                            <div>
                                                <label for="contractSignDate">
                                                    <h6>Ngày ký hợp đồng</h6>
                                                </label>
                                                <input type="datetime-local" class="form-control"
                                                    id="contractSignDate" name="contractSignDate">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <label for="salesConsultant">
                                                    <h6>Tư vấn Bán hàng</h6>
                                                </label>
                                                <input type="text" class="form-control"
                                                    placeholder="Nhập vào tên Tư vấn Bán hàng..." id="salesConsultant"
                                                    name="salesConsultant"
                                                    value="{{ $sale->SaleID. '.' . $sale->FirstName . ' ' . $sale->LastName }}">
                                            </div>
                                            <div>
                                                <label for="salesPhone">
                                                    <h6>Số điện thoại</h6>
                                                </label>
                                                <input type="text" class="form-control"
                                                    placeholder="Nhập vào Số điện thoại..." id="salesPhone"
                                                    name="salesPhone" value="{{ $sale->Phone }}">
                                            </div>
                                            <div>
                                                <label for="salesIDCard">
                                                    <h6>CMT/CCCD</h6>
                                                </label>
                                                <input type="text" class="form-control"
                                                    placeholder="Nhập vào CMT/CCCD..." id="salesIDCard" name="salesIDCard"
                                                    value="{{ $sale->CCCD }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                                    <div class="row">
                                        <div class="col">
                                            <div>
                                                <label for="customerName">
                                                    <h6>Tên khách hàng</h6>
                                                </label>
                                                <input type="text" class="form-control"
                                                    placeholder="Nhập vào Tên khách hàng..." id="customerName"
                                                    name="customerName">
                                            </div>
                                            <div>
                                                <label for="customerGender">
                                                    <h6>Giới tính</h6>
                                                </label>
                                                <select name="customerGender" id="customerGender" class="form-control">
                                                    <option value="0">Chọn giới tính</option>
                                                    <option value="1">Nam</option>
                                                    <option value="2">Nữ</option>
                                                    <option value="3">Khác</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="customerBirthday">
                                                    <h6>Ngày sinh</h6>
                                                </label>
                                                <input type="date" class="form-control" id="customerBirthday"
                                                    name="customerBirthday">
                                            </div>
                                            <div>
                                                <label for="customerAddress">
                                                    <h6>Địa chỉ</h6>
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
                                                    <h6>Số điện thoại</h6>
                                                </label>
                                                <input type="text" class="form-control" id="customerPhone"
                                                    placeholder="Nhập vào Số điện thoại..." name="customerPhone">
                                            </div>
                                            <div>
                                                <label for="customerIDCard">
                                                    <h6>CMT/CCCD</h6>
                                                </label>
                                                <input type="text" class="form-control"
                                                    placeholder="Nhập vào CMT/CCCD..." id="customerIDCard"
                                                    name="customerIDCard">
                                            </div>
                                            <div>
                                                <label for="icCardDateRegister">
                                                    <h6>Ngày cấp</h6>
                                                </label>
                                                <input type="date" class="form-control"
                                                    placeholder="Nhập vào Số điện thoại..." id="icCardDateRegister"
                                                    name="icCardDateRegister">
                                            </div>
                                            <div>
                                                <label for="issuedBy">
                                                    <h6>Nơi cấp</h6>
                                                </label>
                                                <input type="text" class="form-control"
                                                    placeholder="Nhập vào Nơi cấp CMT/CCCD..." id="issuedBy"
                                                    name="issuedBy">
                                            </div>
                                            <div>
                                                <label for="mailAddress">
                                                    <h6>Địa chỉ gửi thư</h6>
                                                </label>
                                                <input type="text" class="form-control"
                                                    placeholder="Nhập vào Địa chỉ gửi thư..." id="mailAddress"
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
                                                    <h6>Tên hiệu xe</h6>
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
                                                    <h6>Loại xe</h6>
                                                </label>
                                                <select class="form-control" name="carType" id="carType">
                                                    <option value="0">Vui lòng lựa chọn</option>
                                                    <option value="1">Nhập khẩu nguyên chiếc</option>
                                                    <option value="2">Lắp ráp trong nước</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="carColor">
                                                    <h6>Màu xe</h6>
                                                </label>
                                                <input type="text" class="form-control"
                                                    placeholder="Nhập vào Màu xe..." id="carColor"
                                                    name="carColor">
                                            </div>
                                            <div>
                                                <label for="noticePrice">
                                                    <h6>Giá thông báo</h6>
                                                </label>
                                                <input type="text" class="form-control" id="noticePrice"
                                                    placeholder="Nhập vào Giá thông báo..." name="noticePrice">
                                            </div>
                                            <div>
                                                <label for="realPrice">
                                                    <h6>Giá thực tế</h6>
                                                </label>
                                                <input type="text" class="form-control" id="realPrice"
                                                    placeholder="Nhập vào Giá thực tế..." name="realPrice">
                                            </div>
                                            <div>
                                                <label for="invoiceSellingPrice">
                                                    <h6>Giá bán hóa đơn</h6>
                                                </label>
                                                <input type="text" class="form-control"
                                                    placeholder="Nhập vào Giá bán hóa đơn..." id="invoiceSellingPrice"
                                                    name="invoiceSellingPrice">
                                            </div>
                                            <div>
                                                <label for="amount">
                                                    <h6>Số lượng</h6>
                                                </label>
                                                <input type="text" class="form-control"
                                                    placeholder="Nhập vào Số lượng..." id="amount" name="amount">
                                            </div>
                                            <div>
                                                <label for="deposit">
                                                    <h6>Tiền cọc</h6>
                                                </label>
                                                <input type="text" class="form-control"
                                                    placeholder="Nhập vào Tiền cọc..." id="deposit" name="deposit">
                                            </div>
                                            <div>
                                                <label for="carDeliveryTime">
                                                    <h6>Thời gian giao xe</h6>
                                                </label>
                                                <input type="date" class="form-control" id="carDeliveryTime"
                                                    name="carDeliveryTime">
                                            </div>
                                            <div>
                                                <label for="promotionalContent">
                                                    <h6>Nội dung khuyến mại</h6>
                                                </label>
                                                <input type="text" class="form-control"
                                                    placeholder="Nhập vào Nội dung khuyến mại..." id="promotionalContent"
                                                    name="promotionalContent">
                                            </div>
                                            <div>
                                                <label for="gift">
                                                    <h6>Quà tặng</h6>
                                                </label>
                                                <input type="text" class="form-control"
                                                    placeholder="Nhập vào Quà tặng..." id="gift" name="gift">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <label for="chassisNumber">
                                                    <h6>Số khung</h6>
                                                </label>
                                                <input type="text" class="form-control"
                                                    placeholder="Nhập vào Số khung..." id="chassisNumber"
                                                    name="chassisNumber">
                                            </div>
                                            <div>
                                                <label for="engineNumber">
                                                    <h6>Số máy</h6>
                                                </label>
                                                <input type="text" class="form-control"
                                                    placeholder="Nhập vào Số máy..." id="engineNumber"
                                                    name="engineNumber">
                                            </div>
                                            <div>
                                                <label for="pdiTime">
                                                    <h6>Ngày PDI</h6>
                                                </label>
                                                <input type="date" class="form-control" id="pdiTime"
                                                    name="pdiTime">
                                            </div>
                                            <div>
                                                <label for="pdiConfirmTime">
                                                    <h6>Thời gian xác nhận PDI</h6>
                                                </label>
                                                <input type="date" class="form-control" id="pdiConfirmTime"
                                                    name="pdiConfirmTime">
                                            </div>
                                            <div>
                                                <label for="note">
                                                    <h6>Ghi chú</h6>
                                                </label>
                                                <input type="text" class="form-control"
                                                    placeholder="Nhập vào Ghi chú..." id="note" name="note">
                                            </div>
                                            <div>
                                                <label for="dnxhsDate">
                                                    <h6>Ngày ĐNXHS</h6>
                                                </label>
                                                <input type="date" class="form-control" id="dnxhsDate"
                                                    name="dnxhsDate">
                                            </div>
                                            <div>
                                                <label for="paymentDate">
                                                    <h6>Ngày thanh toán</h6>
                                                </label>
                                                <input type="date" class="form-control" id="paymentDate"
                                                    name="paymentDate">
                                            </div>
                                            <div>
                                                <label for="paymentAmount">
                                                    <h6>Số tiền thanh toán</h6>
                                                </label>
                                                <input type="text" class="form-control" id="paymentAmount"
                                                    placeholder="Nhập vào Số tiền thanh toán..." name="paymentAmount">
                                            </div>
                                            <div>
                                                <label for="receiptType">
                                                    <h6>Loại phiếu</h6>
                                                </label>
                                                <select name="receiptType" id="receiptType" class="form-control">
                                                    <option value="0">Vui lòng lựa chọn</option>
                                                    <option value="1">PT: Phiếu thu</option>
                                                    <option value="2">UNC: Ủy nhiệm chi</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="bankingFrom">
                                                    <h6>Từ Ngân hàng</h6>
                                                </label>
                                                <input type="text" class="form-control" id="bankingFrom"
                                                    placeholder="Nhập vào Từ Ngân hàng..." name="bankingFrom">
                                            </div>
                                            <div>
                                                <label for="bankingTo">
                                                    <h6>Đến Ngân hàng</h6>
                                                </label>
                                                <input type="text" class="form-control" id="bankingTo"
                                                    placeholder="Nhập vào Đến Ngân hàng..." name="bankingTo">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- Tabs content -->
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
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
    <script src="{{ URL::asset('js/dashboard/tab-footer.js') }}"></script>
@endsection
