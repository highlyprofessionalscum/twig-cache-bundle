<?php

namespace highlyprofessionalscum\TwigCacheBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;


/**
 * This class validates and merges configuration from your app files.
 *
 * @see http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('twig_cache');
    }
}
