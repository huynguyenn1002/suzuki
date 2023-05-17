var table;
jQuery().ready(function () {
    table = $("#datatable-saler-list").DataTable({
        className: "details-control",
        searching: false,
        processing: true,
        serverSide: true,
        paging: false,
        ordering: false,
        ajax: {
            url: listSaler,
        },
        columns: [
            {
                data: "Name",
            },
            {
                data: "Phone",
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
        url: salerDetail,
        type: "POST",
        data: {id},
        dataType: "json",
        success: function (response) {
            console.log(response);
            $("#firstName").val(response.salerDetail.first_name);
            $("#lastName").val(response.salerDetail.last_name);
            $("#tel").val(response.salerDetail.tel);
            $("#salerId").val(response.salerDetail.id);
            $("#submit").html('Chỉnh sửa');
        },
    });

    $("#modalSalerDetail").show();
}

function addNewSaler() {
    $("#submit").click(function () {
        var name = $("#email").val();
        var password = $("#password").val();

        var dataRegister = {
            name: name,
            password: password
        }

        $.ajax({
            url: addNewSaler,
            type: "POST",
            data: dataRegister,
            dataType: "json",
            success: function (data) {
                window.location.reload(true);
            },
        });
    });
}

function deleteItem(id) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: deleteSaler,
        type: "POST",
        data: {id},
        dataType: "json",
        success: function (data) {
            window.location.reload(true);
        },
    });
}

$("nav#sidebar li.sidebar-item").removeClass("active");
$("nav#sidebar li.saler-list").addClass("active");

$("#myBtn").on("click", function() {
    $("#modalSalerDetail").show();
})

$("#closeBtn, #close-register-modal").on("click", function() {
    $("#modalSalerDetail").hide();
})

$("#auto-generate-password").on("click", function() {
    var random = Math.random().toString(36).substring(3,12);
    $("#password").val(random);
})

$("#passwordEdit").keyup(function(){
    $(".btn-confirm").show();
});
