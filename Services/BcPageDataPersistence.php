<?php
/**
 * File containing the BcPageDataPersistence class part of the BcPageDataBundle package.
 *
 * @copyright Copyright (C) Brookins Consulting. All rights reserved.
 * @license For full copyright and license information view LICENSE and COPYRIGHT.md file distributed with this source code.
 * @version //autogentag//
 */

namespace BrookinsConsulting\BcPageDataBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ParameterBag;

class BcPageDataPersistence
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var bool
     */
    protected $displayDebug;

    /**
     * @var \Symfony\Component\DependencyInjection\ParameterBag
     */
    protected $parameters;

    /**
     * Constructor
     *
     * @param Symfony\Component\DependencyInjection\ContainerInterface $container
     * @param array $options
     */
    public function __construct( ContainerInterface $container, array $options = array() )
    {
        $this->container = $container;
        $this->options = $options[0];
        $this->displayDebug = $this->options['display_debug'] === true ? true : false;

        if ( !isset( $this->parameters ) )
        {
            $this->parameters = new ParameterBag\ParameterBag(
                array(
                    'bc_page_data_serivce_timestamp' => $this->udate( 'l jS \of F Y h:i:s:u A' )
                )
            );
        }
        else if ( isset( $this->parameters ) )
        {
            $this->parameters->set(
                array(
                    'bc_page_data_serivce_timestamp' => $this->udate( 'l jS \of F Y h:i:s:u A' )
                )
            );
        }

        if ( $this->displayDebug )
        {
            echo "<span style='color:000000;'>BcPageDataPersistence : __construct:</span><br />\n";
            var_dump( $this->parameters() );
        }
    }

    /**
     * Return all persistent storage parameters
     *
     * @return array
     */
    public function parameters()
    {
        if ( $this->displayDebug )
        {
            echo "<span style='color:000000;'>BcPageDataPersistence : parameters method:</span><br />\n";
        }

        return $this->parameters->all();
    }

    /**
     * Return all persistent storage parameters
     *
     * @return array
     */
    public function pageData()
    {
        return $this->parameters();
    }

    /**
     * Test if persistent storage variable exists and return true
     *
     * @param string $name Persistent storage variable name
     * @return bool
     */
    public function has( $name )
    {
        return $this->parameters->has( $name );
    }

    /**
     * Gets the value of persistent storage variable
     *
     * @param string $name Persistent storage variable name
     * @param string $default The default value if the parameter key does not exist
     * @param bool $default If true, a path like foo[bar] will find deeper items
     */
    public function get( $name, $default = null, $deep = false )
    {
        return $this->parameters->get( $name, $default, $deep );
    }

    /**
     * Sets the value of persistent storage variable
     *
     * @param mixed $value String or Array (of arrays) containing the file extension and related file meta information
     * @param string $name Persistent storage variable name
     */
    public function set( $name, $value )
    {
        $this->parameters->set( $name, $value );
    }

    /**
     * Adds an array of file extension and related meta information into the persistent storage if file extension does not already exist within the persistent storage
     *
     * @param mixed $value String or Array (of arrays) containing the file extension and related file meta information
     * @param string $name Persistent storage variable name
     */
    public function add( $name, $value )
    {
        $this->parameters->add( $name, $value );
    }

    /**
     * Creates a date string with microseconds
     *
     * @param string $format Date function format string
     * @param string $utimestamp Optional timestamp to use in date string creation
     */
    public function udate( $format = 'u', $utimestamp = null )
    {
        if ( is_null( $utimestamp ) )
        {
            $utimestamp = microtime( true );
        }

        $timestamp = floor( $utimestamp );
        $milliseconds = round( ( $utimestamp - $timestamp ) * 1000000 );

        return date( preg_replace( '`(?<!\\\\)u`', $milliseconds, $format ), $timestamp );
    }
}
