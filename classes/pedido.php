<?php

class Pedido extends Crud{

    public function Pedido(){
        $this->tabela = "pedidos";
        $this->classe = "pedido";
        $this->campos_banco_dados = array("id_produto","id_cliente");
        $this->campos_mostra_tabela = array("nome_prod","nome_c");
        $this->campos_mostra_tabela_cabecalho = array("Produto","Cliente");
        $this->campo_monta_link = array("id_produto","id_cliente");
        $this->campo_formularios = array(["type"=>"hidden","label"=>"","nome"=>"id_produto"],["type"=>"select","label"=>"Produto","nome"=>"produto_sel",'option'=> array()],["type"=>"hidden","label"=>"","nome"=>"id_cliente"],["type"=>"select","label"=>"Cliente","nome"=>"cliente_sel",'option'=> array()]);
    }

    public function mostrar(){
        $this->lista("id_produto,id_cliente,prod.nome AS nome_prod,c.nome AS nome_c"," AS ped INNER JOIN cliente AS c ON ped.id_cliente = c.id INNER JOIN produto AS prod ON ped.id_produto = prod.id");
    }

    public function formulario_adicionar(){
        $this->seleciona_options_select(true);
        $this->seleciona_options_select(false);
        $this->criar_formulario();
    }

    public function seleciona_options_select($seleciona_cliente){
        $select_options = ($seleciona_cliente)?new Cliente():new Produto();
        $option = array();
        $resultado = $select_options->read('id,nome');
        while($dados = mysql_fetch_assoc($resultado)){
            $option[$dados['id']]['nome'] = $dados['nome'];
            $option[$dados['id']]['id'] = $dados['id'];
        }
        $id_array = ($seleciona_cliente)?3:1;
        $this->campo_formularios[$id_array]['option'] = $option;
    }

    public function adicionar(){
        $campos = "id_produto,id_cliente";
        $valores = "'".mysql_real_escape_string($_POST['produto_sel'])."','".mysql_real_escape_string($_POST['cliente_sel'])."'";
        $this->create($campos,$valores);
    }
}