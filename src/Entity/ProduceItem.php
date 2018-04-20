<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity
*/
class ProduceItem {
	/**
	* @ORM\Id
	* @ORM\GeneratedValue
	* @ORM\Column(type="integer")
	*/
	private $id;
	/**
	* @ORM\Column(type="string", length=50)
	*/
	private $name;
	/**
	* @ORM\Column(type="string", length=50)
	*/
	private $icon;
	/**
	* @ORM\Column(type="datetime")
	*/
	private $expirationDate;
	
	function __construct(string $name, string $icon, \DateTime $expirationDate) {
		$this->name = $name;
		$this->icon = $icon;
		$this->expirationDate = $expirationDate;
	}
	
	public function getName() : string {
		return $this->name;
	}
	public function setName(string $name){
		$this->name = $name;
	}
	
	public function getIcon() : string {
		return $this->icon;
	}
	public function setIcon(string $icon){
		$this->icon = $icon;
	}
	
	public function getExpirationDate() : \DateTime{
		return $this->expirationDate;
	}
	public function setExpirationDate(\DateTime $expirationDate = null){
		$this->expirationDate = $expirationDate;
	}
}