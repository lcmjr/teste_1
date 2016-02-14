<?php

class Produto extends Crud{

    public function produto(){
        $this->tabela = "produto";
        $this->classe = "produto";
        $this->campos_banco_dados = array("id","nome","descricao","preco");
        $this->campos_mostra_tabela = array("nome","descricao","preco");
        $this->campos_mostra_tabela_cabecalho = array("nome","descricao","preco");
        $this->campo_monta_link = array("id");
        $this->campo_formularios = array(["type"=>"hidden","label"=>"","nome"=>"id"],
            ["type"=>"text","label"=>"Nome","nome"=>"nome"],
            ["type"=>"textarea","label"=>"Descrição","nome"=>"descricao"],
            ["type"=>"text","label"=>"Preço","nome"=>"preco"]);
    }

    public function mostrar(){
        $this->lista("id,nome,descricao,preco");
    }

    public function formulario_adicionar(){
        $this->criar_formulario("adicionar","Adicionar");
    }

    public function adicionar(){
        $campos = "nome,descricao,preco";
        $valores = "'".mysql_real_escape_string($_POST['nome'])."','".mysql_real_escape_string($_POST['descricao'])."','".mysql_real_escape_string($_POST['preco'])."'";
        $a = $this->create($campos,$valores);
    }

    public function deletar(){
        $id = "id='".mysql_real_escape_string($_GET['id'])."'";
        $this->delete($id);
    }

    public function formulario_editar(){
        $id = " WHERE id=".mysql_real_escape_string($_GET['id']);
        $resultado = mysql_fetch_assoc($this->read("*",$id));
        foreach($this->campo_formularios as $key=>$campo)
            $this->campo_formularios[$key]['valor'] = $resultado[$campo['nome']] ;
        $this->criar_formulario("editar","Editar");
    }

    public function editar(){
        $campos = "";
        foreach($this->campo_formularios as $key=>$campo) {
            if($campo['nome']!='id') {
                if($campos != "")
                   $campos .= ",";
                $campos .= " ".$campo['nome'] . "='" . mysql_real_escape_string($_POST[$campo['nome']]) . "'";
            }
        }
        $where = "id = '".mysql_real_escape_string($_POST['id'])."'";
        $this->update($campos,$where);
    }
}