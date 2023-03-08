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

var today = new Date();
var dd = String(today.getDate()).padStart(2, "0");
var mm = String(today.getMonth() + 1).padStart(2, "0");
var yyyy = today.getFullYear();

contractNum = yyyy + mm + "-";

$("#contractNum").val(contractNum);

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
            var price = response.success.price;
            if (price == null) {
                price = 0
            }
            price = parseInt(price).toFixed(1).replace(/\d(?=(\d{3})+\.)/g, '$&,')
            $("#carType").val(response.success.type);
            $("#noticePrice").val(price);
        },
    });
});