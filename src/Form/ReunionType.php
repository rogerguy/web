<?php

namespace App\Form;

use App\Entity\Reunion;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class ReunionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      
        $builder
            ->add('membrepresent',EntityType::class, [
            'class'=> User::Class,
            'multiple' => true, 
            'expanded' => true,
            'choice_label' => 'username'
            ])
            ->add('membreabsent',EntityType::class, [
                'class'=> User::Class,
                'multiple' => true, 
                'expanded' => true,
                ])
            ->add('contenu')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reunion::class,
            
        ]);
    }
}
