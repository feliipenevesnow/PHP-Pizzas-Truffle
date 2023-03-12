<!DOCTYPE html>
<?php
include_once 'php/funcao.php';
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
}

?>
<html lang="pt-br">
    <head>
        <title>Pizza's Truffle</title>
    <html lang="pt-br">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nothing+You+Could+Do" rel="stylesheet">

        <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
        <link rel="stylesheet" href="css/animate.css">

        <link rel="stylesheet" href="css/owl.carousel.min.css">
        <link rel="stylesheet" href="css/owl.theme.default.min.css">
        <link rel="stylesheet" href="css/magnific-popup.css">

        <link rel="stylesheet" href="css/aos.css">

        <link rel="stylesheet" href="css/ionicons.min.css">

        <link rel="stylesheet" href="css/bootstrap-datepicker.css">
        <link rel="stylesheet" href="css/jquery.timepicker.css">


        <link rel="stylesheet" href="css/flaticon.css">
        <link rel="stylesheet" href="css/icomoon.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
            <div class="container">
                <a class="navbar-brand" href="index.php"><span class="flaticon-pizza-1 mr-1"></span>Pizza's<br><small>Truffle</small></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="oi oi-menu"></span> Menu
                </button>
                <div class="collapse navbar-collapse" id="ftco-nav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a href="index.php" class="nav-link">Início</a></li>
                        <li class="nav-item active"><a href="menu.php" class="nav-link">Menu</a></li>
                        <li class="nav-item"><a href="carrinho.php" class="nav-link">Carrinho</a></li>
                        <li class="nav-item"><a href="servico.php" class="nav-link">Serviços</a></li>
                        <li class="nav-item"><a href="contato.php" class="nav-link">Contato</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- END nav -->



        <section class="ftco-menu">
            <div class="container-fluid">
                <div class="row d-md-flex">

                    <div class="col-lg-12 ftco-animate p-md-5">
                        <div class="row">
                            <div class="col-md-12 nav-link-wrap mb-5">
                                <div class="nav ftco-animate nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Pizza</a>

                                    <a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">Bebida</a>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex align-items-center">

                                <div class="col-md-12 tab-content ftco-animate" id="v-pills-tabContent">

                                    <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-1-tab">
                                        <div class="col-md-12 ftco-animate">
                                            <form action="#" class="contact-form">

                                                <div class="form-group">
                                                    <input id="pesquisa-pizza" type="text" class="form-control" placeholder="Pesquise pizza por nome.">
                                                </div>

                                            </form>
                                        </div>
                                        <div class="row resultado-pizza">
                                            <?php
                                            $pizzas = listar_pizzas();

                                            if (isset($pizzas)) {
                                                foreach ($pizzas as $pizza) {
                                                    ?>
                                                    <div class="col-md-4 text-center">
                                                        <div class="menu-wrap">
                                                            <a href="#" class="menu-img img mb-4" style="background-image: url(images/pizza-1.jpg);"></a>
                                                            <div class="text">
                                                                <h3><a href="#"><?php echo $pizza['nome']." ".$pizza['tamanho']; ?></a></h3>
                                                                <p>
                                                                    <?php
                                                                    $ingredientes = listar_ingredientes_por_pizza($pizza['codigo']);
                                                                    if (isset($ingredientes)) {
                                                                        $quantidade_elemento = 0;
                                                                        foreach ($ingredientes as $ingrediente) {
                                                                            if ($quantidade_elemento < sizeof($ingredientes) - 1) {
                                                                                echo $ingrediente['ingrediente'] . ", ";
                                                                            } else {
                                                                                echo $ingrediente['ingrediente'] . ". ";
                                                                            }
                                                                            $quantidade_elemento++;
                                                                        }
                                                                    }
                                                                    ?>

                                                                </p>
                                                                <p class="price"><span>R$ <?php echo $pizza['preco']; ?></span></p>
                                                                <p><a href="detalhes.php?id=<?php echo $pizza['codigo']; ?>" class="btn btn-white btn-outline-white">Adicione ao carrinho</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>



                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-2-tab">
                                        <div class="col-md-12 ftco-animate">
                                            <form action="#" class="contact-form">

                                                <div class="form-group">
                                                    <input id="pesquisa-bebida" type="text" class="form-control" placeholder="Pesquise bebida por nome.">
                                                </div>

                                            </form>
                                        </div>
                                        <div class="row resultado-bebida">

                                            <?php
                                            $bebidas = listar_bebidas();

                                            if (isset($bebidas)) {
                                                foreach ($bebidas as $bebida) {
                                                    ?>

                                                    <div class="col-md-4 text-center">
                                                        <div class="menu-wrap">
                                                            <a href="#" class="menu-img img mb-4" style="background-image: url(images/drink-1.jpg);"></a>
                                                            <div class="text">
                                                                <h3><a href="#"><?php echo $bebida['nome']; ?></a></h3>
                                                                <p>Quantidade: <?php echo $bebida['quantidade']; ?> unid.</p>
                                                                <p class="price"><span>R$ <?php echo $bebida['preco']; ?></span></p>
                                                                <p><a href="php/controle.php?op=2&id=<?php echo $bebida['codigo']; ?>" class="btn btn-white btn-outline-white">Adicionar ao carrinho</a></p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="ftco-footer ftco-section img">
            <div class="overlay"></div>
            <div class="container">
                <div class="row mb-5">
                    <div class="col-lg-3 col-md-6 mb-5 mb-md-5">
                        <div class="ftco-footer-widget mb-4">
                            <h2 class="ftco-heading-2">Sobre Nós</h2>
                            <p>Somos o maior delivery de pizza de toda a nossa região.</p>
                            <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-5 mb-md-5">
                        <div class="ftco-footer-widget mb-4">
                            <h2 class="ftco-heading-2">Mapa</h2>
                            <iframe class="col-12" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29639.87006608018!2d-52.127334399999995!3d-21.780889600000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x949198d8b971a46f%3A0xa778e28b9c04cf8b!2sInstituto%20Federal%20de%20Educa%C3%A7%C3%A3o%2C%20Ci%C3%AAncia%20e%20Tecnologia%20de%20S%C3%A3o%20Paulo%2C%20C%C3%A2mpus%20Presidente%20Epit%C3%A1cio!5e0!3m2!1spt-BR!2sbr!4v1668992492852!5m2!1spt-BR!2sbr" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 mb-5 mb-md-5">
                        <div class="ftco-footer-widget mb-4 ml-md-4">
                            <h2 class="ftco-heading-2">Serviços</h2>
                            <ul class="list-unstyled">
                                <li><a href="#" class="py-2 d-block">Delivery</a></li>
                                <li><a href="#" class="py-2 d-block">Qualidade de Alimentos</a></li>
                                <li><a href="#" class="py-2 d-block">Pratos Originais</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-5 mb-md-5">
                        <div class="ftco-footer-widget mb-4">
                            <h2 class="ftco-heading-2">Tem dúvidas?</h2>
                            <div class="block-23 mb-3">
                                <ul>
                                    <li><span class="icon icon-map-marker"></span><span class="text">R. José Ramos Júnior, 27-50 - Jardim Tropical, Pres. Epitácio - SP, 19470-000</span></li>
                                    <li><a href="#"><span class="icon icon-phone"></span><span class="text">01832819599</span></a></li>
                                    <li><a href="#"><span class="icon icon-envelope"></span><span class="text">pizzas@truffle.com</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">

                        <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos direitos reservados | Pizza's Truffle
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                </div>
            </div>
        </footer>



        <!-- loader -->
        <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


        <script src="js/jquery.min.js"></script>
        <script src="js/jquery-migrate-3.0.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.easing.1.3.js"></script>
        <script src="js/jquery.waypoints.min.js"></script>
        <script src="js/jquery.stellar.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/jquery.magnific-popup.min.js"></script>
        <script src="js/aos.js"></script>
        <script src="js/jquery.animateNumber.min.js"></script>
        <script src="js/bootstrap-datepicker.js"></script>
        <script src="js/jquery.timepicker.min.js"></script>
        <script src="js/scrollax.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
        <script src="js/google-map.js"></script>
        <script src="js/main.js"></script>
        <script src="js/pesquisa-pizza.js" type="text/javascript"></script>
    </body>
</html>