<?php
class Cliente extends Crud{

    public function Cliente(){
        $this->tabela = "cliente";
        $this->classe = "cliente";
        $this->campos_banco_dados = array("id","nome","email","telefone");
        $this->campos_mostra_tabela = array("nome","email","telefone");
        $this->campos_mostra_tabela_cabecalho = array("nome","email","telefone");
        $this->campo_monta_link = array("id");
        $this->campo_formularios = array(["type"=>"hidden","label"=>"","nome"=>"id"],["type"=>"text","label"=>"Nome","nome"=>"nome"],["type"=>"text","label"=>"E-mail","nome"=>"email"],["type"=>"text","label"=>"Telefone","nome"=>"telefone"]);
    }

    public function mostrar(){
        $this->lista("id,nome,email,telefone");
    }

    public function formulario_adicionar(){
        $this->criar_formulario();
    }

    public function adicionar(){
        $campos = "nome,email,telefone";
        $valores = "'".mysql_real_escape_string($_POST['nome'])."','".mysql_real_escape_string($_POST['email'])."','".mysql_real_escape_string($_POST['telefone'])."'";
        $this->create($campos,$valores);
    }

    public function deletar(){
        $id = "id='".mysql_real_escape_string($_GET['id'])."'";
        $this->delete($id);
    }
}