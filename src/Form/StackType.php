<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\Stack;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class StackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('icon', FileType::class, [
                'label' => 'Icône de la stack (PNG, JPG, SVG)',
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
            //             ->add('project_id', EntityType::class, [
            //                 'class' => Project::class,
            // 'choice_label' => 'id',
            // 'multiple' => true,
            //             ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Stack::class,
        ]);
    }
}
