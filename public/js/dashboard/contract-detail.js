$(function () {
    const url2 = `/admin/get-ward-info/`;

    $.fn.getWardInfo = function (url2, elm, districtCode, districtCodeDetail, idContract) {
        $_token = "{{ csrf_token() }}";
        $.ajax({
            headers: { "X-CSRF-Token": $("meta[name=_token]").attr("content") },
            url: `${url2}`,
            type: "GET",
            data: { districtCode, districtCodeDetail, idContract },
            success: function (result) {
                elm.html(result.html);
            },
            error: function (xhr, textStatus, thrownError) {
                alert(xhr + "\n" + textStatus + "\n" + thrownError);
            },
        });
    };

    $.fn.getDistrictInfo = function (url, elm, provinceCode, firstCall = false, detailProvinceID, idContract) {
        $_token = "{{ csrf_token() }}";
        $.ajax({
            headers: { "X-CSRF-Token": $("meta[name=_token]").attr("content") },
            url: `${url}`,
            type: "GET",
            data: { provinceCode, detailProvinceID, idContract },
            success: function (result) {
                elm.html(result.html);
                if (firstCall) {
                    var tmp = result.district_id;
                    var districtCodeDetail = $("#value_district").val();
                    $.fn.getWardInfo(url2, $("#ward"), tmp, districtCodeDetail, idContract);
                } else {
                    $.fn.getWardInfo(url2, $("#ward"), null, null, null);
                }
            },
            error: function (xhr, textStatus, thrownError) {
                alert(xhr + "\n" + textStatus + "\n" + thrownError);
            },
        });
    };

    $provinceCode = $("#province").val();
    var detailProvinceID = $("#value_province").val();
    var idContract = $("#idContract").val();
    let url = `/admin/get-district-info/`;
    $.fn.getDistrictInfo(url, $("#district"), $provinceCode, true, detailProvinceID, idContract);

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

$('#realPrice, #noticePrice, #invoiceSellingPrice, #deposit, #paymentAmount, #amountOfCommission').on('change click keyup input paste',(function (event) {
    $(this).val(function (index, value) {
        return value.replace(/(?!\.)\D/g, "").replace(/(?<=\..*)\./g, "").replace(/(?<=\.\d\d).*/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    });
}));

$("nav#sidebar li.sidebar-item").removeClass("active");
$("nav#sidebar li.contract-list").addClass("active");

$("#back_btn").click(function() {
    window.history.back();
});

$("#btnUpdate").on("click", function() {
    $("#contractNum, #contractSignDate, #customerName, #brokerName, #brokerAddress, #brokerIDCard, #brokerPhone, #amountOfCommission, #salesPhone, #customerBirthday, #position, #representative, #taxCode, #taxCodeIssuancePlace, #taxCodeIssuanceDate, #province, #district, #ward, #address, #customerPhone, #customerIDCard, #icCardDateRegister, #issuedBy, #mailAddress, #carColor, #yearOfCar, #noticePrice, #realPrice, #amount, #deposit, #carDeliveryTime, #promotionalContent, #gift").attr("readonly", false)
    $("#btnUpdateSubmit").show();
    $('#saleName, #contractType, #customerType, #carID, #carType, #customerGender')
        .attr('disabled', false);
});

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

var checkCustomerType = $("#customerType").find(":selected").val();
if (checkCustomerType == 1) {
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
} else if (checkCustomerType == 2){
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
} else {
    $("#gender-area").show();
    $("#birthday-area").show();
    $("#customerIDCard-area").show();
    $("#icCardDateRegister-area").show();
    $("#issuedBy-area").show();
    $("#representative-area").show();
    $("#position-area").show();
    $("#tax-area").show();
    $("#tax-issuance-area").show();
    $("#tax-place-area").show();
}