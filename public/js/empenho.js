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
    $(".material-select2").select2({
    });

    $(".add-material").on('click', function (e) {
        if ($('#qtd-material').val() != '' && $('#valor-material').val() != '' && $("#material_id").val() != '') {
            material_id = $("#material_id").val();
            material_descricao = $("#material_id option:selected").text();
            qtd = $("#qtd-material").val();
            valor = $("#valor-material").val();
            $("#lista-materiais").append("\
                <tr>\n\
                <td style='width: 15%'>" + material_id + "</td>\n\
                <td style='width: 65%'>" + material_descricao + "</td>\n\
                <td style='width: 10%'><input type='text' class='form-control' name='qtds[" + material_id + "]' id='qtds[" + material_id + "]' value='" + qtd + "' required readonly='true'></td>\n\
                <td style='width: 10%'><input type='text' class='form-control' name='valores_materiais[" + material_id + "]' id='valores_materiais[" + material_id + "]' value='" + valor + "' required readonly='true'></td>\n\
                </tr>");
            $('#qtd-material').val("");
            $('#valor-material').val("");
        }
        return;
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
