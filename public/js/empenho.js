$(document).ready(function () {

    $("#add-material").click(function () {
        url = $("#base_url").val()+'/form-material';
        $.get(
                url,
                function (data) {
                    $(".new-material").append(data.html);
                });
    });


});