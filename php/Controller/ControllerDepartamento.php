<?php

include_once $_SESSION["root"].'php/DAO/DepartamentoDAO.php';
include_once $_SESSION["root"].'php/Model/ModelDepartamento.php';
include_once $_SESSION["root"].'php/Model/ModelPermissao.php';

class ControllerDepartamento {

	function getAllDepartamento(){
		$departDAO = new DepartamentoDAO();
		$departamentos=$departDAO->getAllDepart();
		include_once $_SESSION["root"].'php/View/ViewExibeDepart.php';
	}


	function setDepartamento(){
		$departDAO = new DepartamentoDAO();
		$departamento = new ModelDepartamento();
		$departamento->setDepartamentoFromPOST();
		$resultadoInsercao = $departDAO->setDepartamento($departamento);
			
		if($resultadoInsercao){
			$_SESSION["flash"]["msg"]="Departamento Cadastrado com Sucesso";
			$_SESSION["flash"]["sucesso"]=true;			
		}
		else{
			$_SESSION["flash"]["msg"]="O Departamento já existe no banco";
			$_SESSION["flash"]["sucesso"]=false;
			//Var temp de feedback	
			$_SESSION["flash"]["id"]=$departamento->getId();
			$_SESSION["flash"]["nome"]=$departamento->getNome();
		}
		include_once $_SESSION["root"].'php/View/ViewCadastraDepart.php';
	}

	function buscarDepartamentos(){
		$departamentoDAO = new DepartamentoDAO();
		$departamentos=$departamentoDAO->getAllDepart();
		return($departamentos);
		

	}

	function buscarPermissoes(){
		$departamentoDAO = new DepartamentoDAO();
		$permissoes=$departamentoDAO->getAllPermissoes();
		return($permissoes);
		include_once $_SESSION["root"].'php/View/ViewExibeFuncionarios.php';
	}


	
}