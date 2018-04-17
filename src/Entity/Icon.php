<?php

namespace App\Entity;

class Icon {
	private $iconName;
	private $iconImage;
	
	function __construct(string $iconName, $iconImage){
		$this->iconName = $iconName;
		$this->iconImage = $iconImage;
	}
	
	public function getIconName() : string{
		return $this->iconName;
	}
	public function setIconName(string $iconName){
		$this->iconName = $iconName;
	}
	
	public function getIconImage() {
		return $this->iconImage;
	}
	public function setIconImage($iconImage){
		$this->iconImage = $iconImage;
	}
}