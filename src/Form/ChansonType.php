<?php

namespace App\Form;

use App\Entity\Chanson;
use App\Entity\Genre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChansonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class)
            ->add('Album', TextType::class)
            ->add('paroles', TextType::class)
            ->add('auteur', TextType::class)
            ->add('dateSortie', DateType::class)
            ->add('genre', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => 'nom',
            ])
            ->add('Sauver', SubmitType::class, ['label' => 'Sauver'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chanson::class,
        ]);
    }
}
