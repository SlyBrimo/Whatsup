<?php

namespace Whatsup\SUPBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('file')
        ;
    }

	public function getDefaultOptions(array $options)
	{
	    return array(
	        'data_class' => 'Whatsup\SUPBundle\Entity\Image',
	    );
	}

    public function getName()
    {
        return 'image';
    }
}
