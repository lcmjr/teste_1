<?php


class Crud{
    protected $tabela;
    protected $classe;
    protected $campos_banco_dados;
    protected $campos_mostra_tabela;
    protected $campos_mostra_tabela_cabecalho;
    protected $campo_monta_link;
    protected $campo_formularios;

    private function cabecalho_lista(){
        echo "<tr>";
        foreach($this->campos_mostra_tabela_cabecalho as $campo)
            echo "<th>$campo</th>";
        echo "<th></th><th></th></tr>";
    }

    private function construir_linha($dados){
        $link = "";
        foreach($this->campo_monta_link as $campo_link)
            $link .= "&$campo_link=$dados[$campo_link]";
        echo "<tr>";
        foreach($this->campos_mostra_tabela as $campo)
            echo "<td>$dados[$campo]</td>";
        echo "<td><a class=\"btn btn-default\" href=\"editar.php?class=$this->classe$link\" role=\"button\">Editar</a></td>
              <td><a class=\"btn btn-danger\" href=\"excluir.php?class=$this->classe$link\" role=\"button\">Excluir</a></td>
        </tr>";
    }

    public function lista($select_campos,$innerjoin_pedido = null){
        echo "<table class='table'>";
        $this->cabecalho_lista();
        $resultado = $this->read($select_campos,$innerjoin_pedido);
        if($resultado!=null)
            while($dados = mysql_fetch_assoc($resultado))
                $this->construir_linha($dados);
        echo "</table><p class=\"text-center\"><a class=\"btn btn-primary\" href=\"adicionar.php?class=$this->classe\" role=\"button\">Adicionar</a></p>";
    }

    public function create($campos,$valores){
        $sql = "INSERT INTO $this->tabela ($campos) VALUES ($valores)";
        return $this->executa($sql);
    }

    public function read($campos,$where = null){
        $sql = "SELECT $campos FROM $this->tabela ";
        if($where!=null)
            $sql .= " $where";
        return $this->executa($sql);
    }

    public function update($campos_valores,$where){
        $sql = "UPDATE $this->tabela SET $campos_valores WHERE $where";
        return $this->executa($sql);
    }

    public function delete($where){
        $sql = "DELETE FROM $this->tabela WHERE $where";
        return $this->executa($sql);
    }

    public function executa($sql){
        $query = mysql_query($sql);
        return $query;
    }

    public function criar_formulario(){
        echo "<div class=\"row\"><div class=\"col-md-6 col-md-offset-3\"><form method='post' action=\"adicionar.php?class=$this->classe&adicionar=1\" >";
        foreach($this->campo_formularios as $campo_form)
            $this->cria_input($campo_form);
        echo "<p class=\"text-center\"><input type=\"submit\" class=\"btn btn-primary\" href=\"adicionar.php?class=$this->classe\" value=\"Adicionar\"></p></form></div></div>";
    }

    public function cria_input($campo_form){
        echo "<div class=\"form-group\">";
        if(isset($campo_form['label']))
            echo "<label>".$campo_form['label']."</label>";
        if($campo_form['type']== "text" || $campo_form['type']== "hidden"){
            if($campo_form['nome']=="preco")
                echo " <div class=\"input-group\"><div class=\"input-group-addon\">$</div>";
            echo "<input class=\"form-control\"  type=\"".$campo_form['type']."\" name=\"".$campo_form['nome']."\"";
            if(isset($campo_form['valor']))
                echo "value=\"".$campo_form['valor']."\"";
            echo "/>";
            if($campo_form['nome']=="preco")
                echo "</div>";
        }else if($campo_form['type']== "select") {
            $options = $campo_form['option'];
            echo "<select class=\"form-control\" name=\"".$campo_form['nome']."\">";
            foreach($options as $option) {
                echo "<option ";
                if (isset($campo_form['valor'])) {
                    if($option['id'] == $campo_form['valor'])
                        echo "selected";
                }
                echo "value=\"".$option['id']."\">".$option['nome']."</option>";
            }
            echo "</select>";
        }else{
            echo "<textarea class=\"form-control\"  name=\"".$campo_form['nome']."\">";
            if(isset($campo_form['valor']))
                echo $campo_form['valor'];
            echo "</textarea>";
        }
        echo "</div>";
    }
}
?>