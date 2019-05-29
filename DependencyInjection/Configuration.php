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
        $treeBuilder = new TreeBuilder('twig_cache');

        $treeBuilder->getRootNode()
                ->children()
                    ->booleanNode('profiler')
                    ->defaultValue('%kernel.debug%')
                    ->info('')
                ->end()
                ->scalarNode('service')
                    ->cannotBeEmpty()
                    ->isRequired()
                    ->info('')
                ->end()
                ->scalarNode('strategy')
                    ->cannotBeEmpty()
                    ->defaultValue('twig_cache.strategy')
                    ->info('')
                ->end()
                ->scalarNode('key_generator')
                    ->cannotBeEmpty()
                    ->defaultValue('twig_cache.strategy.spl_object_hash_key_generator')
                    ->info('')
                ->end()
            ->end()
        ;


        return $treeBuilder;
    }
}
