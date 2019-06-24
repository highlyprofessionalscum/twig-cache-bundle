<?php

namespace highlyprofessionalscum\TwigCacheBundle\Strategy;

use highlyprofessionalscum\TwigCacheBundle\DataCollector\TwigCacheCollector;
use highlyprofessionalscum\Twig\CacheExtension\CacheStrategyInterface;

/**
 * Wrapper used to profile cache usage.
 */
class ProfilerStrategy implements CacheStrategyInterface
{
    /**
     * @var CacheStrategyInterface
     */
    private $cacheStrategy;
    /**
     * @var TwigCacheCollector
     */
    private $dataCollector;

    /**
     * @var int
     */
    private $ttl;

    /**
     * @param CacheStrategyInterface $cacheStrategy
     * @param TwigCacheCollector $dataCollector
     */
    public function __construct(CacheStrategyInterface $cacheStrategy, TwigCacheCollector $dataCollector, $ttl)
    {
        $this->cacheStrategy = $cacheStrategy;
        $this->dataCollector = $dataCollector;
        $dataCollector->setStrategyClass(get_class($cacheStrategy));
    }

    /**
     * Fetch the block for a given key.
     *
     * @param mixed $key
     *
     * @return mixed
     */
    public function fetchBlock($key): ?string
    {
        $output = $this->cacheStrategy->fetchBlock($key);
        $this->dataCollector->addFetchBlock($key, $output);
        return $output;
    }

    /**
     * Generate a key for the value.
     *
     * @param string $annotation
     * @param mixed $value
     *
     * @return mixed
     */
    public function generateKey($annotation, $value): string
    {
        $this->dataCollector->addGenerateKey($annotation, $value);
        return $this->cacheStrategy->generateKey($annotation, $value);
    }

    /**
     * Save the contents of a rendered block.
     *
     * @param mixed $key
     * @param string $block
     *
     * @return mixed
     */
    public function saveBlock($key, $block, $ttl = null): bool
    {
        return $this->cacheStrategy->saveBlock($key, $block, $ttl ?? $this->ttl);
    }
}
