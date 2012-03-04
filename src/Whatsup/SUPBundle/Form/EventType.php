<?php

namespace Whatsup\SUPBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class EventType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('startdate', 'date', array(
				'widget' => 'single_text',
				'format' => 'MM/dd/yyyy'
			))
            ->add('enddate', 'date',array(
				'widget' => 'single_text',
				'format' => 'MM/dd/yyyy'
			))
            ->add('description')
            ->add('flyer', new ImageType())
            ->add('venue')
			->add('is_featured')
        ;
    }

    public function getName()
    {
        return 'event';
    }
}
