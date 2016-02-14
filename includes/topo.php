<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <ul class="nav navbar-nav">
                    <li class="<?= $menu[0]?>"><a href="mostrar.php?class=pedido">Pedidos</a></li>
                    <li class="<?= $menu[1]?>"><a href="mostrar.php?class=produto">Produtos</a></li>
                    <li class="<?= $menu[2]?>"><a href="mostrar.php?class=cliente">Clientes</a></li>
                </ul>
            </div>
        </nav>
    </header>