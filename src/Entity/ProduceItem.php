<?php

namespace App\Entity;

class ProduceItem {
	private $name;
	private $icon;
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