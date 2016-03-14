jQuery(function ($) {
    $.mascarar_campos = function () {
        //mask para o SIAPE
        $("#siape").mask("9999999");

        //mask para telefone
        $("#telefone").focusout(function () {
            var phone, element;
            element = $(this);
            element.unmask();
            phone = element.val().replace(/\D/g, '');
            if (phone.length > 10) {
                element.mask("(99) 99999-999?9");
            } else {
                element.mask("(99) 9999-9999?9");
            }
        }).trigger('focusout');

        //mask para email
        //$("#email").mask("");

        //mask para cnpj
        $("#cnpj").mask("99.999.999/9999-99");

        //mask para telefone 1
        $("#telefone1").focusout(function () {
            var phone, element;
            element = $(this);
            element.unmask();
            phone = element.val().replace(/\D/g, '');
            if (phone.length > 10) {
                element.mask("(99) 99999-999?9");
            } else {
                element.mask("(99) 9999-9999?9");
            }
        }).trigger('focusout');

        //mask para telefone 1
        $("#telefone2").focusout(function () {
            var phone, element;
            element = $(this);
            element.unmask();
            phone = element.val().replace(/\D/g, '');
            if (phone.length > 10) {
                element.mask("(99) 99999-999?9");
            } else {
                element.mask("(99) 9999-9999?9");
            }
        }).trigger('focusout');

        //mask para numero de empenho
        $("#numero").mask("9999NE899999");

        //mask para numero da categoria da despesa de empenho
        $("#cat_despesa").mask("9?99");

        //mask para mod. aplicação de empenho
        $("#mod_aplicacao").mask("9?99");

//        //mask para elemento de consumo de empenho
//        $("#el_consumo").mask("9?99");

        //mask para num. processo de empenho
        $("#num_processo").mask("99999999999/99-99");

        //mask para codigo de material
//        $("#codigo").mask("99999?99999999");

        //mask para numero NF
        $("#num_nf").mask("999.999.999");

        //mask para codigo chave - codigo de barras da NFe
        $("#cod_chave").mask("99999999999999999999999999999999999999999999");

        //mask para campos valor
        $(".valor").maskMoney({thousands: '.', decimal: ','});

    };
    $.mascarar_campos();
});