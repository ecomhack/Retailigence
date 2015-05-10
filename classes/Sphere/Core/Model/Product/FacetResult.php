<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Common\JsonObject;

/**
 * Class FacetResult
 * @package Sphere\Core\Model\Product
 * @method string getType()
 * @method FacetResult setType(string $type = null)
 * @method int getMissing()
 * @method FacetResult setMissing(int $missing = null)
 * @method int getTotal()
 * @method FacetResult setTotal(int $total = null)
 * @method int getOther()
 * @method FacetResult setOther(int $other = null)
 * @method FacetTermCollection getTerms()
 * @method FacetResult setTerms(FacetTermCollection $terms = null)
 * @method FacetRangeCollection getRanges()
 * @method FacetResult setRanges(FacetRangeCollection $ranges = null)
 */
class FacetResult extends JsonObject
{
    public function getFields()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'missing' => [static::TYPE => 'int'],
            'total' => [static::TYPE => 'int'],
            'other' => [static::TYPE => 'int'],
            'terms' => [static::TYPE => '\Sphere\Core\Model\Product\FacetTermCollection'],
            'ranges' => [static::TYPE => '\Sphere\Core\Model\Product\FacetRangeCollection']
        ];
    }
}
