<?php

namespace App\Form;

use App\Entity\Invoice;
use App\Entity\InvoiceLines;
use App\Repository\InvoiceRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class InvoiceLineFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('quantity', NumberType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('amount', NumberType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('vat_amount', NumberType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('total_vat', NumberType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('invoice', EntityType::class, [
                'label' => "Invoice",
                'class' => Invoice::class,
                'query_builder' => function (InvoiceRepository $er){
                    $query = $er->createQueryBuilder('r');
                    return $query;
                },
                'choice_label' => 'invoice_number',
                'placeholder' => 'Select',
                'required' => true,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InvoiceLines::class,
        ]);
    }
}
