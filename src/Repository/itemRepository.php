<?php

namespace App\Repository;

use App\Entity\ProduceItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class itemRepository extends ServiceEntityRepository {
	public function __construct(RegistryInterface $registry) {
		parent::__construct($registry, itemRepository::class);
	}
	public function getShoppingListItems() {
		return $this->getEntityManager()
			->createQuery('SELECT ProduceItem FROM App\Entity\ProduceItem ProduceItem WHERE ProduceItem.inShoppingList = :inShoppingList')
			->setParameter('inShoppingList', 'FALSE')
			->getResult();
	}
	public function getRegrigeratorItems() {
		return $this->getEntityManager()
			->createQuery('SELECT ProduceItem FROM App\Entity\ProduceItem ProduceItem WHERE ProduceItem.inShoppingList = :inShoppingList')
			->setParameter('inShoppingList', 'TRUE')
			->getResult();
	}
}