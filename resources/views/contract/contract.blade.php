<link href="{{ asset('css/dashboard/contract.css') }}" rel="stylesheet">
<button class="btn-back no-print" onclick="history.back()">Quay lại</button>
<button class="btn-print no-print" onclick="window.print();return false;">In hợp đồng</button>
<div class="main">
    <div class="contract-header">
        <img class="logo" src="{{ asset('images/logo.png') }}" alt="">
    </div>
    <hr>
    <div class="contract-body">
        <div class="fisrt-body">
            <p class="fisrt-body-title">
                HỢP ĐỒNG MUA BÁN XE ÔTÔ
            </p>
            <table class="contract-table">
                <thead>
                    <th>Hợp đồng số</th>
                    <th>Loại hợp đồng</th>
                    <th>Ngày ký hợp đồng</th>
                    <th>Tư vấn bán hàng</th>
                </thead>
                <tbody>
                    <td>{{ $contract->contract_num }}/HĐMB-SHH</td>
                    <td>
                        @php
                        $contractType = '';
                        if ($contract->contract_type == 1) {
                        $contractType = 'Trả thẳng';
                        } elseif ($contract->contract_type == 2) {
                        $contractType = 'Trả góp';
                        } else {
                        $contractType = '';
                        }
                        @endphp

                        {{ $contractType }}
                    </td>
                    <td>{{ date("d/m/Y", strtotime($contract->contract_sign_date)) }}</td>
                    <td>
                        <p>{{ isset($saler) ? $saler->first_name.' '.$saler->last_name : ''}}</p>
                        <p>{{ isset($saler) ? $saler->tel : ''}}</p>
                    </td>
                </tbody>
            </table>
            <div class="law-content">
                <p><i>- 　Căn cứ Bộ Luật dân sự nước Cộng Hoà Xã Hội Chủ Nghĩa Việt Nam năm 2005.</i></p>
                <p><i>- 　Căn cứ Luật Thương mại của Quốc hội Nước Cộng Hoà Xã Hội Chủ Nghĩa Việt Nam khoá XI kỳ họp thứ
                        7, thông qua ngày 14/6/2005;</i></p>
                <p><i>- 　Căn cứ vào nhu cầu và khả năng của hai bên;</i></p>
                <p> 　Hôm nay, tại Văn phòng Công ty cổ phần Đầu tư và Phát Triển Hoàng Hiền, chúng tôi gồm có:</p>
            </div>
        </div>

        <div class="second-body">
            <table class="table-info">
                <thead>
                    <tr>
                        <th class="left-info"><b>BÊN BÁN (Bên A)</b></th>
                        <th><b>CÔNG TY CỔ PHẦN ĐẦU TƯ VÀ PHÁT TRIỂN HOÀNG HIỀN</b></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Địa chỉ</th>
                        <td>Số 285, Đường Phạm Bạch Hổ, P Hiến Nam, Tp Hưng Yên, Hưng Yên</td>
                    </tr>
                    <tr>
                        <th scope="row">Số điện thoại</th>
                        <td>02213.662.668　　Fax: </td>
                    </tr>
                    <tr>
                        <th scope="row">Mã số thuế</th>
                        <td>0901033579</td>
                    </tr>
                    <tr>
                        <th scope="row"><b>Đại diện</b></th>
                        <td><b>Ông Hoàng Văn Hanh 　　 Chức vụ: Giám đốc</b></td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <table class="table-info">
                <thead>
                    <tr>
                        <th class="left-info"><b>BÊN MUA (Bên B)</b></th>
                        <th><b>{{ $contract->customer_name}}</b></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Địa chỉ</th>
                        <td>{{ $contract->address.', '.$contract->ward_name.', '.$contract->district_name.', '.$contract->province_name}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Số điện thoại</th>
                        <td>{{ $contract->customer_phone}}</td>
                    </tr>
                    @if($contract->customer_type == 1)
                    <tr>
                        <th scope="row">Số CCCD/CMND</th>
                        <td>{{ $contract->customer_id_card}}　　Ngày cấp:
                            {{ date("d/m/Y", strtotime($contract->customer_id_card_register)) }} 　　 Nơi cấp:
                            {{ $contract->issued_by}}</td>
                    </tr>
                    <tr>
                        <th scope="row"><b>Ngày sinh</b></th>
                        <td>{{ date("d/m/Y", strtotime($contract->customer_birthday)) }}</td>
                    </tr>
                    @elseif($contract->customer_type == 2)
                    <tr>
                        <th scope="row">Mã số thuế</th>
                        <td>{{ $contract->tax_code}}</td>
                    </tr>
                    <tr>
                        <th scope="row"><b>Đại diện</b></th>
                        <td>
                            <b>{{ $contract->representative}}　　 Chức vụ: {{ $contract->position}}</b> 
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>

            <p class="before-rules"><i>Sau khi bàn bạc, hai bên thoả thuận ký kết và thực hiện hợp đồng mua bán xe ô tô
                    theo các điều khoản và điều kiện sau:</i></p>
        </div>

        <div>
            <div class="first-rule">
                <p class="first-rule-title"><b>ĐIỀU 1: TÊN HÀNG, QUY CÁCH, SỐ LƯỢNG, GIÁ CẢ</b></p>
                <p><b>1.1. 　Bên A bán cho Bên B mặt hàng xe ô tô như sau:</b></p>

                <table class="contract-detail-table">
                    <thead>
                        <th style="width: 20px">STT</th>
                        <th style="width: 400px">Diễn Giải</th>
                        <th style="width: 100px">Đơn giá (VND)</th>
                        <th style="width: 50px">SL (chiếc)</th>
                        <th>Thành tiền (VND)</th>
                    </thead>
                    <tbody>
                        <td>1</td>
                        <td>
                            <div class="explain">
                                <p><b>Tên hiệu xe: {{ isset($car) ? $car->car_name : ''}}</b></p>
                                <p>-　Tình trạng: Mới 100%. </p>
                                <p>-　Màu: {{ $contract->car_color }}</p>
                                @php
                                $carType = '';
                                if ($contract->car_type == 1) {
                                $carType = 'Nhập khẩu nguyên chiếc';
                                } elseif ($contract->car_type == 2) {
                                $carType = 'Lắp ráp trong nước';
                                } else {
                                $carType = '';
                                }
                                @endphp
                                <p>-　{{ $carType }}</p>
                                <p>-　Năm sản xuất: {{ $contract->year_of_manufacture }}</p>
                            </div>
                        </td>
                        <td>{{ number_format($contract->notice_price, 0, '', ',') }}</td>
                        <td>1</td>
                        <td>{{ number_format($contract->notice_price, 0, '', ',') }}</td>
                    </tbody>
                </table>

                <p><b>1.2. 　Tổng giá trị hợp đồng: {{ number_format($contract->notice_price, 0, '', ',') }} VNĐ (Bằng
                        chữ: {{ $noticePrice }} đồng)</b></p>
                <p>Giá bán trên đã bao gồm thuế nhập khẩu, thuế TTĐB và thuế giá trị gia tăng (VAT) nhưng chưa bao gồm
                    thuế
                    trước bạ, chi phí đăng ký, lệ phí đăng kiểm, phí bảo hiểm và các chi phí khác.</p>
            </div>
            <div class="second-rule">
                <p class="second-rule-title"><b>ĐIỀU 2: THANH TOÁN VÀ GIAO XE</b></p>
                <div>
                    <p><b>2.1. 　Thời hạn thanh toán:</b></p>
                    <div class="second-rule-content">
                        <div class="rule-content-child">
                            <p>a,</p><span style="margin-left: 5px"> Bên B thanh toán cho Bên A số tiền là:
                                {{ number_format($contract->deposit, 0, '', ',') }}
                                VND (Bằng chữ: {{ $depositAmount }} đồng) sau khi ký hợp đồng nhưng không quá 01 (một)
                                ngày làm việc. </span>
                        </div>
                        @if($contract->contract_type == 1 && $contract->customer_type == 1)
                        <div class="rule-content-child">
                            <p>b,</p><span style="margin-left: 5px"> Lần 2: Trong thời hạn 10 (mười) ngày kể từ ngày Bên
                                A thông báo đã có xe để giao cho Bên B
                                (
                                Bằng một trong các hình thức: Điện thoại, E mail, Tin nhắn, Công văn), Bên B có trách
                                nhiệm
                                thanh toán cho Bên A số tiền (tổng cộng cả Lần 1) là 100% giá trị hợp đồng để đủ điều
                                kiện
                                được
                                nhận xe. Trong trường hợp đặc biệt hai bên có thể thỏa thuận lùi thời hạn thanh toán lần
                                2
                                nhưng
                                tối đa không quá 30 (ba mươi) ngày kể từ ngày Bên A thông báo có xe cho Bên B. </span>
                        </div>

                        <div class="rule-content-child">
                            <p>c,</p><span style="margin-left: 5px"> Lần 3: Kể từ khi Bên A có thông báo đã có đủ bộ Hồ
                                sơ xe cho Bên B thì Bên B có nghĩa vụ
                                thanh toán toàn bộ số tiền còn lại theo hợp đồng cho Bên A để nhận Hồ sơ xe, nhưng thời
                                hạn
                                thanh toán không quá 10 (mười) ngày. </span>
                        </div>

                        @elseif(($contract->contract_type == 2 && $contract->customer_type == 1) ||
                        ($contract->contract_type == 2 && $contract->customer_type == 2))
                        <div class="rule-content-child">
                            <p>b,</p> <span style="margin-left: 5px">Lần 2: Thanh toán đối ứng </span>
                        </div>
                        <div class="rule-content-child">
                            <p>　-　</p><span style="margin-left: 5px">Trong thời hạn 03 (ba) ngày kể từ ngày Bên A thông
                                báo đã có xe (bằng một trong ba hình thức: Email, Tin nhắn,Công văn), Bên B có nghĩa vụ
                                làm các thủ tục với Ngân hàng để Ngân hàng phát hành bản gốc Thông báo Tín dụng và thanh
                                toán phần nghĩa vụ còn lại (là số tiền theo giá trị hợp đồng trừ đi số tiền mà Ngân hàng
                                cam kết thanh toán theo Thông báo Tín dụng và số tiền Bên B đặt cọc) cho Bên A. Sau đó,
                                Bên A sẽ xuất hóa đơn bán hàng, bàn giao toàn bộ hồ sơ xe để Bên B làm thủ tục đăng ký,
                                đăng kiểm xe.</span>
                        </div>

                        <div class="rule-content-child">
                            <p>c,</p> <span style="margin-left: 5px">Lần 3: Thanh toán số tiền còn lại của hợp đồng
                            </span>
                        </div>
                        <div class="rule-content-child">
                            <p>　-　</p><span style="margin-left: 5px">Trong vòng 03 (ba) ngày kể từ ngày Bên A bàn giao
                                hồ sơ xe, Bên B có trách nhiệm cùng với Ngân hàng làm thủ tục giải ngân số tiền theo
                                Thông báo Tín dụng cho Bên A. Quá thời hạn trên, vì bất cứ lý do gì mà Ngân hàng không
                                giải ngân số còn lại của hợp đồng cho Bên A thì Bên B có trách nhiệm trực tiêp thanh
                                toán số tiền còn lại của hợp đồng cho Bên A trong vòng 05 (năm) ngày. </span>
                        </div>
                        <div class="rule-content-child">
                            <p>　-　</p><span style="margin-left: 5px">Sau thời hạn 10 (mười) ngày kể từ ngày Bên A bàn
                                giao hồ sơ xe mà Bên B không thanh toán số tiền còn lại cho Bên A thì ngay lập tức:
                            </span>
                        </div>
                        <div class="rule-content-child">
                            　　<p>　*　</p><span style="margin-left: 5px">Bên B phải làm thủ tục chuyển quyền sở hữu chiếc
                                xe nói trên cho Bên A hoặc người sở hữu mới do Bên A chỉ
                                định.　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　
                            </span>
                        </div>
                        <div class="rule-content-child">
                            　　<p>　*　</p><span style="margin-left: 5px">Bên B phải chịu mọi chi phí phát sinh như: Tiền
                                lãi tính theo lãi vay Ngân hàng của số tiền ngân hàng đã cam kết, tiền thuê chỗ trông
                                giữ, bảo quản xe, thuế trước bạ, lệ phí đăng ký xe, lệ phí công chứng và các khoản chi
                                phí khác,...
                            </span>
                        </div>

                        <div class="rule-content-child">
                            　　<p>　*　</p><span style="margin-left: 5px">Đồng thời Bên B cũng phải chịu khoản chênh lệch
                                giữa giá trị ban đầu (là giá trị trên hoá đơn GTGT Bên A xuất cho Bên B) và giá giữa Bên
                                A với Bên thứ ba (đơn vị mua mới).　　　　　　　　　　　　　　　　　　　　
                            </span>
                        </div>
                        @elseif($contract->contract_type == 1 && $contract->customer_type == 2)
                        <div class="rule-content-child">
                            <p>b,</p> <span style="margin-left: 5px">Trong thời hạn 03 (ba) ngày kể từ ngày Bên A thông
                                báo đã có xe để giao cho Bên B (Bằng một
                                trong các hình thức: Điện thoại, E mail, Tin nhắn, Công văn), Bên B có trách nhiệm thanh
                                toán cho Bên A
                                số tiền (tổng cộng cả Lần 1) là 100% giá trị hợp đồng để đủ điều kiện được nhận xe.Trong
                                trường hợp đặc
                                biệt hai bên có thể thỏa thuận lùi thời hạn thanh toán lần 2 nhưng tối đa khôngquá 30 (
                                ba mươi ) ngày kể từ
                                ngày Bên A thông báo có xe cho Bên B.</span>
                        </div>

                        <div class="rule-content-child">
                            <p>c,</p> <span style="margin-left: 5px">Kể từ khi Bên A có thông báo đã có đủ bộ Hồ sơ xe
                                cho Bên B thì Bên B có nghĩa vụ thanh toán toàn
                                bộ số tiền còn lại theo hợp đồng cho Bên A để nhận Hồ sơ xe, nhưng thời hạn thanh toán
                                không quá
                                03 (ba) ngày.
                            </span>
                        </div>
                        @endif
                    </div>
                </div>

                <div>
                    <p><b>2.2. 　Đồng tiền và phương thức thanh toán:</b></p>
                    <div class="second-rule-content">
                        <div class="rule-content-child">
                            <p>a,</p><span style="margin-left: 5px"> Đồng tiền thanh toán là Việt Nam Đồng (VND).
                            </span>
                        </div>
                        <div class="rule-content-child">
                            <p>b,</p> <span style="margin-left: 5px">Phương thức thanh toán: </span>
                        </div>
                        <div class="rule-content-child">
                            <p>　-　</p><span style="margin-left: 5px">Thanh toán bằng tiền mặt tại Phòng Tài chính - Kế
                                toán của
                                Bên A và nhận phiếu thu do
                                bên
                                A
                                phát hành có đóng dấu của <span style="color: red">Công ty Cổ phần Đầu tư và Phát
                                    triển
                                    Hoàng Hiền.</span></span>
                        </div>
                        <div class="rule-content-child">
                            <p>　-　</p><span style="margin-left: 5px">Chuyển khoản vào tài khoản VND của Bên A:</span>
                        </div>
                        <div class="rule-content-child">
                            　　<p>　*</p><span style="margin-left: 5px">
                                Số tài khoản: 1021000009986- VCB chi nhánh Phố Hiến
                            </span>
                        </div>
                        <div class="rule-content-child">
                            　　<p>　*</p><span style="margin-left: 5px">Số tài khoản: 111002869390- Viettinbank chi nhánh
                                Quang Minh
                            </span>
                        </div>
                        @if($contract->contract_type == 2)
                        <div class="rule-content-child">
                            <p></p><span style="margin-left: 5px"> <b>Ghi chú:</b> Trong trường hợp Bên B thanh toán
                                bằng
                                tiền mặt, việc thanh toán phải thực hiện trực tiếp tại Quầy thu ngân của Bên A, Bên
                                A phải xuất phiếu thu tiền mặt, trong đó ghi rõ số tiền Bên B thanh toán và có đầy
                                đủ chữ kýcủa người có thẩm quyền của Bên A.
                            </span>
                        </div>
                        @endif
                    </div>
                </div>

                <div>
                    <p><b>2.3. 　Giao xe và hồ sơ xe:</b></p>
                    <div class="second-rule-content">
                        <div class="rule-content-child">
                        @php 
                            $carDeliveryTime = null;
                            if(isset($contract->car_delivery_time)) {
                                $carDeliveryTime = explode(' ', $contract->car_delivery_time);
                            } 
                        @endphp
                            <p style="color: red">a,</p><span style="margin-left: 5px"> <span style="color: red">Thời
                                    gian dự kiến giao xe: </span><span
                                    style="color: black">Tháng {{ isset($carDeliveryTime) ? $carDeliveryTime[1] : ''}} năm {{ isset($carDeliveryTime) ? $carDeliveryTime[2] : '' }}</span></span>
                        </div>
                        <div class="rule-content-child">
                            <span style="margin-left: 15px; color: red"><u>Điều khoản cam kết chung:</u> Trong
                                trường hợp Đại lý không được trả hàng Bên
                                Bán
                                sẽ có thông báo
                                bằng văn bản cho Bên Mua và mời Bên Mua đến nhận lại tiền đặt cọc.</span>
                        </div>
                        <div class="rule-content-child">
                            <p>b, </p><span style="margin-left: 5px">Địa điểm giao xe và hồ sơ xe: Số 285, Đường Phạm
                                Bạch Hổ, P Hiến Nam, Tp. Hưng Yên. </span>
                        </div>
                        <div class="rule-content-child">
                            <p>c, </p><span style="margin-left: 5px"> Người nhận xe và hồ sơ xe: Người đứng tên chủ hợp
                                đồng hoặc người đại diện được sự
                                ủy
                                quyền
                                hợp pháp. </span>
                        </div>
                        <div class="rule-content-child">
                            <p>d, </p><span style="margin-left: 5px">Điều kiện giao hồ sơ xe: Sau khi Bên B thanh toán
                                theo điểm b khoản 2.1 Điều 2 của Hợp
                                đồng
                                này. </span>
                        </div>
                        <div class="rule-content-child">
                            <p>e, </p><span style="margin-left: 5px">Điều kiện giao xe: Sau khi Bên A nhận đủ 100% giá
                                trị hợp đồng. </span>
                        </div>
                    </div>
                </div>

                <div>
                    <p><b>2.4. 　Kiểm tra xe trước khi giao xe và thời điểm chuyển rủi ro</b></p>
                    <div class="second-rule-content">
                        <div class="rule-content-child">
                            <p>a, </p><span style="margin-left: 5px">Khi giao xe Bên A có trách nhiệm tạo điều kiện cho
                                Bên B thực hiện việc kiểm tra xe. </span>
                        </div>
                        <div class="rule-content-child">
                            <p>b, </p><span style="margin-left: 5px">Khi kiểm tra xe, nếu Bên B phát hiện ra xe không
                                phù hợp với hợp đồng thì phải thông báo
                                lại
                                cho Bên A. Nếu Bên B không thực hiện việc thông báo này thì Bên A không phải chịu trách
                                nhiệm về
                                những khiếm khuyết của xe, trừ những lỗi hệ thống từ phía nhà sản xuất.</span>
                        </div>
                        <div class="rule-content-child">
                            <p>c, </p><span style="margin-left: 5px">Khi Bên A giao xe cho Bên B hoặc người được Bên B
                                ủy quyền hợp pháp tại địa điểm đã thỏa
                                thuận
                                trong hợp đồng thì mọi rủi ro xảy ra với chiếc xe được chuyển sang cho Bên B hoặc người
                                được
                                Bên
                                B ủy quyền hợp pháp kể từ lúc nhận bàn giao xe.</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="third-rule">
                <p class="third-rule-title"><b>ĐIỀU 3: THỜI ĐIỂM CHUYỂN QUYỀN SỬ HỮU XE</b></p>
                <div class="third-rule-content">
                    <p>Thời điểm xác lập quyền sở hữu chỉ được chuyển sang Bên B sau khi Bên A nhận được đủ 100% giá trị
                        hợp
                        đồng. Trong thời gian Bên A chưa nhận được đủ tiền, chiếc xe trên vẫn thuộc quyền sở hữu của Bên
                        A
                        và do Bên A toàn quyền quyết định.</p>
                </div>
            </div>

            <div class="fouth-rule">
                <p class="fouth-rule-title"><b>ĐIỀU 4: QUYỀN VÀ NGHĨA VỤ CỦA MỖI BÊN</b></p>
                <div>
                    <p><b>4.1. 　Quyền và nghĩa vụ của Bên A</b></p>
                    <div class="fouth-rule-content">
                        <div class="rule-content-child">
                            <p>a, </p><span style="margin-left: 5px">Tư vấn cho bên B các thông tin về sản phẩm: Danh
                                mục của xe, giá bán xe…. </span>
                        </div>
                        <div class="rule-content-child">
                            <p>b, </p><span style="margin-left: 5px">Hỗ trợ Bên B làm thủ tục Ngân hàng.</span>
                        </div>
                        <div class="rule-content-child">
                            <p>c, </p><span style="margin-left: 5px">Giao xe cho Bên B đúng chủng loại, số lượng, chất
                                lượng theo tiêu chuẩn kỹ thuật của
                                Nhà
                                cung
                                cấp. </span>
                        </div>
                        <div class="rule-content-child">
                            <p>d, </p><span style="margin-left: 5px">Đảm bảo về tính hợp lệ của xe và hồ sơ xe. </span>
                        </div>
                        <div class="rule-content-child">
                            <p>e, </p><span style="margin-left: 5px">Bên A có trách nhiệm hướng dẫn Bên B sử dụng
                                xe.</span>
                        </div>
                        <div class="rule-content-child">
                            <p>f, </p><span style="margin-left: 5px">Thực hiện đúng các cam kết được ghi trong hợp
                                đồng.</span>
                        </div>
                        <div class="rule-content-child">
                            <p>g, </p><span style="margin-left: 5px">Đơn phương chấm dứt hợp đồng nếu Bên B vi phạm các
                                nội dung đã cam kết trong hợp đồng.
                            </span>
                        </div>
                    </div>
                </div>

                <div>
                    <p><b>4.2. 　Quyền và nghĩa vụ của Bên B:</b></p>
                    <div class="fouth-rule-content">
                        <div class="rule-content-child">
                            <p>a, </p><span style="margin-left: 5px">Kiểm tra xe và hồ sơ trước khi nhận xe. </span>
                        </div>
                        <div class="rule-content-child">
                            <p>b, </p><span style="margin-left: 5px">Bên B có trách nhiệm mua bảo hiểm vật chất xe theo
                                yêu cầu của Ngân hàng cho vay khi
                                làm
                                thủ
                                tục giải ngân. </span>
                        </div>
                        <div class="rule-content-child">
                            <p>c, </p><span style="margin-left: 5px">Có trách nhiệm thanh toán theo khoản 2.1 Điều 2
                                của hợp đồng. </span>
                        </div>
                        <div class="rule-content-child">
                            <p>d, </p><span style="margin-left: 5px">Nhận xe theo đúng thỏa thuận trong hợp đồng, trừ
                                trường hợp bất khả kháng.</span>
                        </div>
                        <div class="rule-content-child">
                            <p>e, </p><span style="margin-left: 5px">Bên B chịu mọi chi phí và trách nhiệm liên quan đến
                                thủ tục đăng ký và lưu hành xe. Bên A không có trách
                                nhiệm đối với các khoản thu nằm ngoài phạm vi hợp đồng mua bán này. </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="fifth-rule">
                <p class="fifth-rule-title"><b>ĐIỀU 5: PHẠT VI PHẠM</b></p>
                <div class="rule-not-has-child">
                    <p><b>5.1.</b></p><span style="margin-left: 20px">Bên B chậm thanh toán cho Bên A theo quy định tại
                        điểm c khoản 2.1 Điều 2 của Hợp đồng
                        này thì Bên B phải chịu phạt một khoản tiền bằng 2% số tiền chậm thanh toán cho mỗi 30 ngày
                        chậm.</span>
                </div>
                <div class="rule-not-has-child">
                    <p><b>5.2.</b></p><span style="margin-left: 20px">Bên B không nhận xe theo đúng thời hạn giao xe
                        thì
                        phải chịu chi phí lưu kho, lưu bãi.</span>
                </div>
            </div>

            <div class="sixth-rule">
                <p class="sixth-rule-title"><b>ĐIỀU 6: KHUYẾN MẠI, KIỂM TRA, BẢO HÀNH</b></p>
                <div>
                    <p><b>6.1. 　Khuyến mại, kiểm tra</b></span>
                    <div class="sixth-rule-content">
                        <div class="rule-content-child">
                            <p>a, </p><span style="margin-left: 5px">Khuyến mại theo chương trình của Suzuki Việt Nam
                                hoặc chương trình khuyến mại của Suzuki
                                Hoàng
                                Hiền.</span>
                        </div>
                        <div class="rule-content-child">
                            <p>b, </p><span style="margin-left: 5px">Được tư vấn miễn phí qua hệ thống Tổng đài chăm
                                sóc khách hàng của Suzuki Hoàng Hiền. Số
                                điện
                                thoại: <b>02213 662 668</b> hoặc Hotline hỗ trợ Dịch vụ - Phụ tùng:
                                <b>0868.950.999</b></span>
                        </div>
                    </div>
                </div>

                <div>
                    <p><b>6.2. 　Bảo hành</b></p>
                    <div class="sixth-rule-content">
                        <div class="rule-content-child">
                            <p>a, </p><span style="margin-left: 5px">Bên A có nghĩa vụ cung cấp cho Bên B 01 sổ bảo
                                hành tại thời điểm giao xe. </span>
                        </div>
                        <div class="rule-content-child">
                            <p>b, </p><span style="margin-left: 5px">Thời hạn bảo hành: </span>
                        </div>
                        <div class="rule-content-child">
                            <p>　-　</p><span style="margin-left: 5px">Đối với xe du lịch: 3 năm hoặc
                                100.000 km kể từ ngày giao xe.</span>
                        </div>
                        <div class="rule-content-child">
                            <p>　-　</p><span style="margin-left: 5px">Đối với xe Carry: 3 năm hoặc 100.000 km kể từ ngày
                                giao xe.</span>
                        </div>
                        <div class="rule-content-child">
                            <p>c,<span style="margin-left: 5px">Điều kiện và quy trình bảo hành: Tuân theo quy định về
                                    bảo hành của VISUCO.</p>
                        </div>
                        <div class="rule-content-child">
                            <p>d, </p><span style="margin-left: 5px">Địa điểm bảo hành: Tại Suzuki Hoàng Hiền, (Địa
                                chỉ: Phạm Bạch Hổ, Hiến Nam, Tp Hưng
                                Yên)
                                hoặc
                                tại các Đại lý và trạm dịch vụ ủy quyền của Suzuki trên toàn quốc.</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="seventh-rule">
                <p class="seventh-rule-title"><b>ĐIỀU 7: SỰ KIỆN BẤT KHẢ KHÁNG</b></p>
                <div class="rule-not-has-child">
                    <p><b>7.1. </b></p><span style="margin-left: 20px">Các bên sẽ không phải chịu trách nhiệm đối với
                        việc chậm trễ vì những lý do khách quan
                        (trực tiếp hoặc gián tiếp) nằm ngoài phạm vi kiểm soát của các bên.</span>
                </div>

                <div>
                    <p><b>7.2. </b>　Trở ngại khách quan được đề cập tại khoản 1 điều này có thể nảy sinh từ các sự kiện
                        sau:
                    </p>
                    <div class="seventh-rule-content">
                        <div class="rule-content-child">
                            <p>a, </p><span style="margin-left: 5px">Chiến tranh, dù được tuyên bố hay không, nổi loạn
                                và cách mạng, hành động cướp bóc,
                                các
                                hành
                                vi phá hoại;</span>
                        </div>
                        <div class="rule-content-child">
                            <p>b, </p><span style="margin-left: 5px">Thiên tai như bão lớn, gió lốc, động đất, sóng
                                thần, lũ lụt, sét đánh;</span>
                        </div>
                        <div class="rule-content-child">
                            <p>c, </p><span style="margin-left: 5px">Nổ, cháy, phá huỷ máy móc, nhà xưởng hoặc bất kỳ
                                hệ thống máy móc hoặc thiết bị nào
                                khác;
                            </span>
                        </div>
                        <div class="rule-content-child">
                            <p>d, </p><span style="margin-left: 5px">Tẩy chay, đình công và các vụ đóng cửa để gây áp
                                lực, bãi công chiếm giữ nhà máy và
                                các
                                khu
                                nhà, và dừng sản xuất xảy ra ở nhà máy của bên muốn được miễn trách nhiệm;</span>
                        </div>
                        <div class="rule-content-child">
                            <p>e, </p><span style="margin-left: 5px">Thời gian chậm trễ giao xe đến từ phía nhà cung
                                cấp.</span>
                        </div>
                        <div class="rule-content-child">
                            <p>f, </p><span style="margin-left: 5px">Các biện pháp thực hiện trong tình trạng bất khả
                                kháng Bên gặp phải trường hợp Bất Khả
                                Kháng
                                phải thông báo cho bên kia bằng văn bản trong vòng ba mươi (30) ngày làm việc kể từ ngày
                                nhận
                                được thông tin về sự chậm trễ gây ra do các trường hợp Bất Khả Kháng.</span>
                        </div>
                        <div class="rule-content-child">
                            <p>g, </p><span style="margin-left: 5px">Trong trường hợp xảy ra bất khả kháng, các bên sẽ
                                gia hạn thời gian thực hiện hợp đồng
                                tương
                                ứng bằng thời gian diễn ra sự kiện bất khả kháng mà bên bị ảnh hưởng không thể thực hiện
                                nghĩa
                                vụ theo hợp đồng của mình.</span>
                        </div>
                        <div class="rule-content-child">
                            <p>h, </p><span style="margin-left: 5px">Trong trường hợp mọi nỗ lực của các bên không đem
                                lại kết quả và buộc phải chấm dứt
                                hợp
                                đồng,
                                bên gặp phải bất khả kháng sẽ gửi thông báo bằng văn bản cho bên kia về việc chấm dứt
                                hợp
                                đồng
                                và việc chấm dứt sẽ có hiệu lực 05 ngày say khi bên kia nhận được thông báo.</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="eighth-rule">
                <p class="eighth-rule-title"><b>ĐIỀU 8: SỬA ĐỔI, BỔ SUNG CỦA HỢP ĐỒNG.</b></p>
                <div class="rule-not-has-child">
                    <p><b>8.1.</b></p><span style="margin-left: 20px">Trong trường hợp giá bán xe của Nhà cung cấp tăng
                        hoặc giảm thì cả hai bên đồng ý
                        tăng
                        hoặc giảm giá bán xe theo đúng mức điều chỉnh của Nhà cung cấp.</span>
                </div>

                <div class="rule-not-has-child">
                    <p><b>8.2.</b></p><span style="margin-left: 20px">Mọi sự thay đổi về nội dung trong hợp đồng này
                        trừ
                        khoản 8.1 Điều 8 phải được sự
                        đồng ý của các bên và thể hiện bằng các phụ lục hợp đồng. Các phụ lục hợp đồng là một bộ phận
                        không
                        thể tách rời hợp đồng này.
                    </span>
                </div>
            </div>

            <div class="ninth-rule">
                <p class="ninth-rule-title"><b>ĐIỀU 9: PHƯƠNG THỨC GIẢI QUYẾT TRANH CHẤP</b></p>
                <div class="ninth-rule-content">
                    <p>Trong quá trình thực hiện Hợp đồng nếu phát sinh tranh chấp, các bên cùng nhau thương lượng giải
                        quyết trên nguyên tắc tôn trọng quyền lợi của nhau; trong trường hợp không thương lượng được thì
                        yêu
                        cầu Toà án nhân dân thành phố Hưng Yên giải quyết theo quy định của pháp luật.</p>
                </div>
            </div>

            <div class="tenth-rule">
                <p class="tenth-rule-title"><b>ĐIỀU 10: CAM KẾT CHUNG</b></p>
                <div class="rule-not-has-child">
                    <p><b>10.1. </b></p><span style="margin-left: 10px">Hợp đồng có hiệu lực kể từ khi Bên B hoàn thành
                        việc đặt cọc cho Bên A theo đúng
                        thời
                        gian cam kết và có thời hạn trong <span style="color: red">60</span> ngày kể từ ngày ký Hợp
                        đồng.
                    </span>
                </div>

                <div class="rule-not-has-child">
                    <p><b>10.2. </b></p><span style="margin-left: 10px">Các bên cam kết thực hiện nghiêm chỉnh những
                        điều khoản đã ký trong hợp đồng này và
                        không gây tổn hại đến quyền lợi và lợi ích của phía bên kia.
                    </span>
                </div>

                <div class="rule-not-has-child">
                    <p><b>10.3. </b></p><span style="margin-left: 10px">Bên B sẽ bị mất toàn bộ số tiền đặt cọc nếu đơn
                        phương chấm dứt hợp đồng này.
                    </span>
                </div>

                <div class="rule-not-has-child">
                    <p><b>10.4. </b></p><span style="margin-left: 10px">Sau 10 ngày kể từ khi hai bên hoàn thành nghĩa
                        vụ và trách nhiệm của mình mà không
                        bên
                        nào khiếu kiện gì thì hợp đồng mặc nhiên đã được thanh lý (trừ điều kiện bảo hành).
                    </span>
                </div>

                <div class="rule-not-has-child">
                    <p><b>10.5. </b></p><span style="margin-left: 10px">Hợp đồng này được lập thành ba bản (03) bằng
                        tiếng Việt, Bên Bán giữ 02 bản, Bên
                        mua
                        giữ 01 bản, có giá trị pháp lý như nhau.
                    </span>
                </div>
            </div>
        </div>

        <div class="sign-area">
            <p><b>ĐẠI DIỆN BÊN MUA</b></p>
            <p><b>ĐẠI DIỆN BÊN BÁN</b></p>
        </div>
    </div>
</div>