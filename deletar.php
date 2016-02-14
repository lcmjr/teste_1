<?php
require_once "includes/require.php";
$classe->deletar();
header("location: mostrar.php?class=".$_GET['class']);