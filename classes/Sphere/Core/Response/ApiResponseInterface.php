<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 28.01.15, 10:07
 */
namespace Sphere\Core\Response;

use Sphere\Core\Request\ClientRequestInterface;

/**
 * Interface ApiResponseInterface
 * @package Sphere\Core\Http
 */
interface ApiResponseInterface
{
    public function toObject();

    public function toArray();

    public function getBody();

    public function isError();

    /**
     * @return \GuzzleHttp\Message\ResponseInterface
     */
    public function getResponse();

    /**
     * @return ClientRequestInterface
     */
    public function getRequest();
}
