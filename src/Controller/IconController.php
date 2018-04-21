<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Icon;
use App\Form\IconType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IconController extends BaseController {
	/**
	* @Route("/new-icon",name="icons")
	*/
	public function new(Request $request) {
		$icon = new Icon("", "");
		
		$form = $this->createForm(IconType::class, $icon);
		
		$form->handleRequest($request);
		
		if($form->isSubmitted()) {
			$imageFile = $icon->getIconImage();
			
			$fileName = md5(uniqid()) . '.' . $imageFile->guessExtension();
			
			$rootDirPath = $this->get('kernel')->getRootDir() . '/../public/uploads';
			
			$imageFile->move($rootDirPath, $fileName);
			
			$icon->setIconImage($fileName);
			//$icon = $form->getData();
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($icon);
			$entityManager->flush();
			
			return new Response(
				'<html><body>New icon was added: ' . $icon->getIconName() . 
				' file name: ' . $icon->getIconName() . 'img src=""/uploads/ . $icon->getIconImage() . ""/></body></html>'
			);
		}
		return $this->render('new-icon.html.twig',['icon_form' => $form->createView()]);
	}
	/**
	* @Route("/lister-icon",name="icon_list")
	*/
	public function list() {
		$repository = $this->getDoctrine()->getRepository(Icon::class);
		
		$icons = $repository->findAll();
		
		return $this->render('lister-icon.html.twig', ['icons' => $icons]);
	}
	/**
	* @Route("/icons/{id}",name="get_icon")
	*/
	public function getIcon(int $id){
		$repository = $this->getDoctrine()->getRepository(Icon::class);
		
		$icons = $repository->find($id);
		
		return $this->render('lister-icon.html.twig', ['icons' => $icons]);
	}
}