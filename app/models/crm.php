<?php

namespace app\Models;
use app\core\Model;

class crm extends Model {

	public function __construct(){
		parent:: __construct();
	}

    // Pega todos os andamentos que passaram pelo CQ
	public function lista_andamentos(){
        
        $sql = "select aa.seq_pla_analista, aa.seq_pla_chamado, aa.sequencia from crm_andamento aa where aa.seq_pla_analista ='  26456401' and aa.data > to_date('01/01/2019', 'DD/MM/YYYY')";

           // Executa o SQL e adiciona as condicoes.
        $sql = $this->db->query($sql);
        if (!$sql) {
            die ("Erro na execução da query:". print_r($this->db->errorInfo(), true));
        } else {
            // Transforma o resultado em um objeto.
		return $sql->fetchAll(\PDO::FETCH_OBJ);	

        }
			

    }

    public function proximo_analista ($seq_pla_chamado, $sequencia) {
        $sql = "select us.nome_usuario from crm_andamento aa, crm_analistas ana, usuarios us where aa.seq_pla_chamado =:seq_pla_chamado and aa.sequencia =:sequencia and aa.seq_pla_analista = ana.seq_pla_analista and ana.seq_pla_usuario = us.seq_pla_usuario";
        // preparar o sql
		$sql = $this->db->prepare($sql);
        // // passa parametros
        $sql->bindValue(":seq_pla_chamado", $seq_pla_chamado);
        $sql->bindValue(":sequencia", $sequencia);
        $sql = $this->db->query($sql);
        if (!$sql) {
            die ("Erro na execução da query:". print_r($this->db->errorInfo(), true));
        } else {
            // Transforma o resultado em um objeto.
		return $sql->fetchAll(\PDO::FETCH_OBJ);	

        }
    }
}


?>