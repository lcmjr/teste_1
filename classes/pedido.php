<?php

class Pedido extends Crud{

    public function Pedido(){
        $this->tabela = "pedido";
        $this->campos_banco_dados = array("id_produto","id_cliente");
        $this->campos_mostra_tabela = array("nome_p","nome_c","telefone");
        $this->campos_mostra_tabela_cabecalho = array("Produto","Cliente");
        $this->campo_monta_link = array("id_produto","id_cliente");
    }

    public function mostrar(){
        $this->lista("prod.nome AS nome_prod,c.nome AS nome_c"," AS ped INNER JOIN clientes AS c ON ped.id_cliente = c.id INNER JOIN produto AS prod ON ped.id_produto = prod.id");
    }
}