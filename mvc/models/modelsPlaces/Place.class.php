<?php 
class Place
{

	public $place,$occupation;
	public $client_nom;

	function __construct($place,$occupation)
	{
		$this->setPlace($place);
		$this->setOccupation($occupation);
	}

	public function setPlace($place)
	{
		$this->place = (int)$place;
	}

	public function setOccupation($occupation)
	{
		$this->occupation = $occupation;
	}

	public function getPlace()
	{
		return $this->place;
	}

	public function getOccupation()
	{
		return $this->occupation;
	}


}
 ?>