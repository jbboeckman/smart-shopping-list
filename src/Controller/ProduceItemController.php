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
	* @Route("/new-item")
	*/
	public function new(Request $request) {
		$item = new ProduceItem("", "", new \DateTime('today'));
		
		$form = $this->createForm(ProduceItemType::class, $item);
		
		$form->handleRequest($request);
		
		if($form->isSubmitted()) {
			$item = $form->getData();
			return new Response(
				'<html><body>New item was added: ' . $item->getName() . ' rots on ' . $item->getExpirationDate()->format('Y-m-d') . '</body></html>'
			);
		}
		
		return $this->render('new-item.html.twig',['item_form' => $form->createView()]);
	}
}