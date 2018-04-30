<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ProduceItem;
use App\Form\ProduceItemType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProduceItemController extends BaseController {
	/**
	* @Route("/new-item",name="items")
	*/
	public function new(Request $request) {
		$item = new ProduceItem("", "", new \DateTime('today'));
		
		$form = $this->createForm(ProduceItemType::class, $item);
		
		$form->handleRequest($request);
		
		if($form->isSubmitted()) {
			
			//var_dump($course->getIconName());
			//die();
			
			$ProduceItem->addIcon($ProduceItem->getIcon()[0]);
			
				$item = $form->getData();
				$entityManager = $this->getDoctrine()->getManager();
				$entityManager->persist($item);
				$entityManager->flush();
			return new Response(
				'<html><body>New item was added: ' . $item->getName() . ' rots on ' . $item->getExpirationDate()->format('Y-m-d') . $item->getInShoppingList() . '</body></html>'
			);
		}
		
		return $this->render('new-item.html.twig',['item_form' => $form->createView()]);
	}
	/**
	* @Route("/lister-item",name="item_list")
	*/
	public function list() {
		$repository = $this->getDoctrine()->getRepository(ProduceItem::class);
		
		$items = $repository->findAll();
		
		return $this->render('/lister-item.html.twig',['items' => $items]);
	}
	/**
	* @Route("/items/{id}",name="get_item")
	*/
	public function getItems(int $id){
		$repository = $this->getDoctrine()->getRepository(ProduceItem::class);
		
		$items = $repository->find($id);
		
		return $this->render('lister-item.html.twig', ['items' => $item]);
	}
}