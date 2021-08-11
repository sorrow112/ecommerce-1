<?php
namespace App\Form;

use App\Paymentlocal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class paymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
        ->add("nom",TextType::class)
        ->add("prenom",TextType::class)
        ->add("numeroDeCarte",Integer::class)
        ->add("CW",TextType::class)
        ->add("MMYY",Integer::class)
        ;
        
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Paymentlocal::class,
        ]);
    }
}