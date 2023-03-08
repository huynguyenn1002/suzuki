var table;
jQuery().ready(function () {
    table = $("#datatable-contract-list").DataTable({
        className: "details-control",
        searching: false,
        processing: true,
        serverSide: true,
        paging: false,
        ordering: false,
        ajax: {
            url: listContract,
        },
        columns: [
            {
                data: "contractNum",
            },
            {
                data: "contractType",
            },
            {
                data: "contractSignDate",
            },
            {
                data: "cusName",
            },
            {
                data: "saleName",
            },
            {
                data: "",
                render: (data, type, row) => {
                    return `
                    <div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#myModal" id="btnEdit" onclick="viewItem(${row.ID})">Thông tin chi tiết</button>
                        
                        <button type="submit" class="btn btn-danger" onclick="deleteItem(${row.ID})">
                            Xoá</button>
                    </div>
                    `;
                },
                bSortable: false,
            },
        ],
    });
});

$("nav#sidebar li.sidebar-item").removeClass("active");
$("nav#sidebar li.contract-list").addClass("active");