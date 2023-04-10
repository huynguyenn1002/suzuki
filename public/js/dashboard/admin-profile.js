$(function () {
    const url2 = `/admin/get-ward-info/`;
    $districtCodeDetail = $("#value_province").val();

    $.fn.getWardInfo = function (url2, elm, districtCode, districtCodeDetail) {
        $_token = "{{ csrf_token() }}";
        $.ajax({
            headers: { "X-CSRF-Token": $("meta[name=_token]").attr("content") },
            url: `${url2}`,
            type: "GET",
            data: { districtCode, districtCodeDetail },
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
                    var districtCodeDetail = $("#value_province").val();
                    var tmp = result.district_id;
                    $.fn.getWardInfo(url2, $("#ward"), tmp, districtCodeDetail);
                } else {
                    $.fn.getWardInfo(url2, $("#ward"), null, null);
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