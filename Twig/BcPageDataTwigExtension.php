<?php
/**
 * File containing the BcPageDataTwigExtension class part of the BcPageDataBundle package.
 *
 * @copyright Copyright (C) Brookins Consulting. All rights reserved.
 * @license For full copyright and license information view LICENSE and COPYRIGHT.md file distributed with this source code.
 * @version //autogentag//
 */

namespace BrookinsConsulting\BcPageDataBundle\Twig;

use Twig_Extension;
use Twig_Function_Method;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BcPageDataTwigExtension extends Twig_Extension
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    /**
     * @var \BrookinsConsulting\BcPageDataBundle\Services\BcPageDataPersistence
     */
    protected $pageDataPersistence;

    /**
     * Constructor
     *
     * @param Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function __construct( ContainerInterface $container )
    {
        $this->container = $container;
        $this->pageDataPersistence = $this->container->get('brookinsconsulting.page_data_persistence');
    }

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'bc_pagedata' => new Twig_Function_Method( $this, 'pageData' ),
        );
    }

    /**
     * Implements the "bc_pagedata" function
     *
     * @return array
     */
    public function pageData()
    {
        $requestPersistentStorageParameters = $this->pageDataPersistence->pageData();

        return $requestPersistentStorageParameters;
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'bc_pagedata';
    }
}
