<?php

/*
 * This file is part of the BrueryAdminBundle package.
 *
 * (c) mell m. zamora <mell@rzproject.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bruery\AdminBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class OverrideCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        //override admin pool class
        if ($container->hasParameter('bruery.admin.pool.base_admin.class')) {
            $definition = $container->getDefinition('sonata.admin.pool');
            $definition->setClass($container->getParameter('bruery.admin.pool.base_admin.class'));
            if ($container->hasParameter('bruery.admin.options.use_footable') && $container->hasParameter('bruery.admin.settings.footable')) {
                $definition->addMethodCall('setOption', array('use_footable', $container->getParameter('bruery.admin.options.use_footable')));
                $definition->addMethodCall('setOption', array('footable_settings', $container->getParameter('bruery.admin.settings.footable')));
            }
        }
    }
}
