<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\task;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class TaskType extends AbstractType {
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
		->add('description', TextType::class)
		->add('dueDate', DateType::class)
		->add('image', FileType::class, ['label' => 'upload image'])
		->add('save', SubmitType::class, ['label' => 'Create new Task']);
	}
	public function configureOptions(OptionsResolver $resolver){
		$resolver->setDefaults(['data_class' => task::class]);
	}
}