<?php
/**
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamora <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

namespace Bruery\AdminBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class BrueryAdminExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('core.xml');

        #set options
        $container->setParameter('bruery.admin.options.use_footable', $config['options']['use_footable']);
        #pool class
        if (isset($config['pool']['base_admin_class'])) {
            $container->setParameter('bruery.admin.pool.base_admin.class', $config['pool']['base_admin_class']);
        }

        #pool class
        if (isset($config['footable_settings'])) {
            $container->setParameter('bruery.admin.settings.footable', $config['footable_settings']);
        }

        if (isset($config['options']['skin'])) {
            $container->setParameter('bruery.admin.settings.skin', $config['options']['skin']);
        } else {
            $container->setParameter('bruery.admin.settings.skin', 'skin-black');
        }

        if (isset($config['options']['sidebar_collapse'])) {
            $container->setParameter('bruery.admin.settings.sidebar_collapse', $config['options']['sidebar_collapse']);
        } else {
            $container->setParameter('bruery.admin.settings.sidebar_collapse', false);
        }



        $this->configureClassesToCompile();
    }

    public function configureClassesToCompile()
    {
        $this->addClassesToCompile(array(
            'Bruery\\AdminBundle\\Admin\\Pool',
        ));
    }
}
