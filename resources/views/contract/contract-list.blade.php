@extends('layout.master')
@section("header_section")
<link href="{{ asset('css/dashboard/listUser.css') }}" rel="stylesheet">
@endsection
@section("content")
<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Quản lý hợp đồng</strong></h1>
        <div class="row">
            <div class="card flex-fill w-100">
                <div class="card-header list-title">
                    <h5 class="card-title mb-0">Danh sách hợp đồng</h5>
                </div>
                <div class="card-body py-3">
                    <table class="table text-start align-middle table-bordered table-hover mb-0 mt-5"
                        id="datatable-contract-list">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col">Số hợp đồng</th>
                                <th scope="col">Loại hợp đồng</th>
                                <th scope="col">Ngày tạo hợp đồng</th>
                                <th scope="col">Tên Khách hàng</th>
                                <th scope="col">Tư vấn bán hàng</th>
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
    var listContract = '{{ route('contract.list.get') }}';
</script>
<script src="{{ URL::asset('js/dashboard/list-contract.js') }}"></script>
@endsection