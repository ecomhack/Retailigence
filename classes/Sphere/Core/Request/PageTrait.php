<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 10:39
 */

namespace Sphere\Core\Request;

/**
 * Class PageableTrait
 * @package Sphere\Core\Request
 * @method $this addParam($key, $value)
 */
trait PageTrait
{
    /**
     * @param int $limit
     * @return $this
     */
    public function limit($limit)
    {
        if (!is_null($limit)) {
            $this->addParam('limit', $limit);
        }

        return $this;
    }

    /**
     * @param int $offset
     * @return $this
     */
    public function offset($offset)
    {
        if (!is_null($offset)) {
            $this->addParam('offset', $offset);
        }

        return $this;
    }
}
