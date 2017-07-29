<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class AppointmentForm extends AbstractType
{
    /**
     * Adds fields to formbuilder so they are available in template.
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'required' => true,
                'constraints' => [new NotBlank()],
                'label' => 'form.name',
                'attr' => array(
                    'placeholder' => 'form.name',
                    'class' => 'form-control'
                )
            ))
            ->add('phone', TextType::class, array(
                'required' => true,
                'constraints' => [new NotBlank()],
                'label' => 'form.phone',
                'attr' => array(
                    'placeholder' => 'form.phone',
                    'class' => 'form-control'
                )
            ))
            ->add('emailaddress', TextType::class, array(
                'required' => true,
                'constraints' => [new NotBlank(), new Email()],
                'label' => 'form.email',
                'attr' => array(
                    'placeholder' => 'form.email',
                    'class' => 'form-control',
                )
            ))
            ->add('date', TextType::class, array(
                'required' => true,
                'constraints' => [new NotBlank()],
                'label' => 'form.date',
                'attr' => array(
                    'date' => true,
                    'placeholder' => 'form.date',
                    'class' => 'form-control input-inline',
                )
            ))
            ->add('pickup_location', TextType::class, array(
                'required' => true,
                'constraints' => [new NotBlank()],
                'label' => 'form.pickup_location',
                'attr' => array(
                    'placeholder' => 'form.pickup_location',
                    'class' => 'form-control'
                )
            ))
            ->add('drop_location', TextType::class, array(
                'required' => true,
                'constraints' => [new NotBlank()],
                'label' => 'form.drop_location',
                'attr' => array(
                    'placeholder' => 'form.drop_location',
                    'class' => 'form-control'
                )
            ))
            ->add('description', TextareaType::class, array(
                'required' => false,
                'label' => 'form.description',
                'attr' => array(
                    'placeholder' => 'form.description',
                    'class' => 'form-control'
                )
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'form.submit',
                'attr' => array(
                    'placeholder' => 'form.drop_location',
                    'class' => 'btn btn-default btn-green'
                ),
            ));
    }
}
