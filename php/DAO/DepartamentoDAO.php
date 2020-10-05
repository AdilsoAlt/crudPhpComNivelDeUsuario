<?php 

    include_once $_SESSION["root"].'php/DAO/DatabaseConnection.php';
    include_once $_SESSION["root"].'php/Model/ModelDepartamento.php';
    include_once $_SESSION["root"].'php/Model/ModelPermissao.php';


    class DepartamentoDAO{
        
        function getAllDepart (){

            $instance = DatabaseConnection::getInstance();
            $conn = $instance->getConnection();
            
            $statement = $conn->prepare("SELECT * FROM departamento");
            $statement->execute();

            $linhas = $statement->fetchAll();

            if(count($linhas)==0)
                return null;
                
    

            foreach ($linhas as $value) {
                $departamento = new ModelDepartamento();
                $departamento->setDepartamentoFromDB($value);			
                $departamentos[]=$departamento;
            }	
            return $departamentos;		
        }

        function setDepartamento($depart){
            
            try {
                $sql = "INSERT INTO departamento (id, nome) VALUES ( :id , :nome)";
                $instance = DatabaseConnection::getInstance();
                $conn = $instance->getConnection();

                $statement = $conn->prepare($sql);

                $statement->bindValue(":id", $depart->getId());
                $statement->bindValue(":nome", $depart->getNome());
                return $statement->execute();

            } catch (PDOException $e) {
            echo "Erro ao inserir na base de dados.".$e->getMessage();
        }		

        }


        function getAllPermissoes (){

            $instance = DatabaseConnection::getInstance();
            $conn = $instance->getConnection();
            
            $statement = $conn->prepare("SELECT * FROM permissao");
           //$linhas = $statement->execute();
           $statement->execute();

           $linhas = $statement->fetchAll();

            if(count($linhas)==0)
                return null;
               
            foreach ($linhas as $value) {
                $permissao = new ModelPermissao();
                $permissao->setPermissaoFromDB($value);			
                $permissoes[]=$permissao;
            }
           
            return $permissoes;	
            	
        }


    }
    
?>