<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Project;
use App\Entity\Stack;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'empty_data' => '',
            ])
            ->add('description', TextType::class, [
                'empty_data' => '',
            ])
            ->add('image', FileType::class, [
                'label' => 'Image du projet (PNG, JPG, SVG)',
                'mapped' => false, // Ne mappe pas directement à l'entité
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => ['image/png', 'image/jpeg', 'image/svg+xml'],
                        'mimeTypesMessage' => 'Formats autorisés : PNG, JPG, SVG',
                    ])
                ],
            ])
            ->add('link', TextType::class, [
                'empty_data' => '',
            ])
            ->add('created_at', null, [
                'widget' => 'single_text'
            ])
            ->add('users', EntityType::class, [
                'class' => User::class,
                'choice_label' => function (User $user) {
                    return $user->getName();
                },
                'multiple' => true,
            ])
            ->add('stacks', EntityType::class, [
                'class' => Stack::class,
                'choice_label' => function (Stack $stack) {
                    return $stack->getName();
                },
                'multiple' => true,
            ])
            ->add('category_id', EntityType::class, [
                'label' => 'Catégorie(s)',
                'class' => Categorie::class,
                'choice_label' => function (Categorie $categorie) {
                    return $categorie->getName();
                },
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
