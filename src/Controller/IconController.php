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
	* @Route("/new-icon")
	*/
	public function new(Request $request) {
		$icon = new Icon("", "");
		
		$form = $this->createForm(IconType::class, $icon);
		
		$form->handleRequest($request);
		
		if($form->isSubmitted()) {
			$imageFile = $icon->getIconImage();
			
			$fileName = $icon->getIconName();
			
			$rootDirPath = $this->get('kernel')->getRootDir() . '/../public/uploads';
			
			$imageFile->move($rootDirPath, $fileName);
			
			$icon->setIconImage($fileName);
			//$icon = $form->getData();
			return new Response(
				'<html><body>New icon was added: ' . $Icon->getIconName() . 
				' file name: ' . $icon->getIconName() . 'img src=""/uploads/ . $icon->getIconImage() . ""/></body></html>'
			);
		}
		return $this->render('new-icon.html.twig',['icon_form' => $form->createView()]);
	}
}