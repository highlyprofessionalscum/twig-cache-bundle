<?php
namespace  highlyprofessionalscum\TwigCacheBundle\KeyGenerator;

use highlyprofessionalscum\Twig\CacheExtension\KeyGeneratorInterface;
/**
 * Key generator based on spl_object_hash.
 *
 * @see https://github.com/asm89/twig-cache-extension#setup-1
 */
class SplObjectHashKeyGenerator implements KeyGeneratorInterface
{
    /**
     * Generate a cache key for a given value.
     *
     * @param mixed $value cached value
     *
     * @return string
     */
    public function generateKey($value) : string
    {
        if (!is_object($value)) {
            $value = (object) $value;
        }

        return spl_object_hash($value);
    }
}
