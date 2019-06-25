<?php

namespace highlyprofessionalscum\TwigCacheBundle\DependencyInjection;

use highlyprofessionalscum\TwigCacheBundle\DataCollector\TwigCacheCollector;
use highlyprofessionalscum\TwigCacheBundle\Strategy\ProfilerStrategy;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class TwigCacheExtension extends Extension
{

    public function load(array $config, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $config);
        $container->setAlias('twig_cache.service', $config['service']);
        $container->setAlias('twig_cache.strategy.key_generator', $config['key_generator']);
        $loader = new Loader\YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );

        $loader->load('services.yaml');
        $strategy = new Reference($config['strategy']);

        if ($config['profiler']) {
            $dataCollectorDefinition = new Definition(TwigCacheCollector::class);
            $dataCollectorDefinition->addTag('data_collector', [
                'id' => 'twig_cache',
                'template' => 'TwigCacheBundle:Collector:twig_cache',
            ]);
            $container->setDefinition(TwigCacheCollector::class, $dataCollectorDefinition);
            $strategy = new Definition(ProfilerStrategy::class, [
                new Reference($config['strategy']),
                new Reference(TwigCacheCollector::class),
                $config['default_ttl'],
            ]);
            $container->addDefinitions([$strategy]);
        }

        $container->getDefinition('twig_cache.extension')->replaceArgument(0, $strategy);
    }

}
