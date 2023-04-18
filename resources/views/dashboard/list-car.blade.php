@extends('layout.master')
@section('header_section')
    <link href="{{ asset('css/dashboard/list-car.css') }}" rel="stylesheet">
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Quản lý Xe</strong></h1>
            <div class="row">
                <div class="card flex-fill w-100">
                    <div class="card-header list-title">
                        <h5 class="card-title mb-0">Danh sách Mẫu xe</h5>
                        <button type="button" class="btn btn-primary" id="myBtn" onclick="addNew()"
                            data-bs-toggle="modal" data-bs-target="#myModal">
                            Thêm mẫu xe mới
                        </button>
                    </div>
                    <div class="card-body py-3">
                        <table class="table text-start align-middle table-bordered table-hover mb-0"
                            id="datatable-car-list">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">Tên mẫu xe</th>
                                    <th scope="col">Giá (VNĐ)</th>
                                    <th scope="col">Loại xe</th>
                                    <th class="actionBtn" scope="col"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- The Modal -->
        <div id="modalCarDetail" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close" id="close-register-modal">&times;</span>
                    <h2>Thêm mới mẫu xe</h2>
                </div>
                <form action="{{ route('car.add') }}" method="post" id="category-data">
                    @csrf
                    <input type="hidden" id="carID" name="carID">
                    <div class="modal-body">
                        <div class="mb-3 car-name">
                            <div>
                                <label for="carName">
                                    <h6>Tên mẫu xe</h6>
                                </label>
                                <input type="text" required class="form-control" placeholder="Nhập vào Tên mẫu xe..."
                                    id="carName" name="carName">
                            </div>
                            
                            <div>
                                <label for="price">
                                    <h6>Giá</h6>
                                </label>
                                <input type="text" required class="form-control" placeholder="Nhập vào Giá xe..."
                                    id="price" name="price">
                            </div>
                            
                            <div class="car-type">
                                <label for="type">
                                    <h6>Loại xe</h6>
                                </label>
                                <select name="type" id="type">
                                    <option value="0">Vui lòng chọn loại xe</option>
                                    <option value="1">Nhập khẩu nguyên chiếc</option>
                                    <option value="2">Lắp ráp trong nước</option>
                                </select>
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
        var listCar = '{{ route('car.get') }}';
        var addNewCar = '{{ route('car.add') }}';
        var carDetail = '{{ route('car.detail') }}';
        var deleteCar = '{{ route('car.delete') }}';
    </script>
    <script src="{{ URL::asset('js/dashboard/list-car.js') }}"></script>
@endsection
