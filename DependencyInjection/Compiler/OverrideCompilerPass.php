<?php
/**
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamora <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
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
            $definition->addMethodCall('setOption', array('skin', $container->getParameter('bruery.admin.settings.skin')));
            $definition->addMethodCall('setOption', array('sidebar_collapse', $container->getParameter('bruery.admin.settings.sidebar_collapse')));
        }
    }
}
