$(function () {
    $("#pesquisa-pizza").keyup(function () {
        var pesquisa = $(this).val();

        var dados = {
            palavra: pesquisa
        }
        $.post('./php/proc_pizza.php', dados, function (retorna) {
            $(".resultado-pizza").html(retorna);
        });
    });
});
