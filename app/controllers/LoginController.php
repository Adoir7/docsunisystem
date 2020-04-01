<?php

namespace app\controllers;

use app\core\Controller;
use app\models\M_login;

class LoginController extends Controller {

    public function index() {

        $dados["view"] = "home";
        $dados["erro"] = "";

        $usuario = isset($_POST["usuario"]) ? strip_tags(filter_input(INPUT_POST, "usuario")) : null;
        $senha = isset($_POST["senha"]) ? strip_tags(filter_input(INPUT_POST, "senha")) : null;

        if (($usuario) && ($senha)) {

            $login = new m_login();

            if ($login->logar($usuario, $senha)) {
                header("location: " . URL_BASE);
                exit;
            } else {

                $dados["erro"] = "Usuario ou Senha Invalida";
            }
        }

        $this->load("login/index", $dados);
    }

    public function logout() {
        unset($_SESSION["usuarioLogado"]);
        header("location: " . URL_BASE);
    }

}
