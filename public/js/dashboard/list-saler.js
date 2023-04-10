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
            $("#province_name").val(response.userDetail.province_name);
            $("#district_name").val(response.userDetail.district_name);
            $("#ward_name").val(response.userDetail.ward_name);
            $("#address").val(response.userDetail.address);
            $("#emailDetail").val(response.admin.email);
        },
    });
    $("#modalUserDetail").show();
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

$("nav#sidebar li.sidebar-item").removeClass("active");
$("nav#sidebar li.saler-list").addClass("active");

$("#myBtn").on("click", function() {
    $("#myModal").show();
})

$("#close-register-modal").on("click", function() {
    $("#myModal").hide();
})

$("#close-modal, #close-detail-modal").on("click", function() {
    $("#modalUserDetail").hide();
})

$("#auto-generate-password").on("click", function() {
    var random = Math.random().toString(36).substring(3,12);
    $("#password").val(random);
})

$("#passwordEdit").keyup(function(){
    $(".btn-confirm").show();
});
