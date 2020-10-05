<?php
//Add a classe responsavel por fazer a conexao com banco de dados
include_once $_SESSION["root"].'php/DAO/DatabaseConnection.php';
include_once $_SESSION["root"].'php/Model/ModelFuncionario.php';
include_once $_SESSION["root"].'php/Model/FuncionarioDTO.php';
class FuncionarioDAO {
	/*Como o PHP tem inferência de tipo, esse método, assim como outros, poderia ser mais "simples", porém estou fazendo de uma maneira que acho mais didático*/
	
	function getAllFuncionariosDTO(){
		$instance = DatabaseConnection::getInstance();
		$conn = $instance->getConnection();
		$sql = "SELECT f.idFuncionario, f.nomeFunc, f.salario, f.login, p.tipo, d.nome, f.ativo
					FROM funcionario AS f 
						INNER JOIN permissao AS p 
							ON f.idPermissao = p.id 
								INNER JOIN departamento AS d 
									ON f.idDepartamento = d.id";


		$statement = $conn->prepare($sql);
		$statement->execute();

		$linhas = $statement->fetchAll();

		if(count($linhas) == 0){
			return null;
		}

		foreach ($linhas as $value){
			$funcionarioDTO = new FuncionarioDTO();
			$funcionarioDTO->setFuncionarioFromDataBaseDAO($value);
			if($funcionarioDTO->getAtivo() == 1){
				$funcionariosDTO[] = $funcionarioDTO;
			}
			
		}
		return $funcionariosDTO;
	}

	
	
	//Retorna 1 se conseguiu inserir;
	function setFuncionario($func){			
		//echo $func->getIdPermissao();
		try {
			//monto a query
            $sql = "INSERT INTO funcionario (		
                idFuncionario,
                nomeFunc,
                salario,
                login,
                senha,
                idPermissao,
                idDepartamento) 
                VALUES (
                :idFuncionario,
                :nomeFunc,
                :salario,
                :login,
                :senha,
                :idPermissao,
                :idDepartamento)"
        	;

            //pego uma ref da conexão
			$instance = DatabaseConnection::getInstance();
			$conn = $instance->getConnection();
			//Utilizando Prepared Statements
			$statement = $conn->prepare($sql);

            $statement->bindValue(":idFuncionario", $func->getIdFuncionario());
            $statement->bindValue(":nomeFunc", $func->getNomeFunc());
            $statement->bindValue(":salario", $func->getSalario());
            $statement->bindValue(":login", $func->getLogin());
            $statement->bindValue(":senha", $func->getSenha());
            $statement->bindValue(":idPermissao", $func->getIdPermissao());
            $statement->bindValue(":idDepartamento", $func->getIdDepartamento());
            return $statement->execute();

        } catch (PDOException $e) {
            echo "Erro ao inserir na base de dados.".$e->getMessage();
        }		
	}

	function excluiFuncionario($id){	 //excluir somente da view, manter no banco de dados		
		
		try {
			//monto a query
            $sql = "UPDATE funcionario 
						SET ativo = 0
						WHERE idFuncionario	= $id;
					";	

            //pego uma ref da conexão
			$instance = DatabaseConnection::getInstance();
			$conn = $instance->getConnection();
			//Utilizando Prepared Statements
			$statement = $conn->prepare($sql);
           // $statement->bindValue(":idFuncionario", $func->getIdFuncionario());
            return $statement->execute();

        } catch (PDOException $e) {
            echo "Erro ao inserir na base de dados.".$e->getMessage();
        }		
	}


	function buscaFuncionarioById($id){
		try {
			$sql = "SELECT idFuncionario, nomeFunc, salario, login,idPermissao,idDepartamento
			FROM  funcionario
			WHERE idFuncionario	= $id;
		";	
			
            //pego uma ref da conexão
			$instance = DatabaseConnection::getInstance();
			$conn = $instance->getConnection();
			//Utilizando Prepared Statements
			$statement = $conn->prepare($sql);
           // $statement->bindValue(":idFuncionario", $func->getIdFuncionario());
			$statement->execute();
			$linha = $statement->fetchAll();
			$funcionario = new ModelFuncionario();
			$funcionario->setIdFuncionario($linha[0][0]);
			$funcionario->setNomeFunc($linha[0][1]);
			$funcionario->setSalario($linha[0][2]);
			$funcionario->setLogin($linha[0][3]);
			$funcionario->setIdPermissao($linha[0][4]);
			$funcionario->setIdDepartamento($linha[0][5]);
		
			//echo($funcionario);
			return $funcionario;


        } catch (PDOException $e) {
            echo "Erro ao inserir na base de dados.".$e->getMessage();
        }

	}




	function ordenaFuncionario($by){
		$instance = DatabaseConnection::getInstance();
		$conn = $instance->getConnection();
		$sql = "SELECT f.idFuncionario, f.nomeFunc, f.salario, f.login, p.tipo, d.nome, f.ativo
					FROM funcionario AS f 
						INNER JOIN permissao AS p 
							ON f.idPermissao = p.id 
								INNER JOIN departamento AS d 
									ON f.idDepartamento = d.id
					ORDER BY $by ASC";

		$statement = $conn->prepare($sql);
		$statement->execute();

		$linhas = $statement->fetchAll();

		if(count($linhas) == 0){
			return null;
		}

		foreach ($linhas as $value){
			$funcionarioDTO = new FuncionarioDTO();
			$funcionarioDTO->setFuncionarioFromDataBaseDAO($value);
			if($funcionarioDTO->getAtivo() == 1){
				$funcionariosDTO[] = $funcionarioDTO;
			}
			
		}
		return $funcionariosDTO;
	}



	//FAZER UPDATE PEGANDO OS DADOS DO FORM DE EDICAO
	function alteraFuncionario($func){
		
		if($func->getSenha() == ""){
			try{
				$sql = "UPDATE funcionario 
						   SET login = :login,
						   	   nomeFunc = :nomeFunc,
							   salario = :salario,
							   idPermissao = :idPermissao,
							   idDepartamento = :idDepartamento
							WHERE idFuncionario = :idFuncionario
						";

				$instance = DatabaseConnection::getInstance();
				$conn = $instance->getConnection();
				$statement = $conn->prepare($sql);

				$statement->bindValue(":idFuncionario", $func->getIdFuncionario());
				$statement->bindValue(":nomeFunc", $func->getNomeFunc());
				$statement->bindValue(":salario", $func->getSalario());
				$statement->bindValue(":login", $func->getLogin());
				$statement->bindValue(":idPermissao", $func->getIdPermissao());
				$statement->bindValue(":idDepartamento", $func->getIdDepartamento());
				return $statement->execute();
						   

			}catch (PDOException $e) {
				echo "Erro ao inserir na base de dados.".$e->getMessage();
			}
		}else{
			try {
				//monto a query
				$sql = "UPDATE  funcionario 
						SET
							nomeFunc = :nomeFunc,
							salario = :salario,
							login = :login,
							senha = :senha,
							idPermissao = :idPermissao,
							idDepartamento = :idDepartamento
							WHERE idFuncionario = :idFuncionario"
				;
	
				//pego uma ref da conexão
				$instance = DatabaseConnection::getInstance();
				$conn = $instance->getConnection();
				//Utilizando Prepared Statements
				$statement = $conn->prepare($sql);
	
				$statement->bindValue(":idFuncionario", $func->getIdFuncionario());
				$statement->bindValue(":nomeFunc", $func->getNomeFunc());
				$statement->bindValue(":salario", $func->getSalario());
				$statement->bindValue(":login", $func->getLogin());
				$statement->bindValue(":senha", $func->getSenha());
				$statement->bindValue(":idPermissao", $func->getIdPermissao());
				$statement->bindValue(":idDepartamento", $func->getIdDepartamento());
				return $statement->execute();
	
			} catch (PDOException $e) {
				echo "Erro ao inserir na base de dados.".$e->getMessage();
			}
		}
		try {
			//monto a query
			//$senha_sal = $func.setSenha $func->getSenha()."pw2-2020";


			$sql = "UPDATE  funcionario SET
						nomeFunc = :nomeFunc,
						salario = :salario,
						login = :login,
						senha = :senha,
						idPermissao = :idPermissao,
						idDepartamento = :idDepartamento
						WHERE idFuncionario = :idFuncionario"
        	;

            //pego uma ref da conexão
			$instance = DatabaseConnection::getInstance();
			$conn = $instance->getConnection();
			//Utilizando Prepared Statements
			$statement = $conn->prepare($sql);

            $statement->bindValue(":idFuncionario", $func->getIdFuncionario());
            $statement->bindValue(":nomeFunc", $func->getNomeFunc());
            $statement->bindValue(":salario", $func->getSalario());
            $statement->bindValue(":login", $func->getLogin());
            $statement->bindValue(":senha", $func->getSenha());
            $statement->bindValue(":idPermissao", $func->getIdPermissao());
            $statement->bindValue(":idDepartamento", $func->getIdDepartamento());
            return $statement->execute();

        } catch (PDOException $e) {
            echo "Erro ao inserir na base de dados.".$e->getMessage();
		}
		
	}


}