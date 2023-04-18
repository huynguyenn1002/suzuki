@extends('layout.master')
@section('header_section')
    <link href="{{ asset('css/dashboard/list-saler.css') }}" rel="stylesheet">
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Quản lý Nhân viên</strong></h1>
            <div class="row">
                <div class="card flex-fill w-100">
                    <div class="card-header list-title">
                        <h5 class="card-title mb-0">Danh sách Nhân viên</h5>
                        <button type="button" class="btn btn-primary" id="myBtn" onclick="addNewSaler()"
                            data-bs-toggle="modal" data-bs-target="#myModal">
                            Thêm nhân viên mới
                        </button>
                    </div>
                    <div class="card-body py-3">
                        <table class="table text-start align-middle table-bordered table-hover mb-0"
                            id="datatable-saler-list">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">Họ và Tên</th>
                                    <th scope="col">Số điện thoại</th>
                                    <th class="actionBtn" scope="col"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- The Modal -->
        <div id="modalSalerDetail" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close" id="close-register-modal">&times;</span>
                    <h2>Thêm mới nhân viên</h2>
                </div>
                <form action="{{ route('saler.add') }}" method="post" id="category-data">
                    @csrf
                    <input type="hidden" id="salerId" name="salerId">
                    <div class="modal-body">
                        <div class="mb-3 saler-name">
                            <div class="first-name">
                                <label for="firstName">
                                    <h6>Họ</h6>
                                </label>
                                <input type="text" required class="form-control" placeholder="Nhập vào Họ..."
                                    id="firstName" name="firstName">
                            </div>
                            
                            <div class="last-name">
                                <label for="lastName">
                                    <h6>Tên</h6>
                                </label>
                                <input type="text" required class="form-control" placeholder="Nhập vào Tên..."
                                    id="lastName" name="lastName">
                            </div>
                            
                            <div class="last-name">
                                <label for="tel">
                                    <h6>Số điện thoại</h6>
                                </label>
                                <input type="text" required class="form-control" placeholder="Nhập vào Số điện thoại..."
                                    id="tel" name="tel">
                            </div>
                        </div>


                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-confirm" id="submit">Thêm</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="closeBtn">Đóng</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script>
        var listSaler = '{{ route('saler.get') }}';
        var addNewSaler = '{{ route('saler.add') }}';
        var salerDetail = '{{ route('saler.detail') }}';
        var deleteSaler = '{{ route('saler.delete') }}';
    </script>
    <script src="{{ URL::asset('js/dashboard/list-saler.js') }}"></script>
@endsection
