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
                    <button type="button" class="btn btn-primary">
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
</main>
@endsection

@section("js")
<script>
    var listUser = '{{ route('user.get') }}';
</script>
<script src="{{ URL::asset('js/dashboard/list-user.js') }}"></script>
@endsection