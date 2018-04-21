<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity
*/
class Icon {
	/**
	* @ORM\Id
	* @ORM\GeneratedValue
	* @ORM\Column(type="integer")
	*/
	private $id;
	/**
	* @ORM\Column(type="string", length=50)
	*/
	private $iconName;
	/**
	* @ORM\Column(type="string", length=50)
	*/
	private $iconImage;
	
	function __construct($iconName, $iconImage){
		$this->iconName = $iconName;
		$this->iconImage = $iconImage;
	}
	public function getId() {
		return $this->id;
	}
	
	public function getIconName() {
		return $this->iconName;
	}
	public function setIconName($iconName){
		$this->iconName = $iconName;
	}
	
	public function getIconImage() {
		return $this->iconImage;
	}
	public function setIconImage($iconImage){
		$this->iconImage = $iconImage;
	}
}