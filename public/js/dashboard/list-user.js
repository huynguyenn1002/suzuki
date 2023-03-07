var table;
jQuery().ready( function () {
    table = $('#datatable-user-list').DataTable({
        className: 'details-control',
        searching: false,
        processing: true,
        serverSide: true,
        paging: false,
        ordering: false,
        ajax: {
            url: listUser,
        },
        columns: [
            {
                data: "Name",
            },
            {
                data: "Phone",
            },
            {
                data: "Email",
            },
            {
                data: "",
                render: (data, type, row) => {
                    return `<button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal"
                            data-bs-target="#myModal" id="btnEdit" onclick="viewItem(${row.ID})">Thông tin chi tiết</button>`;
                },
                bSortable: false,
            },
        ],
    });
} );