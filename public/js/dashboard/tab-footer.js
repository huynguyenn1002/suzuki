$(function () {
    const url2 = `/admin/get-ward-info/`;

    $.fn.getWardInfo = function (url2, elm, districtCode) {
        $_token = "{{ csrf_token() }}";
        $.ajax({
            headers: { "X-CSRF-Token": $("meta[name=_token]").attr("content") },
            url: `${url2}`,
            type: "GET",
            data: { districtCode },
            success: function (result) {
                elm.html(result.html);
            },
            error: function (xhr, textStatus, thrownError) {
                alert(xhr + "\n" + textStatus + "\n" + thrownError);
            },
        });
    };

    $.fn.getDistrictInfo = function (url, elm, provinceCode, firstCall = false) {
        $_token = "{{ csrf_token() }}";
        $.ajax({
            headers: { "X-CSRF-Token": $("meta[name=_token]").attr("content") },
            url: `${url}`,
            type: "GET",
            data: { provinceCode },
            success: function (result) {
                elm.html(result.html);
                if (firstCall) {
                    var tmp = result.district_id;
                    $.fn.getWardInfo(url2, $("#ward"), tmp);
                } else {
                    $.fn.getWardInfo(url2, $("#ward"), null);
                }
            },
            error: function (xhr, textStatus, thrownError) {
                alert(xhr + "\n" + textStatus + "\n" + thrownError);
            },
        });
    };

    $provinceCode = $("#province").val();
    let url = `/admin/get-district-info/`;
    $.fn.getDistrictInfo(url, $("#district"), $provinceCode, true);

    $("#province").on("change", function (e) {
        $provinceCode = $("#province").val();
        e.preventDefault();
        let url = `/admin/get-district-info/`;
        $.fn.getDistrictInfo(url, $("#district"), $provinceCode);
    });

    $("#district").on("change", function (e) {
        $districtCode = $("#district").val();
        e.preventDefault();
        let url2 = `/admin/get-ward-info/`;
        $.fn.getWardInfo(url2, $("#ward"), $districtCode);
    });
});

$("nav#sidebar li.sidebar-item").removeClass("active");
$("nav#sidebar li.contract-create").addClass("active");

$("#back_btn").click(function (){
    window.history.back();
});

var today = new Date();
var dd = String(today.getDate()).padStart(2, "0");
var mm = String(today.getMonth() + 1).padStart(2, "0");
var yyyy = today.getFullYear();

headerContract = yyyy + mm + "-";

$("#headerContract").val(headerContract);

$('#realPrice, #noticePrice, #invoiceSellingPrice, #deposit, #paymentAmount, #amountOfCommission').on('change click keyup input paste',(function (event) {
    $(this).val(function (index, value) {
        return value.replace(/(?!\.)\D/g, "").replace(/(?<=\..*)\./g, "").replace(/(?<=\.\d\d).*/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    });
}));

$("#carID").on("change", function(e) {
    var car_id = $("#carID").val();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: getTypeCar,
        type: "POST",
        data: {car_id},
        success: function(response) {
            $("#carType").val(response.success.type);
            $("#noticePrice").val(response.price);
        },
    });
});

$("#saleName").on("change", function(e) {
    var saler_id = $("#saleName").val();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: getSalerPhone,
        type: "POST",
        data: {saler_id},
        success: function(response) {
            $("#salesPhone").val(response.success.tel);
        },
    });
});

$(".create-button").on("click", function() {
    var contractHeader =  $("#headerContract").val();
    var contractNum =  $("#contractNum").val();
    var checkContractNum = contractHeader + contractNum
    $("#checkContractNum").val(checkContractNum);
})

$("#customerType").on("change", function() {
    var type = $("#customerType").find(":selected").val();
    if (type == 1) {
        $("#representative-area").hide();
        $("#position-area").hide();
        $("#tax-area").hide();
        $("#tax-issuance-area").hide();
        $("#tax-place-area").hide();
        $("#gender-area").show();
        $("#birthday-area").show();
        $("#customerIDCard-area").show();
        $("#icCardDateRegister-area").show();
        $("#issuedBy-area").show();
    } else {
        $("#gender-area").hide();
        $("#birthday-area").hide();
        $("#customerIDCard-area").hide();
        $("#icCardDateRegister-area").hide();
        $("#issuedBy-area").hide();
        $("#representative-area").show();
        $("#position-area").show();
        $("#tax-area").show();
        $("#tax-issuance-area").show();
        $("#tax-place-area").show();
    }
})

$(function() {
    $('#carDeliveryTime').datepicker( {
        locale: 'vi',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        monthNamesShort: ["Tháng 1","Tháng 2","Tháng 3","Tháng 4","Tháng 5","Tháng 6","Tháng 7","Tháng 8","Tháng 9","Tháng 10","Tháng 11","Tháng 12"],
        monthNames: ["Tháng 1","Tháng 2","Tháng 3","Tháng 4","Tháng 5","Tháng 6","Tháng 7","Tháng 8","Tháng 9","Tháng 10","Tháng 11","Tháng 12"],
        currentText: "Tháng hiện tại",
        dateFormat: 'MM yy',
        closeText:'Chọn',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });
});