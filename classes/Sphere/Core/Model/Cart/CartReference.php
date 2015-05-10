<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Sphere\Core\Model\Cart;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Reference;
use Sphere\Core\Model\Common\ReferenceFromArrayTrait;

/**
 * Class CartReference
 * @package Sphere\Core\Model\Cart
 * @method static CartReference of(string $id)
 * @method string getTypeId()
 * @method CartReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method CartReference setId(string $id = null)
 * @method Cart getObj()
 * @method CartReference setObj(Cart $obj = null)
 */
class CartReference extends Reference
{
    use ReferenceFromArrayTrait;

    const TYPE_CART = 'cart';

    public function getFields()
    {
        return [
            'typeId' => [self::TYPE => 'string'],
            'id' => [self::TYPE => 'string'],
            'obj' => [static::TYPE => '\Sphere\Core\Model\Cart\Cart']
        ];
    }

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(static::TYPE_CART, $id, $context);
    }
}
