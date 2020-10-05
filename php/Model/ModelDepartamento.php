<?php 
class ModelDepartamento{
    public $id;
    public $nome;


    public function setDepartamentoFromDB ($linha){
        $this->setId($linha["id"])
            ->setNome($linha["nome"]);
    }

    public function setDepartamentoFromPOST(){
        $this->setId(null)
             ->setNome($_POST["nome"]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

} 
?>