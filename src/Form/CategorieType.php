<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Post;
use App\Entity\Project;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            //             ->add('project_id', EntityType::class, [
            //                 'class' => Project::class,
            // 'choice_label' => 'id',
            // 'multiple' => true,
            //             ])
            //             ->add('post_id', EntityType::class, [
            //                 'class' => Post::class,
            // 'choice_label' => 'id',
            // 'multiple' => true,
            //             ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
}
