<?php 

class FuncionarioDTO {
    public $idFuncionario;
	public $nome; 
    public $salario; 
    public $login;
    public $senha;
	public $nomePermissao;
    public $nomeDepartamento;
    public $ativo;
    

    public function setFuncionarioFromDataBaseDAO ($linha){
        $this->setIdFuncionario($linha["idFuncionario"])
            ->setNome($linha["nomeFunc"])
            ->setSalario($linha["salario"])
            ->setLogin($linha['login'])
            ->setNomePermissao($linha['tipo'])
            ->setNomeDepartamento($linha['nome'])
            ->setAtivo($linha['ativo']);
    }
    
   


    
    public function getAtivo(){
        return $this->ativo;
    }

    public function setAtivo($ativo){
        $this->ativo = $ativo;
        return $this;
    }



    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    public function getIdFuncionario()
    {
        return $this->idFuncionario;
    }

   
    public function setIdFuncionario($idFuncionario)
    {
        $this->idFuncionario = $idFuncionario;

        return $this;
    }

    
    public function getNome()
    {
        return $this->nome;
    }

    
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    
    public function getSalario()
    {
        return $this->salario;
    }

    
    public function setSalario($salario)
    {
        $this->salario = $salario ;

        return $this;
    }

    
    public function getNomePermissao()
    {
        return $this->nomePermissao;
    }

    
    public function setNomePermissao($nomePermissao)
    {
        $this->nomePermissao = $nomePermissao;
        return $this;
    }

    
    public function getNomeDepartamento()
    {
        return $this->nomeDepartamento;
    }

    
    public function setNomeDepartamento($nomeDepartamento)
    {
        $this->nomeDepartamento = $nomeDepartamento;

        return $this;
    }











}

?>
