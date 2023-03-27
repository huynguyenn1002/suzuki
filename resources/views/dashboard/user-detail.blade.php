@extends('layout.master')
@section("header_section")
<link href="{{ asset('css/dashboard/user-detail.css') }}" rel="stylesheet">
@endsection
@section("content")
<main class="content">
    <div class="row">
        <div class="list-title">
            <h1 class="h3 mb-3"><strong>Chỉnh sửa thông tin cá nhân</strong></h1>
            <div class="button-direct">
                <button id="back_btn" class="btn btn-link" type="button">Quay lại</button>
                <button class="btn btn-primary" id="back_edit">Chỉnh sửa hợp đồng</button>
            </div>
        </div>
        <div class="card main-content">
            <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5"
                        width="150px"
                        src="{{ isset($detailInfo->avatar) ? url('storage/avatar/'.$detailInfo->avatar) : asset('/images/default.jpeg') }}"><span
                        class="font-weight-bold">{{ isset($detailInfo) ? $detailInfo->name : '' }}</span><span
                        class="text-black-50">{{ isset($detailInfo) ? $detailInfo->mail_address : '' }}</span><span>
                    </span></div>
                <label for="fileToUpload">Thay đổi ảnh đại diện</label>
                <input type="file" name="avatar" id="fileToUpload" hidden>
            </div>
            <div class="col-md-8 border-right">
                <div class="p-3">
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">Tên</label><input type="text" name="firstname"
                                class="form-control" placeholder="Tên"
                                value="{{ old('first_name') ?? $detailInfo->first_name ?? '' }}"></div>
                        <div class="col-md-6"><label class="labels">Họ</label><input type="text" name="lastname"
                                class="form-control" value="{{ old('last_name') ?? $detailInfo->last_name ?? '' }}"
                                placeholder="Họ"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Số điện thoại</label><input type="text" name="tel"
                                class="form-control" placeholder="Nhập số điện thoại"
                                value="{{ old('tel') ?? $detailInfo->tel ?? '' }}"></div>
                        <div class="col-md-12 mt-3"><label class="labels">CMND/CCCD</label><input type="text"
                                name="citizen_identification" class="form-control" placeholder="Nhập vào số CMND/CCCD"
                                value="{{ old('citizen_identification') ?? $detailInfo->citizen_identification ?? '' }}">
                        </div>
                        <div class="col-md-12 address mt-3"><label class="labels">Địa chỉ</label>
                            <select name="province" id="province" class="form-control" placeholder="Tỉnh/Thành"
                                data-type="province">
                                <option value="">Tỉnh/Thành phố</option>
                                @foreach($provinces as $province)
                                <option value="{{ $province->id.'.'.$province->name }}" @if(isset($detailInfo) &&
                                    $detailInfo->
                                    province_id == $province->id)
                                    selected="selected"
                                    @endif>
                                    {{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 address mt-3">
                            <select name="district" id="district" class="form-control" placeholder="Quận/Huyện"
                                data-type="district">
                                <option value="">Quận/Huyện</option>
                            </select>
                            <input type="hidden" id="old_value_province" value="{{ old('province_id') }}">
                        </div>
                        <div class="col-md-12 address mt-3">
                            <select name="ward" id="ward" class="form-control" placeholder="Phường/Xã">
                                <option value="">Phường/Xã</option>
                            </select>
                            <input type="hidden" id="old_value_ward" value="{{ old('ward') }}">
                        </div>
                        <div class="col-md-12 address mt-3"><input name="address" class="form-control"
                                placeholder="Đường/Số nhà" value="{{ old('address') ?? $detailInfo->address ?? '' }}" />
                        </div>
                        <div class="col-md-12 address">
                            <label for="html">Nếu muốn thay đổi mật khẩu, vui lòng click vào đây</label>
                            <input type="checkbox" id="check-change-password" name="fav_language" value="HTML">
                        </div>
                        <div class="change-password" id="change-password" style="display: none">
                            <div class="col-md-12 address"><label class="labels">Mật khẩu mới</label><input
                                    autocomplete="new-password" type="password" name="password" class="form-control"
                                    placeholder="Mật khẩu mới">
                            </div>
                            <div class="col-md-12 address"><label class="labels">Nhập lại mật khẩu
                                    mới</label><input autocomplete="new-password" type="password"
                                    name="password_confirm" class="form-control" placeholder="Nhập lại mật khẩu mới">
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Lưu thay
                            đổi</button></div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection

@section("js")
<script>
    $("#back_btn").click(function() {
    window.history.back();
});
</script>
@endsection