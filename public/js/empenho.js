$(document).ready(function () {

    $("#add_material").click(function () {
        $.get(
                "form-material",
                function (data) {
                    console.log(data);
                    $(".new_material").append(data);
                });
    });


});