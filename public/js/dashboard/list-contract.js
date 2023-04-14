var table;
jQuery().ready(function () {
    table = $("#datatable-contract-list").DataTable({
        className: "details-control",
        searching: false,
        processing: true,
        serverSide: true,
        searching: true,
        paging: false,
        oLanguage: {
            "sSearch": "Tìm kiếm"
        },
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
                        <a class="btn btn-info" href="detail?contractID=${row.ID}">Chi tiết</a>
                        <button type="submit" class="btn btn-primary">Xuất hợp đồng</button>
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