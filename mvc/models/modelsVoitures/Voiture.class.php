<?php
class Voiture{
    private $idvoit;
    private $design;
    private $type;
    private $nbrPlace;
    private $frais;

    public function __construct($idvoit,$design,$type,$nbrPlace,$frais){
        $this->idvoit = $idvoit;
        $this->design = $design;
        $this->type = $type;
        $this->nbrPlace = $nbrPlace;
        $this->frais = $frais;
    }

    public function getIdvoit(){return $this->idvoit;}
    public function setIdvoit($idvoit){$this->idvoit = $idvoit;}

    public function getDesign(){return $this->design;}
    public function setDesign($design){$this->design = $design;}

    public function setType($type){$this->type = $type;}
    public function getType(){return $this->type;}

    public function getNbrPlace(){return $this->nbrPlace;}
    public function setNbrPlace($nbrPlace){$this->nbrPlace = $nbrPlace;}

    public function getFrais(){return $this->frais;}
    public function setFrais($frais){$this->frais = $frais;}
}
?>