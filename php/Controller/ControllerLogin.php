<?php

include_once $_SESSION["root"].'php/DAO/LoginDAO.php';
include_once $_SESSION["root"].'php/Model/ModelFuncionario.php';

class ControllerLogin {
	function verificaLogin(){
		//verifico se a requisição que chegou nessa pagina é POST
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			//recebo as variaveis por POST
			$login=$_POST["login"];
			$senha=$_POST["senha"]."pw2-2020";	//SALGANDO SENHA
			$permissao=$_POST["idPermissao"];
			
			$loginDAO = new LoginDAO();
			$funcionario = new ModelFuncionario();	
			//Retorna um funcionario ou retorna NULL;
			$funcionario=$loginDAO->verificaLogin($login,$senha,$permissao);
			//echo "<pre>";
			//print_r($funcionario);
			//echo "</pre>";
			

			//$_SESSION["flash"]["qualquerCoisa"] são variáveis de login que vivem apenas uma requisição, elas são usadas na view e depois destruidas.
			if ($funcionario!=NULL && md5($senha)==$funcionario->getSenha()) {
				//if ($funcionario!=NULL && md5($senha."23")==$funcionario->getSenha()) { // SALGANDO SENHA
				$_SESSION["logado"]=true;
				$_SESSION["nomeLogado"]=$funcionario->getNomeFunc();
				$_SESSION["permissao"]=$funcionario->getIdPermissao();
				//Coloquei na sessão que o usuário está logado e o seu nome.
				//Mando a página para a rota "exibeFuncionario"
				header("Location:exibeFuncionarios");
			}
			else{
				$_SESSION["flash"]["login"]=$login;
				$_SESSION["flash"]["msg"]="Usuário ou senha não conferem";
				$_SESSION["flash"]["sucesso"]=false;
				//Coloquei na sessão "temporária" os avisos e feedbacks necessários, chamo a rota Login	
				header("Location:login");	
			}
		}
		else{
			header("Location:login");	
		}
	}
}