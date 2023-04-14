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