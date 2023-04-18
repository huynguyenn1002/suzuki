var table;
jQuery().ready(function () {
    table = $("#datatable-car-list").DataTable({
        className: "details-control",
        searching: false,
        processing: true,
        serverSide: true,
        paging: false,
        ordering: false,
        ajax: {
            url: listCar,
        },
        columns: [
            {
                data: "carName",
            },
            {
                data: "Price",
            },
            {
                data: "Type",
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
        url: carDetail,
        type: "POST",
        data: {id},
        dataType: "json",
        success: function (response) {
            console.log(response);
            var price = response.carDetail.price
            var price = price?.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            $("#carName").val(response.carDetail.car_name);
            $("#price").val(price);
            $("#type").val(response.carDetail.type);
            $("#carID").val(response.carDetail.id);
            $("#submit").html('Chỉnh sửa');
        },
    });

    $("#modalCarDetail").show();
}

function addNew() {
    $("#submit").click(function () {
        var carName = $("#carName").val();
        var price = $("#price").val();
        var type = $("#type").val();

        var dataRegister = {
            carName: carName,
            price: price,
            type: type
        }

        $.ajax({
            url: addNewCar,
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
        url: deleteCar,
        type: "POST",
        data: {id},
        dataType: "json",
        success: function (data) {
            window.location.reload(true);
        },
    });
}

$('#price').on('change click keyup input paste',(function (event) {
    $(this).val(function (index, value) {
        return value.replace(/(?!\.)\D/g, "").replace(/(?<=\..*)\./g, "").replace(/(?<=\.\d\d).*/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    });
}));

$("nav#sidebar li.sidebar-item").removeClass("active");
$("nav#sidebar li.car-list").addClass("active");

$("#myBtn").on("click", function() {
    $("#modalCarDetail").show();
})

$("#close-register-modal").on("click", function() {
    $("#modalCarDetail").hide();
})

$("#closeBtn").on("click", function() {
    $("#modalCarDetail").hide();
})

$("#auto-generate-password").on("click", function() {
    var random = Math.random().toString(36).substring(3,12);
    $("#password").val(random);
})

$("#passwordEdit").keyup(function(){
    $(".btn-confirm").show();
});
