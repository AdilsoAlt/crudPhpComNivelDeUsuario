<?php 
class ModelPermissao{
    public $id;
    public $tipo;


    public function setPermissaoFromDB ($linha){
        $this->setId($linha["id"])
            ->setTipo($linha["tipo"]);
    }



    public function getId()
    {
        return $this->id;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

} 
?>