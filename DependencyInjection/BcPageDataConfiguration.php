<?php
/**
 * File containing the BcPageDataConfiguration class part of the BcPageDataBundle package.
 *
 * @copyright Copyright (C) Brookins Consulting. All rights reserved.
 * @license For full copyright and license information view LICENSE and COPYRIGHT.md file distributed with this source code.
 * @version //autogentag//
 */

namespace BrookinsConsulting\BcPageDataBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class BcPageDataConfiguration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $TreeBuilder = new TreeBuilder();

        $RootNode = $TreeBuilder->root( 'brookinsconsulting_page_data_persistence_options' );

        $RootNode
            ->children()
                ->booleanNode( 'display_debug' )
                    ->defaultFalse()
                    ->isRequired()
                ->end()
                ->scalarNode( 'display_debug_level' )
                    ->isRequired()
                ->end()
            ->end();

        return $TreeBuilder;
    }
}
