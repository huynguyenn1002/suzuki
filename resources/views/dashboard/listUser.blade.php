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
                                <th class="actionBtn" scope="col">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal Register -->
    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
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
                            <input type="text" required class="form-control" placeholder="Nhập vào Email..." id="email"
                                name="email">
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
                                <h6>Tạo mật khẩu ngẫu nhiên</h6>
                            </label>
                            <input type="checkbox" id="randomPassword">
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
   
</main>
@endsection

@section("js")
<script>
var modal = document.getElementById("myModal");

var btn = document.getElementById("myBtn");

var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
    modal.style.display = "block";
}

span.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
<script>
var listUser = '{{ route('user.get') }}';
var addNewUser = '{{ route('user.add') }}';
</script>
<script src="{{ URL::asset('js/dashboard/list-user.js') }}"></script>
@endsection