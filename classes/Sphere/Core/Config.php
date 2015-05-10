<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 20.01.15, 17:54
 */

namespace Sphere\Core;


use Sphere\Core\Cache\CacheAdapterInterface;
use Sphere\Core\Error\Message;
use Sphere\Core\Error\InvalidArgumentException;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\ContextAwareInterface;
use Sphere\Core\Model\Common\ContextTrait;

/**
 * Class Config
 * @package Sphere\Core
 */
class Config implements ContextAwareInterface
{
    use ContextTrait;

    const OAUTH_URL = 'oauth_url';
    const CLIENT_ID = 'client_id';
    const CLIENT_SECRET = 'client_secret';
    const PROJECT = 'project';
    const API_URL = 'api_url';

    /**
     * @var string
     */
    protected $clientSecret;

    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $project;

    /**
     * @var string
     */
    protected $oauthUrl = 'https://auth.sphere.io/oauth/token';

    /**
     * @var string
     */
    protected $apiUrl = 'https://api.sphere.io';

    /**
     * @param array $config
     * @return $this
     */
    public function fromArray(array $config)
    {
        array_walk(
            $config,
            function ($value, $key) {
                $functionName = 'set' . $this->camelize($key);
                if (!is_callable([$this, $functionName])) {
                    throw new InvalidArgumentException(sprintf(Message::SETTER_NOT_IMPLEMENTED, $key));
                }
                $this->$functionName($value);
            }
        );

        return $this;
    }

    protected function camelize($scored)
    {
        return lcfirst(
            implode(
                '',
                array_map(
                    'ucfirst',
                    array_map(
                        'strtolower',
                        explode('_', $scored)
                    )
                )
            )
        );
    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @param string $clientSecret
     * @return $this
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;

        return $this;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     * @return $this
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * @return string
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @param string $project
     * @return $this
     */
    public function setProject($project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * @return string
     */
    public function getOauthUrl()
    {
        return $this->oauthUrl;
    }

    /**
     * @param string $oauthUrl
     * @return $this
     */
    public function setOauthUrl($oauthUrl)
    {
        $this->oauthUrl = $oauthUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * @param string $apiUrl
     */
    public function setApiUrl($apiUrl)
    {
        $this->apiUrl = $apiUrl;
    }

    /**
     * @return bool
     */
    public function check()
    {
        if (is_null($this->getClientId())) {
            throw new InvalidArgumentException(Message::NO_CLIENT_ID);
        }

        if (is_null($this->getClientSecret())) {
            throw new InvalidArgumentException(Message::NO_CLIENT_SECRET);
        }

        if (is_null($this->getProject())) {
            throw new InvalidArgumentException(Message::NO_PROJECT_ID);
        }

        return true;
    }
}
