<?php
namespace Acme\Basket;

class Products
{
    /** @var array  */
    private $products = [];

    /**
     * Initialises a catalogue of products. This would normally be fetch from a DB.
     *
     * Products constructor.
     * @param array $products
     */
    public function __construct(array $products)
    {
        $this->products = $products;
    }

    /**
     * @return array
     */
    public function getProducts() {
        return $this->products;
    }

    /**
     * @param $code
     * @return mixed
     */
    public function getProductByCode($code)
    {
        foreach($this->products as $key => $product) {
            if($product->getCode() == $code) {
                return $product;
            }
        }

        return false;
    }

}