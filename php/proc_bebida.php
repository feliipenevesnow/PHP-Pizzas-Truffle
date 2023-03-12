<?php

include_once 'conexao.php';
include_once 'funcao.php';

$conn = conectar();

$nome = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_STRING);

$query = "SELECT * FROM bebida WHERE nome LIKE '%$nome%'";
$result = mysqli_query($conn, $query);

if (isset($result) && mysqli_num_rows($result) > 0) {

    while ($linha = mysqli_fetch_assoc($result)) {
       echo "<div class='col-md-4 text-center'>
                                                        <div class='menu-wrap'>
                                                            <a href='#' class='menu-img img mb-4' style='background-image: url(images/drink-1.jpg);'></a>
                                                            <div class='text'>
                                                                <h3><a href='#'>". $linha['nome'] ."</a></h3>
                                                                <p>Quantidade: ". $linha['quantidade'] ." unid.</p>
                                                                <p class='price'><span> ". $linha['preco'] ." </span></p>
                                                                <p><a href='#' class='btn btn-white btn-outline-white'>Adicionar ao carrinho</a></p>
                                                            </div>
                                                        </div>
                                                    </div>";
    }
} else {
    
}
