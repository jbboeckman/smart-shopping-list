<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\ProduceItem;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProduceItemType extends AbstractType {
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
		
		$builder
		->add('name', TextType::class)
		->add('icon', TextType::class, [
			'class' => Icon::class,
			'choice_label' => 'iconName'
		])
		->add('expirationDate', DateType::class)
		->add('save', SubmitType::class, ['label' => 'Create new item']);
	}
	public function configureOptions(OptionsResolver $resolver)	{
		$resolver->setDefaults(['data_class' => ProduceItem::class]);
	}
}