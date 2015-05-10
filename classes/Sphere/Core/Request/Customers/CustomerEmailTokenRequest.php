<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 12.02.15, 12:34
 */

namespace Sphere\Core\Request\Customers;

use GuzzleHttp\Message\ResponseInterface;
use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Client\JsonRequest;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractUpdateRequest;
use Sphere\Core\Response\SingleResourceResponse;

/**
 * Class CustomerEmailTokenRequest
 * @package Sphere\Core\Request\Customers
 * @method static CustomerEmailTokenRequest of(string $id, int $version, int $ttlMinutes)
 */
class CustomerEmailTokenRequest extends AbstractUpdateRequest
{
    const ID = 'id';
    const TTL_MINUTES = 'ttlMinutes';

    protected $resultClass = '\Sphere\Core\Model\Customer\CustomerToken';

    /**
     * @var int
     */
    protected $ttlMinutes;

    /**
     * @param string $id
     * @param int $version
     * @param int $ttlMinutes
     * @param Context $context
     */
    public function __construct($id, $version, $ttlMinutes, Context $context = null)
    {
        parent::__construct(CustomersEndpoint::endpoint(), $id, $version, [], $context);
        $this->setId($id);
        $this->setVersion($version);
        $this->ttlMinutes = $ttlMinutes;
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/email-token';
    }

    /**
     * @return JsonRequest
     * @internal
     */
    public function httpRequest()
    {
        $payload = [
            static::ID => $this->getId(),
            static::VERSION => $this->getVersion(),
            static::TTL_MINUTES => $this->ttlMinutes,
        ];
        return new JsonRequest(HttpMethod::POST, $this->getPath(), $payload);
    }
}
