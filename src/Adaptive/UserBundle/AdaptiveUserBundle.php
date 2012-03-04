<?php

namespace Adaptive\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AdaptiveUserBundle extends Bundle
{
	public function getParent()
    {
        return 'FOSUserBundle';
    }
}
