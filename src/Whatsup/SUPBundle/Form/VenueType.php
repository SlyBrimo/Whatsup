<?php

namespace Whatsup\SUPBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class VenueType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('address')
            ->add('city')
            ->add('state')
            ->add('zip')
            ->add('phone')
            ->add('logo')
            ->add('website')
            ->add('description')
            ->add('user')
            ->add('image', new ImageType())
        ;
    }

    public function getName()
    {
        return 'whatsup_supbundle_venuetype';
    }
}
