<?php
/*
Esse script funciona como um front controller, todas as requisições passam primeiro por aqui, também podemos enxergar como um gateway padrão. Isso só é possível graças ao htaccess que faz com que o todas as requisições feitas sejam redirecionadas para cá.
Da forma como esse arquivo de rotas funciona, nós não fazemos “links” para arquivos, nós associamos uma url a um controller.
****Descomentar os print_r abaixo para entender melhor****
*/

//Path é um array onde cada posição é um elemento da URL
$path = explode('/', $_SERVER['REQUEST_URI']);
//Action é a posição do array
$action = $path[sizeOf($path) - 1];
//Caso a ação tenha param GET esse param é ignorado, isso é particularmente útil para trabalhar com AJAX, já que o conteúdo do get será útil apenas para o controller e não para a rota
$action = explode('?', $action);
$action = $action[0];

//Descomentar esse bloco e acessar qualquer url do sistema.
/*echo "<pre>";
echo "A URL digitada<br>";
print_r($_SERVER['REQUEST_URI']);
echo "<br><br>A URL digitada explodida por / e tranformada em um array<br>";
print_r($path);
echo "<br><br>A ultima posição do array, que é a ação que o usuário/sistema quer realizar, é essa ação(string) que é mapeada(roteada) a um método de um controller<br>";
print_r($action);
echo "</pre>";*/
//Todo controller que tiver pelo menos uma rota associada a ele deve aparecer aqui.
include_once $_SESSION["root"].'php/Controller/ControllerLogin.php';
include_once $_SESSION["root"].'php/Controller/ControllerFuncionario.php';
include_once $_SESSION["root"].'php/Controller/ControllerDepartamento.php';

//debug($_SESSION);

//Sequencia de condicionais que verificam se a ação informada está roteada
if ($action == '' || $action == 'index' || $action == 'index.php' || $action == 'login') {
	require_once $_SESSION["root"].'php/View/ViewLogin.php';
}

else if ($action == 'logout') {
	unset($_SESSION["logado"]);
	unset($_SESSION["nomeLogado"]);
	require_once $_SESSION["root"].'php/View/ViewLogin.php';
}
else if ($action == 'postLogin') {
	$cLogin = new ControllerLogin();
	$cLogin->verificaLogin();
}
else if(isset($_SESSION["logado"]) && $_SESSION["logado"]==true && $_SESSION["permissao"] == "1"){
	if ($action == 'exibeFuncionarios') {
		$cFunc = new ControllerFuncionario();
		$cFunc->getAllFuncionarios();
		
	}
	else if ($action == 'cadastraFuncionario') {
		$cFunc = new ControllerFuncionario();
		
			$cDepartamento = new ControllerDepartamento();
			$departamentos = $cDepartamento->buscarDepartamentos();
		
			$cDepartamento = new ControllerDepartamento();
			$permissoes = $cDepartamento->buscarPermissoes();
			

			require_once $_SESSION["root"].'php/View/ViewCadastraFuncionario.php';
	}
	else if ($action == 'postCadastraFuncionario') {
		$cFunc = new ControllerFuncionario();

		//print_r($_POST);
		$cFunc->setFuncionario();
	}
	else if ($action == 'cadastraDepartamento') {
		$cFunc = new ControllerDepartamento();
		require_once $_SESSION["root"].'php/View/ViewCadastraDepart.php';
	}
	else if ($action == 'postCadastraDepartamento') {
		$cFunc = new ControllerDepartamento();
		$cFunc->setDepartamento();
	}
	else if ($action == 'exibeDepartamento') {
		$cFunc = new ControllerDepartamento();
		$cFunc->getAllDepartamento();

	}	
	else if ($action == 'excluiFuncionario') {
		$cFunc = new ControllerFuncionario();
		$id = $_POST["id"];
		$cFunc->excluiFuncionario($id);
	}
	else if ($action == 'editaFuncionario') {
		$cFunc = new ControllerFuncionario();
		$id = $_GET["id"];
		$cFunc->editaFuncionario($id);
	}

	else if ($action == 'orderFuncionario') {
		$cFunc = new ControllerFuncionario();
		$by = $_GET["orderBy"];
		$cFunc->ordernaFuncionario($by);
	}

	else if ($action == 'orderFuncionario') {
		$cFunc = new ControllerFuncionario();
		$by = $_GET["orderBy"];
		$cFunc->ordernaFuncionario($by);
	}

	else if($action == 'alteraFuncionario'){
		$cFunc = new ControllerFuncionario();

		//echo($_SESSION["idFuncionario"]);
		$cFunc->alteraFuncionario();

		header("Location:exibeFuncionarios");

	}
	
}


else if(isset($_SESSION["logado"]) && $_SESSION["logado"]==true && $_SESSION["permissao"] == "2"){
	if ($action == 'exibeFuncionarios') {
		$cFunc = new ControllerFuncionario();
		$cFunc->getAllFuncionarios();
	}
	else if ($action == 'cadastraFuncionario') {

		require_once $_SESSION["root"].'php/View/ViewAcessoRestrito.php';
	}
	
	else if ($action == 'cadastraDepartamento') {
		require_once $_SESSION["root"].'php/View/ViewAcessoRestrito.php';
	}
	
	else if ($action == 'exibeDepartamento') {
		$cFunc = new ControllerDepartamento();
		$cFunc->getAllDepartamento();

	}	
	else if ($action == 'excluiFuncionario') {
		require_once $_SESSION["root"].'php/View/ViewAcessoRestrito.php';
	}

	else if ($action == 'editaFuncionario') {
		require_once $_SESSION["root"].'php/View/ViewAcessoRestrito.php';
	}

	else if ($action == 'orderFuncionario') {
		$cFunc = new ControllerFuncionario();
		$by = $_GET["orderBy"];
		$cFunc->ordernaFuncionario($by);
	}

	else if ($action == 'orderFuncionario') {
		$cFunc = new ControllerFuncionario();
		$by = $_GET["orderBy"];
		$cFunc->ordernaFuncionario($by);
	}

	else if($action == 'alteraFuncionario'){
		$cFunc = new ControllerFuncionario();
		require_once $_SESSION["root"].'php/View/ViewAcessoRestrito.php';

	}

	
}



else {
	echo "Página não encontrada!!!";
	//isso trata todo erro 404, podemos criar uma view mais elegante para exibir o aviso ao usuário.
}

?>