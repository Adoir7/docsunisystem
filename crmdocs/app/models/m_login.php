<?php

namespace app\Models;

use app\core\Model;

class M_login extends Model {

    public function __construct() {
        parent:: __construct();
    }

    public function estaLogado() {
        if (isset($_SESSION["usuarioLogado"]->SEQ_PLA_SOLICITANTE)) {
            return true;
        } else {
            return false;
        }
    }


    public function getusuarios() {
      $sql = "SELECT DISTINCT * FROM USUARIOS U WHERE U.SEQ_PLA_USUARIO IN (SELECT C.SEQ_PLA_USUARIO FROM CRM_CHAMADOS C) ORDER BY U.APELIDO ";
           // Executa o SQL.
        $sql = $this->db->query($sql);
            // Transforma o resultado em um objeto.
        return $sql->fetchAll(\PDO::FETCH_OBJ); 
    }

    public function logar($usuario, $senha) {

        $sql = "SELECT * FROM CRM_SOLICITANTES WHERE LOGIN_WEB =UPPER(:usuario) AND SENHA_WEB =UPPER(:senha)";
        $qry = $this->db->prepare($sql);
        $qry->bindValue(":usuario", $usuario);
        $qry->bindValue(":senha", $senha);
        $qry->execute();

        $_SESSION["usuarioLogado"] = $qry->fetch(\PDO::FETCH_OBJ);

        if ($_SESSION["usuarioLogado"] != "") {
            //var_dump($_SESSION["usuarioLogado"]);  use para obter os campos ta tabela usuarios
            return true;
        } else {
            unset($_SESSION["usuarioLogado"]);
            return false;
        }
    }

}

?>