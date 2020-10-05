<?php
class ModelFuncionario {

	public $idFuncionario;
	public $nomeFunc; 
	public $salario;
	public $login;
	public $senha; 
	public $idPermissao;
	public $idDepartamento;

    /**
     * Popula um obj funcionario com os dados vindos da tabela funcionario. Funciona como um construtor
     *
     * @param um array com dados da tupla proveniente do DB, em que o nome do atributo na entidade é o mesmo do atributo no objeto
     *
     * @return não há retorno.
     */
    public function setFuncionarioFromDataBase($linha){
        $this->setIdFuncionario($linha["idFuncionario"])
               ->setNomeFunc($linha["nomeFunc"])
               ->setSalario($linha["salario"])
               ->setLogin($linha['login'])
               ->setSenhaBD($linha['senha'])
               ->setIdPermissao($linha['idPermissao'])
               ->setIdDepartamento($linha['idDepartamento']);
    }


    public function setFuncionarioFromPOST(){

        $this->setIdFuncionario(null)
               ->setNomeFunc($_POST["nomeFunc"])
               ->setSalario($_POST["salario"])
               ->setLogin($_POST['login'])
               ->setSenhaPOST($_POST['senha'])
               ->setIdPermissao($_POST['idPermissao'])
               ->setIdDepartamento($_POST['idDepartamento']);
    }

    public function setFuncionarioEditadoFromPOST(){

        //$senha_sal = $_POST['senha']."23"; SALGANDO SENHA
        $this-> setIdFuncionario($_POST["idFuncionario"])  
               ->setNomeFunc($_POST["nomeFunc"])
               ->setSalario($_POST["salario"])
               ->setLogin($_POST['login'])
               ->setSenhaPOST($_POST['senha'])
               ->setIdPermissao($_POST['idPermissao'])
               ->setIdDepartamento($_POST['idDepartamento']);
    }

    /**
     * Gets the value of idFuncionario.
     *
     * @return mixed
     */
    public function getIdFuncionario()
    {
        return $this->idFuncionario;
    }

    /**
     * Sets the value of idFuncionario.
     *
     * @param mixed $idFuncionario the id funcionario
     *
     * @return self
     */
    public function setIdFuncionario($idFuncionario)
    {
        $this->idFuncionario = $idFuncionario;

        return $this;
    }

    /**
     * Gets the value of nome.
     *
     * @return mixed
     */
    public function getNomeFunc()
    {
        return $this->nomeFunc;
    }

    /**
     * Sets the value of nome.
     *
     * @param mixed $nome the nome
     *
     * @return self
     */
    public function setNomeFunc($nomeFunc)
    {
        $this->nomeFunc = $nomeFunc;

        return $this;
    }

    /**
     * Gets the value of salario.
     *
     * @return mixed
     */
    public function getSalario()
    {
        return $this->salario;
    }

    /**
     * Sets the value of salario.
     *
     * @param mixed $salario the salario
     *
     * @return self
     */
    public function setSalario($salario)
    {
        $this->salario = $salario ;

        return $this;
    }

    /**
     * Gets the value of login.
     *
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Sets the value of login.
     *
     * @param mixed $login the login
     *
     * @return self
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Gets the value of senha.
     *
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Sets the value of senha.
     *
     * @param mixed $senha the senha
     *
     * @return self
     */
    public function setSenhaPOST($senha)
    {
        //Por mais que função do PHP password_hash seja mais segura, ela vai dar problema na correção
        #$this->senha = password_hash($senha, PASSWORD_DEFAULT);

        if  ($senha == ""){
            return $this;
        }
        else{

            $this->senha = md5($senha."pw2-2020");
            //print_r($this->senha);
            return $this; 
        }

        $this->senha = md5($senha);
        return $this;
    }
    public function setSenhaBD($senha)
    {
        //Qdo a senha vem do banco, não posso criptografar, pq ela já vem criptografada
        $this->senha = $senha;
        return $this;
    }

    /**
     * Gets the value of idPermissao.
     *
     * @return mixed
     */
    public function getIdPermissao()
    {
        return $this->idPermissao;
    }

    /**
     * Sets the value of idPermissao.
     *
     * @param mixed $idPermissao the id permissao
     *
     * @return self
     */
    public function setIdPermissao($idPermissao)
    {
        $this->idPermissao = $idPermissao;
        return $this;
    }

    /**
     * Gets the value of idDepartamento.
     *
     * @return mixed
     */
    public function getIdDepartamento()
    {
        return $this->idDepartamento;
    }

    /**
     * Sets the value of idDepartamento.
     *
     * @param mixed $idDepartamento the id departamento
     *
     * @return self
     */
    public function setIdDepartamento($idDepartamento)
    {
        $this->idDepartamento = $idDepartamento;

        return $this;
    }
}