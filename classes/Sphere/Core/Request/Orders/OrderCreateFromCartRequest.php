<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Orders;


use GuzzleHttp\Message\ResponseInterface;
use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Client\HttpRequestInterface;
use Sphere\Core\Client\JsonRequest;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractApiRequest;
use Sphere\Core\Response\AbstractApiResponse;
use Sphere\Core\Response\SingleResourceResponse;

/**
 * Class OrderCreateFromCartRequest
 * @package Sphere\Core\Request\Orders
 */
class OrderCreateFromCartRequest extends AbstractApiRequest
{
    const ID = 'id';
    const VERSION = 'version';
    const ORDER_NUMBER = 'orderNumber';
    const PAYMENT_STATE = 'paymentState';

    protected $cartId;
    protected $version;
    protected $orderNumber;
    protected $paymentState;

    protected $resultClass = '\Sphere\Core\Model\Order\Order';

    /**
     * @return mixed
     */
    public function getCartId()
    {
        return $this->cartId;
    }

    /**
     * @param $cartId
     * @return $this
     */
    public function setCartId($cartId)
    {
        $this->cartId = $cartId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param $version
     * @return $this
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * @param $orderNumber
     * @return $this
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaymentState()
    {
        return $this->paymentState;
    }

    /**
     * @param $paymentState
     * @return $this
     */
    public function setPaymentState($paymentState)
    {
        $this->paymentState = $paymentState;

        return $this;
    }

    /**
     * @param string $cartId
     * @param int $version
     * @param Context $context
     */
    public function __construct($cartId, $version, Context $context = null)
    {
        parent::__construct(OrdersEndpoint::endpoint(), $context);
        $this->setCartId($cartId)->setVersion($version);
    }

    /**
     * @param ResponseInterface $response
     * @return AbstractApiResponse
     * @internal
     */
    public function buildResponse(ResponseInterface $response)
    {
        return new SingleResourceResponse($response, $this, $this->getContext());
    }

    /**
     * @return HttpRequestInterface
     * @internal
     */
    public function httpRequest()
    {
        $payload = [
            static::ID => $this->cartId,
            static::VERSION => $this->version,
        ];
        if (!is_null($this->paymentState)) {
            $payload[static::PAYMENT_STATE] = $this->paymentState;
        }
        if (!is_null($this->orderNumber)) {
            $payload[static::ORDER_NUMBER] = $this->orderNumber;
        }
        return new JsonRequest(HttpMethod::POST, $this->getPath(), $payload);
    }
}
