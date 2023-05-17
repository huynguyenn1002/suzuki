<link href="{{ asset('css/dashboard/suggestion.css') }}" rel="stylesheet">
<button class="btn-back no-print" onclick="history.back()">Quay lại</button>
<button class="btn-print no-print" onclick="window.print();return false;">In Đơn đề nghị</button>
<div class="main">
    <div class="contract-header">
        <img class="logo" src="{{ asset('images/logo.png') }}" alt="">
    </div>
    <hr>
    <div class="contract-body">
        <div class="contract-application">
            <p class="header-content"><b>ĐỀ NGHỊ KÝ HỢP ĐỒNG</b></p>
            @php
                $customerType = '';
                if ($contract->customer_type == 1) {
                    $customerType = 'Cá nhân';
                } elseif ($contract->customer_type == 2) {
                    $customerType = 'Công ty';
                } else {
                    $customerType = '';
                }
            @endphp
            <p><i>Trường hợp {{ $customerType }}</i> - <b>Số: {{ $contract->contract_num }}</b> </p>
        </div>
        <p>Họ và tên nhân viên kinh doanh: <b>{{ isset($saler) ? $saler->first_name.' '.$saler->last_name : ''}}</b> - phòng kinh doanh - Suzuki Hoàng Hiền</p>
        <div class="first-content">
            <p class="content-title"><b>I. THÔNG TIN KHÁCH HÀNG</b></p>
        <table class="customer-table">
            <thead>
                <th class="left-header">Tên khách hàng</th>
                @php
                    $gender = '';
                    if ($contract->customer_gender == 1) {
                        $gender = 'Ông';
                    } elseif ($contract->customer_gender == 2) {
                        $gender = 'Bà';
                    } elseif ($contract->customer_gender == 3) {
                        $gender = 'Khác';
                    } else {
                        $gender = '';
                    }
                @endphp
                <th>{{ $gender }} {{ $contract->customer_name}}</th>
            </thead>
            <tbody>
                <tr>
                    <td class="address-col">Địa chỉ hộ khẩu:</td>
                    <td class="address-col">{{ $contract->address.', '.$contract->ward_name.', '.$contract->district_name.', '.$contract->province_name}}
                    </td>
                </tr>
                <tr>
                    <td class="phone-col">Điện thoại:</td>
                    <td class="phone-col">{{ $contract->customer_phone}}</td>
                </tr>
                @if($contract->customer_type == 1)
                <tr>
                    <td class="card-col">Số CMT:</td>
                    <td class="card-col">{{ $contract->customer_id_card}}　　Ngày cấp:
                        {{ date("d/m/Y", strtotime($contract->customer_id_card_register)) }} 　　 Nơi cấp:
                        {{ $contract->issued_by}}</td>
                </tr>
                <tr>
                    <td class="birthday-col">Ngày sinh:</td>
                    <td class="birthday-col">{{ date("d/m/Y", strtotime($contract->customer_birthday)) }}</td>
                </tr>
                @else
                <tr>
                    <td class="card-col">Mã số thuế:</td>
                    <td class="card-col">{{ $contract->tax_code}}　　Ngày cấp:
                        {{ date("d/m/Y", strtotime($contract->tax_issuance_date)) }} 　　 Nơi cấp:
                        {{ $contract->tax_issuance_place}}</td>
                </tr>
                <tr>
                    <td class="birthday-col">Ngày thành lập:</td>
                    <td class="birthday-col">{{ date("d/m/Y", strtotime($contract->customer_birthday)) }}</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="second-content">
        <p class="content-title"><b>II. THÔNG TIN XE/ GIÁ BÁN/ KHUYẾN MẠI:</b></p>
        <table class="info-table">
            <tr>
                <td class="first-col">Loại xe: <b>{{ isset($car) ? $car->car_name : ''}}</b></td>
                <td>Màu: {{ $contract->car_color }}</td>
                <td>Năm sản xuất: 2022</td>
                <td>Số lượng: <span style="color: red"><b>0{{ $contract->amount }}</b></span></td>
            </tr>
            <tr>
                <td>Giá thông báo: <b>{{ number_format($contract->notice_price, 0, '', ',') }}</b> (VNĐ)</td>
                <td><span style="color:red"><b>Giảm giá: </b></span>{{ number_format($contract->notice_price - $contract->real_price, 0, '', ',') }} (VNĐ)</td>
                <td>Giá bán: {{ number_format($contract->real_price, 0, '', ',') }} (VNĐ)</td>
                @php 
                    $type = "";
                    if($contract->contract_type == 1) {
                        $type = "TT";
                    } else {
                        $type = "TG";
                    }
                @endphp
                <td>Hình thức: {{ $type }}</td>
            </tr>
            <tr>
                <td>Đặt cọc: <b>{{ number_format($contract->deposit, 0, '', ',') }}</b>(VNĐ)</td>
                <td colspan="3">Bằng chữ: {{ $depositAmount }} đồng</td>
            </tr>
            <tr>
                <td colspan="4">
                    Nội dung khuyến mại: {{ $contract->promotion }}
                </td>
            </tr>
            <tr>
                <td colspan="4">Nội dung khác: {{ $contract->gift }}</td>
            </tr>
            <tr>
                <td>Thời gian ký hợp đồng: <b>{{ date("d/m/Y", strtotime($contract->contract_sign_date)) }}</b></td>
                @php 
                    $carDeliveryTime = null;
                    if(isset($contract->car_delivery_time)) {
                        $carDeliveryTime = explode('-', $contract->car_delivery_time);
                    } 
                @endphp
                <td colspan="3">Thời gian giao xe: Tháng {{ isset($carDeliveryTime) ? $carDeliveryTime[1] : ''}} năm {{ isset($carDeliveryTime) ? $carDeliveryTime[0] : '' }}</td>
            </tr>
            
        </table>
    </div>
    @if(isset($contract->broker_name))
    <div class="third-content">
        <p class="content-title"><b>III. THÔNG TIN MÔI GIỚI</b> <i>(Nếu có)</i> </p>
        <p>Họ và tên người môi giới: {{ $contract->broker_name}}</p>
        <p>Địa chỉ: {{ $contract->broker_address}}</p>
        <p>Số CCCD/CMND: {{ $contract->broker_ic_card}}</p>
        <p>Số ĐT: {{ $contract->broker_phone}}</p>
        <p><b>Tổng số tiền hoa hồng: {{ number_format($contract->amount_of_commission, 0, '', ',')}} (VNĐ)</b></p>
        <p><b><i>Bằng chữ: {{ $amountOfCommission }} đồng</i></b></p>
    </div>
    @endif
    <div class="last-content">
        <p class="date" id="date-today"></p>
        <table class="footer-table">
            <thead>
                <th><b>Người đề nghị</b></th>
                <th><b>Quản lý xe</b></th>
                <th><b>Giám đốc đại lý</b></th>
                <th><b>Chủ tịch HĐQT</b></th>
            </thead>
        </table>
    </div>
</div>
</div>

<script>
const date = new Date();
let day = date.getDate();
let month = date.getMonth() + 1;
let year = date.getFullYear();

var element = document.getElementById("date-today");
var text = document.createTextNode(`Hưng Yên, ngày ${day} tháng ${month} năm ${year}`);
element.appendChild(text);
</script>