<?php

include_once 'funcao.php';
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if (isset($_GET['op'])) {
    switch ($_GET['op']) {
        case 1:
            $_SESSION['carrinho']['pizza'][$id]['pizza'] = buscar_pizza_por_codigo($id);
            if (isset($_POST['observacao']))
                $_SESSION['carrinho']['pizza'][$id]['observacao'] = $_POST['observacao'];
            $_SESSION['carrinho']['pizza'][$id]['quantidade'] = 1;
            $_SESSION['carrinho']['pizza'][$id]['borda'] = $_POST['borda'];
            header("Location: ../menu.php");
            exit;
            break;
        case 2:
            $_SESSION['carrinho']['bebida'][$id]['bebida'] = buscar_bebida_por_codigo($id);
            $_SESSION['carrinho']['bebida'][$id]['quantidade'] = 1;
            header("Location: ../menu.php");
            exit;
            break;
        case 3:
            $_SESSION['carrinho']['pizza'][$id]['quantidade'] = $_SESSION['carrinho']['pizza'][$id]['quantidade'] + 1;
            header("Location: ../carrinho.php");
            break;
        case 4:
            if ($_SESSION['carrinho']['pizza'][$id]['quantidade'] > 1) {
                $_SESSION['carrinho']['pizza'][$id]['quantidade'] = $_SESSION['carrinho']['pizza'][$id]['quantidade'] - 1;
            }
            header("Location: ../carrinho.php");
            break;
        case 5:
            $_SESSION['carrinho']['bebida'][$id]['quantidade'] = $_SESSION['carrinho']['bebida'][$id]['quantidade'] + 1;
            header("Location: ../carrinho.php");
            break;
        case 6:
            if ($_SESSION['carrinho']['bebida'][$id]['quantidade'] > 1) {
                $_SESSION['carrinho']['bebida'][$id]['quantidade'] = $_SESSION['carrinho']['bebida'][$id]['quantidade'] - 1;
            }
            header("Location: ../carrinho.php");
            break;
        case 7:
            unset($_SESSION['carrinho']['pizza'][$id]);
            header("Location: ../carrinho.php");
            break;
        case 8: 
            unset($_SESSION['carrinho']['bebida'][$id]);
            header("Location: ../carrinho.php");
            break;
        case 9:
            finalizar($_POST['endereco'], $_POST['bairro'], $_POST['nome']);
            break;
    }
} else {
    header("Location: ../menu.php");
}
 