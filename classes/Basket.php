<?php
namespace Acme\Basket;

class Basket
{
    /** @var Products */
    private $products;

    /** @var Delivery */
    private $delivery;

    /** @var Offers */
    private $offers;

    /** @var array */
    private $items = array();

    public function __construct(Products $products, Delivery $delivery, Offers $offers, array $items = [])
    {
        $this->setProducts($products);
        $this->setDelivery($delivery);
        $this->setOffers($offers);
        $this->setItems($items);
     }

    /**
     * @param $code
     * @param int $quantity
     */
    public function add($code, $quantity)
    {
        if(array_key_exists($code, $this->items)) {
            $this->items[$code] += $quantity;
        } else {
            //Append it to the basket
            $this->items[$code] = $quantity;
        }

    }

    /**
     * @return float|int
     */
    public function calculateItemsTotal()
    {
        $total = 0;
        //calculate the total
        foreach($this->items as $code => $quantity) {
            $product = $this->products->getProductByCode($code);
            if($product instanceof Product)
                $total += $product->getPrice() * (int) $quantity;
        }
        $total -= $this->offers->calculateDiscountTotal($this->items, $this->products);
        return $total;
    }

    /**
     * @return int|mixed
     */
    public function getTotal()
    {
        $total = 0;
        $total += $this->calculateItemsTotal();
        //Then calculate shipping on the discounted total
        $total += $this->delivery->calculateDelivery($total);

        return $total;
    }

    /**
     * @param mixed $offers
     */
    public function setOffers($offers)
    {
        $this->offers = $offers;
    }

    /**
     * @param delivery $delivery
     */
    public function setDelivery($delivery)
    {
        $this->delivery = $delivery;
    }

    /**
     * @param mixed $products
     */
    public function setProducts($products)
    {
        $this->products = $products;
    }

    /**
     * @param array $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }
}