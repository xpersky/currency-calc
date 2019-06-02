<?php

namespace App\Form;

use App\Entity\Capitals;
use App\Entity\CalcData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\LessThan;

class CurrCalcType extends AbstractType // klasa formularza
{
    public function buildForm(FormBuilderInterface $builder, array $options)    
    {
        $builder
            ->add("Stolica", EntityType::class, [
            'class' => Capitals::class,
            'choice_label' => 'CapitalWithCurrency',
            'placeholder' => 'Gdzie chcesz jechać na wakacje?',
        ])
            ->add("Kwota", MoneyType::class , [
            'currency' => false,
            'constraints' => [
                new GreaterThan([ 'value' => 0 ]),
                new LessThan(['value' => 1000000 , 'message' => 'This value should be less than 1 m.'])
                ]
        ])
            ->add('runscript', CheckboxType::class, [
            'label'    => "Chcesz wiedzieć kiedy najlepiej wymienić walutę? (Może chwilę potrwać)",
            'required' => false
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CalcData::class
        ]);
    }
}
