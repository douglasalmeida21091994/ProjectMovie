<?php
require_once "globals.php";
require_once "db.php";

$flassMensage = [];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieStar</title>
    <!-- ADICIONANDO FAVICON -->
    <link rel="shortcut icon" href="<?= $BASE_URL ?>img/users/favicon.ico" type="image/x-icon">
    <!-- ADICIONANDO O  BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.css"
        integrity="sha512-VcyUgkobcyhqQl74HS1TcTMnLEfdfX6BbjhH8ZBjFU9YTwHwtoRtWSGzhpDVEJqtMlvLM2z3JIixUOu63PNCYQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- ADICIONANDO FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- ADICIONANDO CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- LINK PARA LOCALIZAR: https://cdnjs.com/ -->

</head>

<body>

    <header>
        <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <!-- Logotipo e título -->
                <a href="<?= $BASE_URL ?>" class="navbar-brand">
                    <img src="<?= $BASE_URL ?>img/logo.png" alt="MovieStar" id="logo" class="d-inline-block align-top">
                    <span id="moviestar-title">MovieStar</span>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
                    aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Centralizando a busca -->
                <div class="collapse navbar-collapse justify-content-center" id="navbar">
                    <form action="" method="GET" id="search-form" class="form-inline my-2 my-lg-0">
                        <div class="input-group">
                            <input type="text" name="q" id="search" class="form-control" placeholder="Buscar Filmes"
                                aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Link de Entrar / Cadastrar à direita -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="<?= $BASE_URL ?>auth.php" class="nav-link">Entrar / Cadastrar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <?php if (!empty($flassMensage["msg"])): ?>

        <div class="msg-container">
            <p class="msg <?= $flassMensage["type"] ?>"><?= $flassMensage["msg"] ?></p>
        </div>

    <?php endif ?>