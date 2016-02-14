<?php
class Cliente extends Crud{

    public function Cliente(){
        $this->tabela = "cliente";
        $this->campos_banco_dados = array("id","nome","email","telefone");
        $this->campos_mostra_tabela = array("nome","email","telefone");
        $this->campos_mostra_tabela_cabecalho = array("nome","email","telefone");
        $this->campo_monta_link = array("id");
    }

    public function mostrar(){
        $this->lista("id,nome,descricao,preco");
    }
}