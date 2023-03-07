@extends('layout.master')
@section("header_section")
<link href="{{ asset('css/dashboard/listUser.css') }}" rel="stylesheet">
@endsection
@section("content")
<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Quản lý người dùng</strong></h1>
        <div class="row">
            <div class="card flex-fill w-100">
                <div class="card-header list-title">
                    <h5 class="card-title mb-0">Danh sách người dùng</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"
                        onclick="addNewUser()">
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
                                <th class="actionBtn" scope="col">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- The Modal Register -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle">Thêm mới người dùng</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('user.add') }}" method="post" id="category-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="email">
                                <h6>Email</h6>
                            </label>
                            <input type="text" required class="form-control" placeholder="Nhập vào Email..."
                                id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="password">
                                <h6>Mật khẩu</h6>
                            </label>
                            <input type="text" required class="form-control" placeholder="Nhập vào Mật khẩu..."
                                id="password" name="password">
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-confirm" id="submit">Thêm</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

@section("js")
<script>
    var listUser = '{{ route('user.get') }}';
    var addNewUser = '{{ route('user.add') }}';
</script>
<script src="{{ URL::asset('js/dashboard/list-user.js') }}"></script>
@endsection