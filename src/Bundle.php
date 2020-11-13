<?php

namespace App;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use FONT\UserBundle\DependencyInjection\Compiler\ChangeSecretKeyAESCompiler;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FONTUserBundle extends Bundle
{
 
    public function getParent()
    {
        return 'FOSUserBundle';
    }


}