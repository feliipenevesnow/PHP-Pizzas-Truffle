$(function () {
    $("#pesquisa-bebida").keyup(function () {
        var pesquisa = $(this).val();

        var dados = {
            palavra: pesquisa
        }
        $.post('./php/proc_bebida.php', dados, function (retorna) {
            $(".resultado-bebida").html(retorna);
        });
    });
});
