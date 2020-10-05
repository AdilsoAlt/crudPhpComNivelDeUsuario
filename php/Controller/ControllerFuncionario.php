<?php

include_once $_SESSION["root"].'php/DAO/FuncionarioDAO.php';
include_once $_SESSION["root"].'php/Model/ModelFuncionario.php';
include_once $_SESSION["root"].'php/Model/FuncionarioDTO.php';

class ControllerFuncionario {
	function getAllFuncionarios(){
		$funcDAO = new FuncionarioDAO();
		$funcionariosDTO = $funcDAO->getAllFuncionariosDTO();
		//print_r($funcionariosDTO);
		include_once $_SESSION["root"].'php/View/ViewExibeFuncionarios.php';
	}

	function setFuncionario(){
		$funcDAO = new FuncionarioDAO();
		$funcionario = new ModelFuncionario();
		$funcionario->setFuncionarioFromPOST();
		$resultadoInsercao = $funcDAO->setFuncionario($funcionario);
			
		if($resultadoInsercao){
			$_SESSION["flash"]["msg"]="Funcionário Cadastrado com Sucesso";
			$_SESSION["flash"]["sucesso"]=true;			
		}
		else{
			$_SESSION["flash"]["msg"]="O Login já existe no banco";
			$_SESSION["flash"]["sucesso"]=false;
			//Var temp de feedback	
			$_SESSION["flash"]["nome"]=$funcionario->getNomeFunc();
			$_SESSION["flash"]["login"]=$funcionario->getLogin();
			$_SESSION["flash"]["salario"]=$funcionario->getSalario();
		}
		include_once $_SESSION["root"].'php/View/ViewCadastraFuncionario.php';
	}

	function excluiFuncionario($id){
		$funcDAO = new FuncionarioDAO();
		$funcDAO->excluiFuncionario($id);

		//include_once $_SESSION["root"].'php/View/ViewCadastraFuncionario.php';
	}
	

	function editaFuncionario($id){
		$funcDAO = new FuncionarioDAO();
		$func = $funcDAO->buscaFuncionarioById($id);

		
		$cDepartamento = new ControllerDepartamento();
		$departamentos = $cDepartamento->buscarDepartamentos();
	
		$cDepartamento = new ControllerDepartamento();
		$permissoes = $cDepartamento->buscarPermissoes();
		//print_r($permissoes);
		include_once $_SESSION["root"].'/php/View/ViewEditaFuncionario.php';

	}

	function ordernaFuncionario($by){
		$funcDAO = new FuncionarioDAO();
		$funcionariosDTO=$funcDAO->ordenaFuncionario($by);
		include_once $_SESSION["root"].'php/View/ViewExibeFuncionarios.php';	
	}

	function alteraFuncionario(){
		$funcionario = new ModelFuncionario();
		$funcDAO = new FuncionarioDAO();
		$funcionario->setFuncionarioEditadoFromPOST();
		//echo "teste";
		//print_r($funcionario);
		//$func = $funcDAO->buscaFuncionarioById($funcionario);
		$funcDAO->alteraFuncionario($funcionario);



		if($funcDAO){
			$_SESSION["flash"]["msg"]="Funcionário Alterado com Sucesso";
			$_SESSION["flash"]["sucesso"]=true;			
		}
		else{
			$_SESSION["flash"]["msg"]="Erro ao alterar cadastros";
			$_SESSION["flash"]["sucesso"]=false;

		}
	


	}




}