$(document).ready(function () {

    $("#add-material").click(function () {
        url = $("#base_url").val() + '/form-material';
        $.get(
                url,
                function (data) {
                    $(".new-material").append(data.html);
                });
    });

    $(".multiple-select").select2({
    });
});

function formatRepo(repo) {
    if (repo.loading)
        return repo.text;

    var markup = "<div class='select2-result-repository clearfix'>" +
            "<div class='select2-result-repository__meta'>" +
            "<div class='select2-result-repository__title'>" + repo.full_name + "</div>";
    
    return markup;
}

function formatRepoSelection(repo) {
    return repo.full_name || repo.text;
}
