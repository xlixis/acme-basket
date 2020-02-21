<?php
namespace Acme\Basket;


class Product
{

    /** @var string */
    private $name;

    /** @var string */
    private $code;

    /** @var float */
    private $price;


    public function __construct($name, $code, $price)
    {
        $this->setCode($code);
        $this->setName($name);
        $this->setPrice($price);
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
            return $this->name;
    }

    /**
     * @param $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

}