@extends('layout.master')
@section("header_section")
<style>
    table {
        border: 1px solid black;
        table-layout: fixed;
        width: 200px;
    }
</style>
@endsection
@section("content")
<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>
        <div class="row">


            <div class="card flex-fill w-100">
                <div class="card-header">

                    <h5 class="card-title mb-0">Recent Movement</h5>
                </div>
                <div class="card-body py-3">
                    <table class="table text-start align-middle table-bordered table-hover mb-0"
                        id="datatable-user-list">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col">Họ và Tên</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
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