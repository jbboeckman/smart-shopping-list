<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ProduceItem;
use App\Form\ProduceItemType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ShoppingListController extends BaseController {
	/**
	* @Route("/shopping-list/new", name="shopping-list-new-item")
	*/
	public function new(Request $request) {
		$item = new ProduceItem("", "", new \DateTime('today'));
		
		$form = $this->createForm(ProduceItemType::class, $item);
		
		$form->handleRequest($request);
		
		if($form->isSubmitted()) {
			
			//var_dump($course->getIconName());
			//die();
			
			$item->addIcon($item->getIcon()[0]);
			
				$item = $form->getData();
				$item->setInShoppingList(true);
				$entityManager = $this->getDoctrine()->getManager();
				$entityManager->persist($item);
				$entityManager->flush();
			return new Response(
				'<html><body>New item was added: ' . $item->getName() . ' rots on ' . /*$item->getExpirationDate()->format('Y-m-d') .*/ $item->getInShoppingList() . '</body></html>'
			);
		}
		
		return $this->render('new-item.html.twig',['item_form' => $form->createView()]);
	}
	/**
	* @Route(" /shopping-list", name="shopping-list")
	*/
	public function list() {
		$repository = $this->getDoctrine()->getRepository(ProduceItem::class);
		
		//$items = $repository->findAll();
		$items = $repository->getShoppingListItems();
		
		return $this->render('/lister-item.html.twig',['items' => $items]);
	}
	/**
	* @Route("/items/delete/{id}",name="delete_item")
	* @Method("DELETE")
	*/
	public function deleteItem(int $id) {
		$repo = $this->getDoctrine()->getRepository(ProduceItem::class);
		$items = $repo->find($id);
		
		$en = $this->getDoctrine()->getManager();
		$en->remove($items);
		$en->flush();
		
		return new JsonResponse([], Response::HTTP_NO_CONTENT);
	}
	/**
	* @Route("/items/(id)/edit", name="edit_item")
	*/
	public function editProduceItem(int $id, Request $request){
		$repo = $this->getDoctrine()->getRepository(ProduceItemType::class);
		$ProduceItem = $repo->find($id);
		
		$form= $this->createForm(ProduceItemType::class, $ProduceItem);
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted()) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($ProduceItem);
			$entityManager->flush;
			
			return new Response('produceitem ' . $ProduceItem->getId() . ' got updated!');
		}
		return $this->render('produceitem/index.html.twig', ['form' => $form->createView(), 'label' => 'Edit Item']);
	}
	/**
	* @Route("items/{id}", name="ajax_edit_item")
	* @Method("PUT")
	*/
	public function ajaxEditItem(int $id, Request $request){
		$ProduceItem = $this->getDoctrine()->getRepository(ProduceItem::class)->find($id);
		
		$data = $request->request->all();
		
		$form= $this->createForm(ProduceItemType::class, $ProduceItem);
		$form->submit($data);
		
		$entityManager = $this->getDoctrine()->getManager();
		$entityManager->persist($ProduceItem);
		$entityManager->flush();
		
		return JsonResponse([], Response::HTTP_OK);
	}
	/**
	* @Route("items/download", name="itemlist_download")
	*/
	public function download() {
		$repository = $this->getDoctrine()->getRepository(ProduceItem::class);
		$items = $repository->findAll();
		$fileName = 'itemlist.txt';
		
		$fp = fopen($fileName,'w');
		
		$content = '';
		
		foreach($items as $produceitem) {
			$nm = $produceitem->getName();
			$ed = $produceitem->getExpirationDate();
			$content .= "$nm $ed:\n";
			
			
		}
		
		fwrite($fp, $content);
		fclose($fp);
		
		return $this->file($fileName);
	}
}