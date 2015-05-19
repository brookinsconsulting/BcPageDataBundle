<?php
/**
 * File containing the BcPageDataBundle class part of the BcPageDataBundle package.
 *
 * @copyright Copyright (C) Brookins Consulting. All rights reserved.
 * @license For full copyright and license information view LICENSE and COPYRIGHT.md file distributed with this source code.
 * @version //autogentag//
 */

namespace BrookinsConsulting\BcPageDataBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Yaml\Yaml;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class BcPageDataExtension extends Extension
{
    /**
     * Allow an extension to load the bundle configurations.
     * Here we will load our bundle settings.
     *
     * @param Array $configurations
     * @param ContainerBuilder $container
     */
    public function load(array $configurations, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader(
            $container,
            new FileLocator( __DIR__ . '/../Resources/config' )
        );

        $loader->load( 'services.yml' );

        $configuration = new BcPageDataConfiguration();

        $container->setParameter(
            'page_data.config', $this->processConfiguration( $configuration, Yaml::parse(__DIR__ . '/../Resources/config/config.yml') )
        );
    }

    /**
     * Returns extension alias
     *
     * @return string
     */
    public function getAlias()
    {
        return 'bc_page_data';
    }
}
