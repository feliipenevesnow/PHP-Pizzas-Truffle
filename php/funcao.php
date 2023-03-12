<?php

include_once 'conexao.php';

function listar_pizzas() {
    $conn = conectar();

    $query = "SELECT * FROM pizza ";
    $result = mysqli_query($conn, $query);

    $pizzas = null;

    while ($row = mysqli_fetch_assoc($result)) {
        $pizzas[] = $row;
    }

    return $pizzas;
}

function listar_bebidas() {
    $conn = conectar();

    $query = "SELECT * FROM bebida";
    $result = mysqli_query($conn, $query);

    $pizzas = null;

    while ($row = mysqli_fetch_assoc($result)) {
        $pizzas[] = $row;
    }

    return $pizzas;
}

function listar_ingredientes_por_pizza($pizza) {
    $conn = conectar();

    $query = "SELECT * FROM ingrediente_pizza WHERE pizza = $pizza";
    $result = mysqli_query($conn, $query);

    $ingredientes = null;

    while ($row = mysqli_fetch_assoc($result)) {
        $ingredientes[] = $row;
    }

    return $ingredientes;
}

function buscar_pizza_por_codigo($id) {
    $conn = conectar();

    $query = "SELECT * FROM pizza WHERE codigo = $id";
    $result = mysqli_query($conn, $query);

    $pizza = null;

    while ($row = mysqli_fetch_assoc($result)) {
        $pizza[] = $row;
    }

    return $pizza[0];
}

function buscar_bebida_por_codigo($id) {
    $conn = conectar();

    $query = "SELECT * FROM bebida WHERE codigo = $id";
    $result = mysqli_query($conn, $query);

    $bebida = null;

    while ($row = mysqli_fetch_assoc($result)) {
        $bebida[] = $row;
    }

    return $bebida[0];
}

function buscar_caixa() {
    $conn = conectar();

    $query = "SELECT * FROM caixa WHERE data_fechamento is null";
    $result = mysqli_query($conn, $query);

    $caixa = null;

    while ($row = mysqli_fetch_assoc($result)) {
        $caixa[] = $row;
    }

    return $caixa[0];
}

function buscar_ultima_venda() {
    $conn = conectar();

    $query = "SELECT * FROM venda ORDER BY codigo DESC limit 1";
    $result = mysqli_query($conn, $query);

    $venda = null;

    while ($row = mysqli_fetch_assoc($result)) {
        $venda[] = $row;
    }

    return $venda[0];
}

function finalizar($endereco, $bairro, $nome) {
    date_default_timezone_set('UTC');

    $conn = conectar();

    $caixa = buscar_caixa();
    $today = date("Y-m-d");
    $total = $_GET['total'] - 5;

    $query = "INSERT INTO venda(caixa, data, total, desconto, status) VALUES(" . $caixa['codigo'] . ", '$today', $total, 0, 'ONLINE')";
    mysqli_query($conn, $query);

    $venda = buscar_ultima_venda();

    foreach ($_SESSION['carrinho'] as $produto) {
        if (key($produto) != null) {
            if (key($produto[key($produto)]) == "pizza") {
                foreach ($produto as $pizza) {
                    $query = "INSERT INTO pizza_venda VALUES(" . $venda['codigo'] . ", " . $pizza['pizza']['codigo'] . ", '" . $pizza['borda'] . "'," . $pizza['quantidade'] . "," . $pizza['quantidade'] * $pizza['pizza']['preco'] . ", '" . $pizza['observacao'] . "' )";
                    echo $query;
                    mysqli_query($conn, $query);
                }
            } else {
                foreach ($produto as $bebida) {
                    $query = "INSERT INTO bebida_venda VALUES(" . $venda['codigo'] . "," . $bebida['bebida']['codigo'] . "," . $bebida['quantidade'] . "," . $bebida['bebida']['codigo'] * $bebida['quantidade'] . ")";
                    mysqli_query($conn, $query);
                }
            }
        }
    }

    $query = "INSERT INTO pedido_online(venda, endereco, bairro, nome) VALUES (" . $venda['codigo'] . ", '" . $endereco . "','" . $bairro . "','" . $nome . "') ";
    mysqli_query($conn, $query);

    unset($_SESSION['carrinho']);

    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = array();
    }

    header("Location: ../carrinho.php");
}
