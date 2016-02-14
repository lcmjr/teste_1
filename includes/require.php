<?php

$usuario_db = "root";
$senha_db = "";
$banco_nome_db = "teste_1";
$servidor_db = "localhost";

$con = mysql_connect($servidor_db,$usuario_db,$senha_db);
$banco = mysql_select_db($banco_nome_db);

require_once "classes/crud.php";

switch($_GET['class']){
    case 'pedido':
        require_once "classes/pedido.php";
        $classe= new Pedido();
        $menu[0] = "active";
        break;
    case 'produto':
        require_once "classes/produto.php";
        $classe= new Produto();
        $menu[1] = "active";
        break;
    case 'cliente':
        require_once "classes/cliente.php";
        $classe= new Cliente();
        $menu[2] = "active";
        break;
}
