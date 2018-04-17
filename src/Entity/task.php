<?php

namespace App\Entity;

class task {
	private $description;
	private $dueDate;
	private $image;
	
	function __construct(string $description, \DateTime $dueDate, $image){
		$this->description = $description;
		$this->dueDate = $dueDate;
		$this->image = $image;
	}
	
	public function getDescription() : string{
		return $this->description;
	}
	public function setDescription(string $description){
		$this->description = $description;
	}
	
	public function getDueDate() : \DateTime{
		return $this->dueDate;
	}
	public function setDueDate(\DateTime $dueDate = null){
		$this->dueDate = $dueDate;
	}
	
	public function getImage() {
		return $this->image;
	}
	public function setImage($image){
		$this->image = $image;
	}
}