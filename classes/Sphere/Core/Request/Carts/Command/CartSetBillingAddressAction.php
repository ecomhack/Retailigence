<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts\Command;

use Sphere\Core\Model\Common\Address;
use Sphere\Core\Request\AbstractAction;

/**
 * Class CartSetBillingAddressAction
 * @package Sphere\Core\Request\Carts\Command
 * @method string getAction()
 * @method CartSetBillingAddressAction setAction(string $action = null)
 * @method Address getAddress()
 * @method CartSetBillingAddressAction setAddress(Address $address = null)
 */
class CartSetBillingAddressAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'address' => [static::TYPE => '\Sphere\Core\Model\Common\Address'],
        ];
    }

    public function __construct()
    {
        $this->setAction('setBillingAddress');
    }
}
