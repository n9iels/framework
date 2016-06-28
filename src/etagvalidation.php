<?php
class ETagValidation
{
    private $container;

    /**
     * ETagValidation constructor.
     *
     * @param  mixed $container  Container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * Generate an ETag
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request       PSR7 request
     * @param  string                                   $lastModified  Last modified datatime
     *
     * @return string
     */
    private function generateEtag($request, $lastModified)
    {
        return md5($request->getUri()->getPath() . $lastModified);
    }

    /**
     * Check if the ETag is valid
     *
     * @param  string  $tag   ETag from request
     * @param  string  $gtag  Generated ETag by the api
     *
     * @return bool
     */
    private function checkEtag($tag, $gtag)
    {
        if ($tag == $gtag) {
            return true;
        }

        return false;
    }

    /**
     * ETag validation
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke($request, $response, $next)
    {
        // Generate tag and check if it is valid
        $etag     = isset($request->getHeader('ETag')[0]) ? $request->getHeader('ETag')[0] : "";
        $gtag     = $this->generateEtag($request, strtotime("28-6-2016 00:00:00"));
        $tagCheck = $this->checkEtag(str_replace('"', '', $etag), $gtag);

        // If ETag is not false, return 304 with generated tag
        if ($tagCheck === true) {
            return $this->container->cache->withEtag($response, $gtag)->withStatus(304);
        }

        $response = $next($request, $response);

        return $this->container->cache->withEtag($response, $gtag);
    }
}