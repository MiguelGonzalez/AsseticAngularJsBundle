<?php

/*
 * This file is part of the AsseticAngularJsBundle package.
 *
 * (c) Pascal Kuendig <padakuro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Miguel\AsseticAngularJsBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class MiguelAsseticAngularJsExtension extends Extension {
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container) {
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $configuration = $this->getConfiguration($configs, $container);

        $config = $this->processConfiguration($configuration, $configs);

        $container->setAlias(
            'miguel_assetic_angular_js.template_name_formatter',
            'miguel_assetic_angular_js.template_name_formatter.default'
        );
        
        $loader->load('assetic.xml');

        $container->setParameter('assetic.filter.angular.app_name',
                $config['app_name']);
    }
}
