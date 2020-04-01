<?php

namespace app\core;

abstract class Model {

	protected $db;

	public function __construct(){
		try{
			$this->db = new \PDO(DRIVER.":dbname=" . BANCO . ";charset=AL32UTF8;host=" . SERVIDOR, USUARIO, SENHA);
		} catch (\PDOException $exception){
			echo 'Não foi possivel Conectar ao Banco de Dados <br> Erro:'. $exception->getCode() . $exception->getMessage(); 
			exit();
		}
	}

}