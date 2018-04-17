<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Icon;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class IconType extends AbstractType {	
	public function buildForm(FormBuilderInterface $builder, array $options){
		
		$builder
		->add('iconName', TextType::class)
		->add('iconImage', FileType::class, ['label' => 'upload image'])
		->add('save', SubmitType::class, ['label' => 'Submit image']);
	}
	public function configureOptions(OptionsResolver $resolver)	{
		$resolver->setDefaults(['data_class' => Icon::class]);
	}
}