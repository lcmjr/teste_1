<?php


class Crud{
    protected $tabela;
    protected $classe;
    protected $campos_banco_dados;
    protected $campos_mostra_tabela;
    protected $campos_mostra_tabela_cabecalho;
    protected $campo_monta_link;

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
            $sql .= "WHERE $where";
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
}
?>