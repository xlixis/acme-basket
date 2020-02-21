<?php
namespace Acme\Basket;

class Offers
{
    /** @var array  */
    private $offers = [];

    public function __construct(array $offers = [])
    {
        $this->setOffers($offers);
    }

    public function getDiscounts(array $items, Products $products)
    {
        $discounts = array();

        /** @var Offer $offer */
        foreach ($this->getOffers() as $offer) {
            $code = $offer->getProductCodeOnOffer();
            switch($offer->getType()) {

                case Offer::TYPE_PERCENT:
                    //Check if the offer is applicable to any product in the basket
                    if(array_key_exists($code, $items)) {
                        //If the offer qualifier matches with the product
                        if($offer->getQualifierQuantity() <= $items[$code]) {
                            $numOfItemsToDiscount = floor($items[$code] / $offer->getQualifierQuantity());
                            //Find the product object
                            /** @var Product $product */
                            $product = $products->getProductByCode($code);
                            //multiply the cost of the product by the offer value
                            $discount = [
                                "product" => $product,
                                "offer" => $offer,
                                "discountAmount" => ($product->getPrice() * $numOfItemsToDiscount * $offer->getValue()),
                            ];
                            array_push($discounts, $discount);
                            //add in a discounts array the discount value

                        }
                    }
                break;

                case Offer::TYPE_FIXED:
                    $discounts = [];
                break;
            }
        }

        return $discounts;

    }

    public function calculateDiscountTotal(array $items, Products $products)
    {
        $discounts = $this->getDiscounts($items, $products);
        $total = 0;
        foreach($discounts as $discount) {
            $total += $discount['discountAmount'];
        }
        return $total;
    }


    /**
     * @param array $offers
     */
    public function setOffers($offers)
    {
        $this->offers = $offers;
    }

    /**
     * @return array
     */
    public function getOffers()
    {
        return $this->offers;
    }
}