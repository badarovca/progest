$(document).ready(function () {
    atualiza_total();

    $("#add-material").click(function (event) {
        event.preventDefault();
        url = $("#base_url").val() + '/form-material';
        $.get(
                url,
                function (data) {
                    $(".new-material").append(data.html);
                    $.mascarar_campos();
                    $('.codigo-material').last().focus();
                });
    });

    $("#add-material-saida").click(function () {
        material_id = $("#material_id").val();
        qtd = $("#qtd-material").val();
        //verifica campos vazios
        if (qtd == '' || material_id == '')
            return;
        var continua = true;
        //verifica se o material já está na lista
        $(".item-saida-material").each(function () {
            continua = ($(this).find("td:first").html() === material_id) ? false : true;
            if (!continua)
                return false;
        });
        if (!continua)
            return;
        $("#qtd-material").val('');
        url = $("#base_url").val() + '/add-material-saida/' + material_id + "/" + qtd;
        $.get(
                url,
                function (data) {
                    if (data.success === true) {
                        $("#lista-materiais").append(data.html);
                        $(".saida-material-select2").select2('open');
                    } else {
                        $("#response-msg").html(data.html);
                    }

                });
    });

    $(".multiple-select").select2({
    });
    $(".material-select2").select2({
    });
    $(".saida-material-select2").select2({
        dropdownCssClass: 'saida-material'
    });

    $(document).on('keydown', '.select2-search__field', function (e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13 && $('.select2-search__field').parents('.saida-material').length == 1) {
            $("#qtd-material").val('1');
            $("#qtd-material").focus();
            $("#qtd-material").select();
            e.preventDefault();
            return false;
        }
    });
    $(document).on('keydown', '#qtd-material', function (e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            $("#add-material-saida").trigger('click');
            e.preventDefault();
            return false;
        }
    });

    $("#add-material-empenho").on('click', function (e) {
        if ($('#qtd-material').val() != '' && $('#valor-material').val() != '' && $("#material_id").val() != '' && $("#sub_item_id").val() != '') {
            material_id = $("#material_id").val();
            material_descricao = $("#material_id option:selected").text();
            qtd = $("#qtd-material").val();
            valor = $("#valor-material").val();
            vencimento = $("#vencimento").val();
            subItem = $("#sub_item_id").val();
            temp = valor.replace('.', '');
            temp = temp.replace(',', '.');
            valor_unitario = parseFloat(temp) / parseInt(qtd);
            valor_unitario = number_format(valor_unitario.toFixed(2), 2, ',', '.');
            $("#lista-materiais").append("\
                <tr id='" + material_id + "'>\n\
                <td style='width: 15%'>" + material_id + "</td>\n\
                <td style='width: 35%'>" + material_descricao + "</td>\n\
                <td style='width: 10%'><input type='text' class='form-control' name='submateriais[" + material_id + "][qtd_solicitada]' id='qtds[" + material_id + "]' value='" + qtd + "' required readonly='true'></td>\n\
                <td style='width: 10%'><input type='text' class='form-control valor-total-material' name='submateriais[" + material_id + "][vl_total]' id='valores_materiais[" + material_id + "]' value='" + valor + "' required readonly='true'></td>\n\
                <td style='width: 10%'><input type='text' class='form-control valor' value='" + valor_unitario + "' readonly='true' autofocus></td>\n\
                <td style='width: 10%'><input type='date' class='form-control'name='submateriais[" + material_id + "][vencimento]' id='vencimentos_materiais[" + material_id + "]' value='" + vencimento + "' readonly='true' autofocus></td>\n\
                <td style='width: 5%'><input type='text' class='form-control' name='submateriais[" + material_id + "][subItem]' id='subItems_materiais[" + material_id + "]' value='" + subItem + "' readonly='true' autofocus></td>\n\
                <td style='width: 5%'><a href='javascript:void(0)' class='btn btn-danger btn-xs remove-material' ><i class='fa fa-fw fa-remove'></i> remover</a></td>\n\
                </tr>");
            $('#qtd-material').val("");
            $('#valor-material').val("");
            $('#vencimento').val("");
            atualiza_total();
        }
        return;
    });

    //controle de filtros do relatorio
    $(".criterio-filtro").on('click', function () {
        select = $(this).val();
        $("select.select-filtro").attr('disabled', 'disabled');
        $("#" + select + "_id").removeAttr('disabled');
    });

    //atualiza lista de meses a partir do ano 
    $("#ano_relatorio").click(function () {
        ano = $("#ano_relatorio").val();
        url = $("#base_url").val() + '/get-meses-relatorio/' + ano;
        $.get(
                url,
                function (data) {
                    if (data.success === true) {
                        $("#meses_relatorio").html('');
                        $("#meses_relatorio").append(data.html);
                    }
                });
    });

    //remove material já cadastrado da listagem
    $("table").on("click", ".remove-material", function () {
        $(this).closest("tr").remove();
        atualiza_total();
    });

    //remove form de cadastro de novo material
    $(document).on("click", ".remove-form-material", function () {
        $(this).closest("fieldset").remove();
        atualiza_total();
    });

    //atualiza total quando um novo material está sendo adicionado
    $(document).on("keyup", '.valor-total-material', function (event) {
        atualiza_total();
    });

    //tranforma tabelas html em DataTables
    $("#listaMateriais").DataTable({
        "language": {
            "url": $("#base_url").val() + "/js/data-table-pt-br.js"
        },
        bPaginate: false,
        bFilter: false, bInfo: false
    });
});


function atualiza_total() {
    if ($('html').find('valor-total-material')) {
        total = 0;
        $('.valor-total-material').each(function (index) {
            temp = $(this).val().replace('.', '');
            temp = temp.replace(',', '.');
            total += parseFloat(temp);
        });
        total = number_format(total, 2, ',', '.');
        $("#valor-total-empenho").html(total);
    }
}

//formatar números, assim como a função php numer_format
function number_format(number, decimals, dec_point, thousands_sep) {
    // Strip all characters but numerical ones.
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}