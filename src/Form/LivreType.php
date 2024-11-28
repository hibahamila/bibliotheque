<?php
namespace App\Form;

use App\Entity\Auteur;
use App\Entity\Genre;
use App\Entity\Livre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre du livre',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('ISBN', TextType::class, [
                'label' => 'Numéro ISBN',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('disponibilite', null, [
                'label' => 'Disponible',
                'attr' => ['class' => 'form-check-input'],
            ])
            ->add('image', FileType::class, [
                'label' => 'Image de couverture',
                'mapped' => false, // Ce champ n'est pas lié directement à l'entité
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('auteurs', EntityType::class, [
                'class' => Auteur::class,
                'choice_label' => 'nom',
                'label' => 'Auteur',
                'attr' => ['class' => 'form-select'],
            ])
            ->add('genres', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => 'nom',
                'label' => 'Genre',
                'attr' => ['class' => 'form-select'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
