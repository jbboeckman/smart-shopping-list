<?php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\mapping as ORM;

/**
 *	@ORM\Entity
 */

class User extends BaseUser{
	/**
	 *	@ORM\Id
	 *	@ORM\Column(type="integer")
	 *	@ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	
	public function __construct() {
		parent::__construct();
	}
}