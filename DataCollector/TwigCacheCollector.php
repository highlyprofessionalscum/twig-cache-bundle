<?php
namespace highlyprofessionalscum\TwigCacheBundle\DataCollector;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollectorInterface;

class TwigCacheCollector implements DataCollectorInterface
{
    /**
     * Cache hits.
     *
     * @var int
     */
    private $hits = 0;

    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
    }

    public function addFetchBlock(){}
    public function addGenerateKey(){}

    public function setStrategyClass()
    {

    }

    /**
     * Get data stored in this profiler.
     *
     * @return array
     */
    public function getData() : array
    {
        return [
            'hits' => $this->hits,
        ];
    }

    /**
     * @return string The collector name
     */
    public function getName() : string
    {
        return 'qa3tq35t13';
    }

    /**
     * Reset profiler data.
     */
    public function reset()
    {
        $this->hits = 0;
    }
}