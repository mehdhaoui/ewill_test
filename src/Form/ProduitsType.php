<?php

namespace App\Form;

use App\Entity\Produits;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Regex;

class ProduitsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference',TextType::class, [
                'required' => true,
                'constraints' => [
                    new Length(['min' => 2,'max'=>5]),
                    new NotBlank(),
                    new Type('alnum','Cette ne valeur doit contenir uniquement des chiffres et\ou des lettres.')
                ],
                'attr'=>[
                    'placeholder'=> 'Saisissez la référence du produit'
                ]
            ])
            ->add('nom',TextType::class, [
                'required' => true,
                'constraints' => [
                    new Length(['min' => 2,'max'=>50]),
                    new NotBlank(),
                    new Regex('/^[A-Za-z-_áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ ]{1,64}$/','Cette ne valeur doit contenir uniquement des lettres.')
                ],
                'attr'=>[
                    'placeholder'=> 'Saisissez le nom du produit'
                ]
            ])
            ->add('description',TextType::class, [
                'required' => true,
                'constraints' => [
                    new Length(['min' => 2]),
                    new NotBlank()
                ],
                'attr'=>[
                    'placeholder'=> 'Saisissez une description'
                ]
            ])
            ->add('prix',TextType::class, [
                'required' => true,
                'constraints' => [
                    new Length(['min' => 2,'max'=>10]),
                    new NotBlank(),
                    new Regex('/(USD|EUR|€|\$)\s?(\d{1,3}(?:[.,]\d{3})*(?:[.,]\d{2}))|(\d{1,3}(?:[.,]\d{3})*(?:[.,]\d{2})?)\s?(USD|EUR|€|\$)/','Cette valeur doit contenir uniquement des chiffres et les symboles € et $.')
                ],
                'attr'=>[
                    'placeholder'=> 'Saisissez le prix du produit'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produits::class,
        ]);
    }
}
