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

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('bruery_admin');

        $rootNode
            ->children()
                ->arrayNode('options')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('use_footable')->defaultTrue()->info('Enables Admin list responsive table')->end()
                        ->scalarNode('skin')->defaultValue('skin-black')->info('AdminLTE Theme')->end()
                        ->scalarNode('sidebar_collapse')->defaultTrue()->info('AdminLTE Side Bar Settings')->end()
                    ->end()
                ->end()
                ->arrayNode('pool')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('base_admin_class')->defaultNull()->info('Base admin pool class')->end()
                    ->end()
                ->end()
                ->arrayNode('footable_settings')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('show_header')->defaultTrue()->end()
                        ->booleanNode('show_toggle')->defaultTrue()->end()
                        ->scalarNode('toggle_column')->defaultValue('last')->end()
                    ->end()
                ->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}
