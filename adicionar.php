<?php
require_once "includes/require.php";

include "includes/topo.php";
if(isset($_GET['adicionar'])){
    $classe->adicionar();
    header("location: mostrar.php?class=".$_GET['class']);
}else {
    $classe->formulario_adicionar();
}
include "includes/rodape.php";?>