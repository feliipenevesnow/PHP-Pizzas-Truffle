<?php

include_once 'conexao.php';
include_once 'funcao.php';

$conn = conectar();

$nome = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_STRING);

$query = "SELECT * FROM pizza WHERE nome LIKE '%$nome%'";
$result = mysqli_query($conn, $query);

if (isset($result) && mysqli_num_rows($result) > 0) {

    while ($linha = mysqli_fetch_assoc($result)) {
        echo " <div class='col-md-4 text-center'>
                                                        <div class='menu-wrap'>
                                                            <a href='#' class='menu-img img mb-4' style='background-image: url(images/pizza-1.jpg);'></a>
                                                            <div class='text'>
                                                                <h3><a href='#'>" . $linha['nome'] . "</a></h3>
                                                                <p> ";

        $ingredientes = listar_ingredientes_por_pizza($linha['codigo']);
        if (isset($ingredientes)) {
            $quantidade_elemento = 0;
            foreach ($ingredientes as $ingrediente) {
                if ($quantidade_elemento < sizeof($ingredientes) - 1) {
                    echo $ingrediente['ingrediente'] . ', ';
                } else {
                    echo $ingrediente['ingrediente'] . '. ';
                }
                $quantidade_elemento++;
            }
        }


        echo "</p>
                                                                <p class='price'><span>R$ " . $linha['preco'] . "</span></p>
                                                                <p><a href='#' class='btn btn-white btn-outline-white'>Adicione ao carrinho</a></p>
                                                            </div>
                                                        </div>
                                                    </div>";
    }
} else {
    
}
