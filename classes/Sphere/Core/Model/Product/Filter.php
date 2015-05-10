<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\OfTrait;

/**
 * Class Filter
 * @package Sphere\Core\Model\Product
 * @method getValue()
 * @method Filter setValue($value = null)
 * @method string getAlias()
 * @method Filter setAlias(string $alias = null)
 * @method string getName()
 * @method Filter setName(string $name = null)
 */
class Filter extends JsonObject
{
    use OfTrait;

    protected $valueType;

    public function __construct($valueType = null)
    {
        if (is_null($valueType)) {
            $valueType = 'string';
        }
        $this->valueType = $valueType;
    }

    public function getFields()
    {
        return [
            'name' => [static::TYPE => 'string'],
            'value' => [static::TYPE => $this->valueType],
            'alias' => [static::TYPE => 'string']
        ];
    }

    protected function valueToString($value)
    {
        if (is_numeric($value)) {
            return $value;
        }
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }
        if (is_string($value)) {
            return '"' . $value . '"';
        }
        if (is_array($value)) {
            $values = array_map([$this, 'valueToString'], $value);
            return implode(",", $values);
        }
        return (string)$value;
    }

    public function __toString()
    {
        $facet = $this->getName();
        $value = $this->getValue();
        $alias = $this->getAlias();
        if (!is_null($value)) {
            $facet .= ':' . $this->valueToString($value);
        }
        if ($alias) {
            $facet .= ' as ' . $alias;
        }

        return $facet;
    }
}
