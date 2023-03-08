var table;
jQuery().ready(function () {
    table = $("#datatable-user-list").DataTable({
        className: "details-control",
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

function addNewUser() {
    $("#submit").click(function () {
        var name = $("#email").val();
        var password = $("#password").val();

        var dataRegister = {
            name: name,
            password: password
        }

        $.ajax({
            url: addNewUser,
            type: "POST",
            data: dataRegister,
            dataType: "json",
            success: function (data) {
                
                window.location.reload(true);
            },
        });
    });
}
