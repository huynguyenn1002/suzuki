@extends('layout.master')
@section('header_section')
    <link href="{{ asset('css/dashboard/listUser.css') }}" rel="stylesheet">
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Quản lý người dùng</strong></h1>
            <div class="row">
                <div class="card flex-fill w-100">
                    <div class="card-header list-title">
                        <h5 class="card-title mb-0">Danh sách người dùng</h5>
                        <button type="button" class="btn btn-primary" id="myBtn" onclick="addNewUser()"
                            data-bs-toggle="modal" data-bs-target="#myModal">
                            Thêm người dùng mới
                        </button>
                    </div>
                    <div class="card-body py-3">
                        <table class="table text-start align-middle table-bordered table-hover mb-0"
                            id="datatable-user-list">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">Họ và Tên</th>
                                    <th scope="col">Số điện thoại</th>
                                    <th scope="col">Email</th>
                                    <th class="actionBtn" scope="col"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- The Modal -->
        <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close" id="close-register-modal">&times;</span>
                    <h2>Thêm mới người dùng</h2>
                </div>
                <form action="{{ route('user.add') }}" method="post" id="category-data">
                    @csrf
                    <div class="modal-body">
                        <div>
                            <div class="mb-3">
                                <label for="email">
                                    <h6>Email</h6>
                                </label>
                                <input type="email" required class="form-control" placeholder="Nhập vào Email..."
                                    id="email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="password">
                                    <h6>Mật khẩu</h6>
                                </label>
                                <input type="text" required class="form-control" placeholder="Nhập vào Mật khẩu..."
                                    id="password" name="password">
                            </div>

                            <div class="mb-3">
                                <label for="password">
                                    <button class="btn btn-outline-primary" type="button" id="auto-generate-password">Tạo
                                        mật khẩu ngẫu nhiên</h6>
                                </label>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-confirm" id="submit">Thêm</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div id="modalUserDetail" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close" id="close-detail-modal">&times;</span>
                    <h2>Thông tin người dùng</h2>
                </div>
                <div class="modal-body-detail">
                    <div class="info-detail">
                        <div class="info-detail-left">
                            <div class="mb-3">
                                <label for="first_name">
                                    <h6>Họ</h6>
                                </label>
                                <input readonly type="text" class="form-control" placeholder="Nhập vào Họ..."
                                    id="first_name" name="first_name">
                            </div>
                            <div class="mb-3">
                                <label for="last_name">
                                    <h6>Tên</h6>
                                </label>
                                <input readonly type="text" class="form-control" placeholder="Nhập vào Tên..."
                                    id="last_name" name="last_name">
                            </div>
                            <div class="mb-3">
                                <label for="tel">
                                    <h6>Số điện thoại</h6>
                                </label>
                                <input readonly type="text" class="form-control" placeholder="Nhập vào Số điện thoại..."
                                    id="tel" name="tel">
                            </div>
                            <div class="mb-3">
                                <label for="citizen_identification">
                                    <h6>Số CMND/CCCD</h6>
                                </label>
                                <input readonly type="text" class="form-control" placeholder="Nhập vào Số CMND/CCCD..."
                                    id="citizen_identification" name="citizen_identification">
                            </div>
                            <div class="mb-3">
                                <label for="emailDetail">
                                    <h6>Email</h6>
                                </label>
                                <input readonly type="text" class="form-control" placeholder="Nhập vào Email..."
                                    id="emailDetail" name="emailDetail">
                            </div>
                        </div>
                        <div class="info-detail-right">
                            <div class="mb-3">
                                <label for="province_name">
                                    <h6>Thành phố</h6>
                                </label>
                                <input readonly type="text" class="form-control" placeholder="Nhập vào Tên..."
                                    id="province_name" name="province_name">
                            </div>
                            <div class="mb-3">
                                <label for="district_name">
                                    <h6>Quận/Huyện</h6>
                                </label>
                                <input readonly type="text" class="form-control"
                                    placeholder="Nhập vào Số điện thoại..." id="district_name" name="district_name">
                            </div>
                            <div class="mb-3">
                                <label for="ward_name">
                                    <h6>Phường/Xã</h6>
                                </label>
                                <input readonly type="text" class="form-control"
                                    placeholder="Nhập vào Số CMND/CCCD..." id="ward_name"
                                    name="ward_name">
                            </div>
                            <div class="mb-3">
                                <label for="address">
                                    <h6>Địa chỉ</h6>
                                </label>
                                <input readonly type="text" class="form-control" placeholder="Nhập vào Email..."
                                    id="address" name="address">
                            </div>
                            <div class="mb-3">
                                <label for="password">
                                    <h6>Thay đổi Mật khẩu</h6>
                                </label>
                                <input type="text" required class="form-control" placeholder="Nhập vào Mật khẩu..."
                                    id="passwordEdit" name="password">
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="userID" name="userID">

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-confirm" id="submitEdit" style="display: none">Lưu thay đổi</button>
                        <button type="button" id="close-modal" class="btn btn-danger"
                            data-bs-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script>
        var listUser = '{{ route('user.get') }}';
        var addNewUser = '{{ route('user.add') }}';
        var userDetail = '{{ route('user.detail') }}';
        var updateUser = '{{ route('user.update') }}';
        var deleteUser = '{{ route('user.delete') }}';
    </script>
    <script src="{{ URL::asset('js/dashboard/list-user.js') }}"></script>
@endsection
