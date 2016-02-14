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
        $this->criar_formulario("adicionar");
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

    public function formulario_editar(){
        $id = " WHERE id=".mysql_real_escape_string($_GET['id']);
        $resultado = mysql_fetch_assoc($this->read("*",$id));
        foreach($this->campo_formularios as $key=>$campo)
            $this->campo_formularios[$key]['valor'] = $resultado[$campo['nome']] ;
        $this->criar_formulario("editar");
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