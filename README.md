BC Page Data
===================

This bundle implements a solution to provide request persistent variable storage service. Provides a symfony based replacement for the legacy ezpagedata operator.

Version
=======

* The current version of BC Page Data is 0.1.0

* Last Major update: May 19, 2015


Copyright
=========

* BC Page Data is copyright 1999 - 2015 Brookins Consulting and 2013 - 2015 Think Creative

* See: [COPYRIGHT.md](COPYRIGHT.md) for more information on the terms of the copyright and license


License
=======

BC Document Reader is licensed under the GNU General Public License.

The complete license agreement is included in the [LICENSE](LICENSE) file.

BC Document Reader is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License or at your
option a later version.

BC Document Reader is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

The GNU GPL gives you the right to use, modify and redistribute
BC Document Reader under certain conditions. The GNU GPL license
is distributed with the software, see the file doc/LICENSE.

It is also available at [http://www.gnu.org/licenses/gpl.txt](http://www.gnu.org/licenses/gpl.txt)

You should have received a copy of the GNU General Public License
along with BC Document Reader in doc/LICENSE.  If not, see [http://www.gnu.org/licenses/](http://www.gnu.org/licenses/).

Using BC Document Reader under the terms of the GNU GPL is free (as in freedom).

For more information or questions please contact: license@brookinsconsulting.com


Requirements
============

The following requirements exists for using BC Page Data extension:


### eZ Publish version

* Make sure you use eZ Publish version 5.x (required) or higher.

* Designed and tested with eZ Publish Community Project 2013.11


### PHP version

* Make sure you have PHP 5.x or higher.


Features
========

### Dependencies

* This solution does not depend on eZ Publish Legacy in any way


### Twig operators

This solution provides the following twig filter.

* Twig Filter: `bc_pagedata` - Used within template overrides to access variable content from the persistent (page data) service.


### Services

* The `brookinsconsulting.page_data_persistence` service can be used to get persistent storage variables or add variables into the request variable persistent storage provided within this bundle.


Installation
============

### Bundle Installation via Composer

Run the following command from your project root to install the bundle:

    bash$ composer require brookinsconsulting/bcpagedatabundle dev-master;


### Bundle Activation

Within file `ezpublish/EzPublishKernel.php` at the bottom of the `use` statements, add the following lines.

    use BrookinsConsulting\BcPageDataBundle\BcPageDataBundle;


Within file `ezpublish/EzPublishKernel.php` method `registerBundles` add the following into the `$bundles = array(` variable definition.

    new BrookinsConsulting\BcPageDataBundle\BcPageDataBundle(),

### Clear the caches

Clear eZ Publish Platform / eZ platfrom caches (Required).

    php ezpublish/console cache:clear;


Usage
=====

The solution is configured to work virtually by default once properly installed.

You can use the twig filter `bc_pagedata` within your own twig templates to access persistent variables.

You can use the `brookinsconsulting.page_data_persistence` service within your own custom PHP code to get persistent storage variables or add variables into the persistent storage.

    $pageDataPersistence = $this->container->get('brookinsconsulting.page_data_persistence');
    // Access persistent storage
    if( $this->pageDataPersistence->has( 'document_readers' ) )
    {
        $this->documentReaders = $this->pageDataPersistence->get( 'document_readers' );
    }
    else
    {
        $this->set( array(), 'document_readers' );
        $this->documentReaders = $this->pageDataPersistence->get( 'document_readers' );
    }


Troubleshooting
===============

### Read the FAQ

Some problems are more common than others. The most common ones are listed in the the [doc/FAQ.md](doc/FAQ.md)


### Support

If you have find any problems not handled by this document or the FAQ you can contact Brookins Consulting through the support system: [http://brookinsconsulting.com/contact](http://brookinsconsulting.com/contact)

