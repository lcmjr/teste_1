<?php
require_once "includes/require.php";

include "includes/topo.php";
if(isset($_GET['editar'])){
    $classe->editar();
    header("location: mostrar.php?class=".$_GET['class']);
}else {
    $classe->formulario_editar();
}
include "includes/rodape.php";?>