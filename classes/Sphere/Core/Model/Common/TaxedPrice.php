<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


/**
 * Class TaxedPrice
 * @package Sphere\Core\Model\Common
 * @method Money getTotalNet()
 * @method TaxedPrice setTotalNet(Money $totalNet = null)
 * @method Money getTotalGross()
 * @method TaxedPrice setTotalGross(Money $totalGross = null)
 * @method TaxPortionCollection getTotalPortions()
 * @method TaxedPrice setTotalPortions(TaxPortionCollection $totalPortions = null)
 */
class TaxedPrice extends JsonObject
{
    public function getFields()
    {
        return [
            'totalNet' => [static::TYPE => '\Sphere\Core\Model\Common\Money'],
            'totalGross' => [static::TYPE => '\Sphere\Core\Model\Common\Money'],
            'totalPortions' => [static::TYPE => '\Sphere\Core\Model\Common\TaxPortionCollection'],
        ];
    }
}
