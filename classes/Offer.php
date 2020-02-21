<?php
namespace Acme\Basket;


class Offer
{
    const TYPE_PERCENT = 1;
    const TYPE_FIXED = 2;

    /** @var string */
    private $description;

    /** @var integer */
    private $type;

    /** @var integer */
    private $qualifierQuantity;

    /** @var float */
    private $value;

    /** @var string */
    private $productCodeOnOffer;

    public function __construct($description, $type, $value, $qualifierQuantity, $productCodeOnOffer)
    {
        $this->setValue($value);
        $this->setDescription($description);
        $this->setType($type);
        $this->setQualifierQuantity((int) $qualifierQuantity);
        $this->setProductCodeOnOffer($productCodeOnOffer);
    }


    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $qualifierQuantity
     */
    public function setQualifierQuantity($qualifierQuantity)
    {
        $this->qualifierQuantity = $qualifierQuantity;
    }

    /**
     * @return mixed
     */
    public function getQualifierQuantity()
    {
        return $this->qualifierQuantity;
    }

    /**
     * @param mixed $productCodeOnOffer
     */
    public function setProductCodeOnOffer($productCodeOnOffer)
    {
        $this->productCodeOnOffer = $productCodeOnOffer;
    }

    /**
     * @return mixed
     */
    public function getProductCodeOnOffer()
    {
        return $this->productCodeOnOffer;
    }
}