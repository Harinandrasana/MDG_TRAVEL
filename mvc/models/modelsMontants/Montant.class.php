<?php 
class Montant
{

	public $montantAccumule;

	function __construct($montantAccumule)
	{
		$this->setMontantAccumule($montantAccumule);
	}

	public function setMontantAccumule($montantAccumule)
    {
        $this->montantAccumule = $montantAccumule;
    }
    public function getMontantAccumule()
    {
        return $this->montantAccumule;
    }
}
 ?>