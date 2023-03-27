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
                        <button class="btn btn-primary" onclick="showDetail(${row.ID})">Thông tin chi tiết</button>
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

function showDetail(id) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: userDetail,
        type: "POST",
        data: {id},
        dataType: "json",
        success: function (response) {
            console.log(response);
            $("#first_name").val(response.userDetail.first_name);
            $("#last_name").val(response.userDetail.last_name);
            $("#tel").val(response.userDetail.tel);
            $("#citizen_identification").val(response.userDetail.citizen_identification);
            $("#emailDetail").val(response.admin.email);
        },
    });
    $("#modalUserDetail").show();
}

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
