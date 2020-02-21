<?php
namespace Acme\Basket;


class Delivery
{
    /** @var array  */
    private $values = [];

    /**
     * Delivery constructor.
     * @param array $values
     */
    public function __construct(array $values)
    {
        $this->setValues($values);
    }

    /**
     * @param $basketValue
     * @return mixed
     */
    public function calculateDelivery($basketValue)
    {
        foreach($this->getValues() as $key => $value) {
            if(($basketValue < $value['top'] || is_null($value['top'])) && $basketValue > $value['bottom'])
                return $value['cost'];
        }

    }

    /**
     * @param array $values
     */
    public function setValues($values)
    {
        $this->values = $values;
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return $this->values;
    }


}