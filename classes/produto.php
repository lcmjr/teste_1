<?php

class Produto extends Crud{

    public function produto(){
        $this->tabela = "produto";
        $this->campos_banco_dados = array("id","nome","descricao","preco");
        $this->campos_mostra_tabela = array("nome","descricao","preco");
        $this->campos_mostra_tabela_cabecalho = array("nome","descricao","preco");
        $this->campo_monta_link = array("id");
    }

    public function mostrar(){
        $this->lista("id,nome,descricao,preco");
    }
}