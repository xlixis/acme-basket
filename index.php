<?php
namespace Acme\Basket;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', "1");

include_once('classes/Basket.php');
include_once('classes/Product.php');
include_once('classes/Products.php');
include_once('classes/Delivery.php');
include_once('classes/Offers.php');
include_once('classes/Offer.php');

$products = new Products(
    [
        new Product("Red Widget", "R01", 32.95),
        new Product("Green Widget", "G01", 24.95),
        new Product("Blue Widget", "B01", 7.95),
    ]
);
$delivery = new delivery(
    [
        ['bottom' => 0, 'top' => 50, 'cost' => 4.95],
        ['bottom' => 51, 'top' => 90, 'cost' => 2.95],
        ['bottom' => 91, 'top' => null, 'cost' => 0],
    ]
);
$offers = new Offers(
    [
        new Offer("Buy one get one half price", Offer::TYPE_PERCENT, 0.5, 2, "R01"),
    ]
);

$basket = new basket($products, $delivery, $offers);

$case = isset($_GET['case']) ? $_GET['case'] : 1;
switch($case) {
    case 1:
        $basket->add("B01", 1);
        $basket->add("G01", 1);
        break;
    case 2:
        $basket->add("R01", 2);
        break;
    case 3:
        $basket->add("R01", 1);
        $basket->add("G01", 1);
        break;
    case 4:
        $basket->add("R01", 1);
        $basket->add("R01", 1);
        $basket->add("R01", 1);
        $basket->add("B01", 1);
        $basket->add("B01", 1);
        break;
}


echo "<h1>Acme Basket - Test Case {$case}</h1>";
echo "<table>";
echo "<tr><th></th></th><th>Product Name</th><th>Code</th><th>Quantity</th><th>Unit Price</th><th>Price</th></tr>";
echo "<tr><td colspan='6'><strong>Items:</strong></td></tr>";
foreach ($basket->getItems() as $key => $quantity) {
    /** @var Product $product */
    $product = $products->getProductByCode($key);
    $productTotalCost = ($product->getPrice() * $quantity);
    echo "<tr><td></td><td>{$product->getName()}</td> <td>{$key}</td> <td>x{$quantity}</td> <td>&#36;{$product->getPrice()}</td> <td>&#36;{$productTotalCost}</td></tr>";
}
$discounts = $offers->getDiscounts($basket->getItems(), $products);
echo "<tr><td colspan='6'><strong>Discounts:</strong></td></tr>";
foreach ($discounts as $key => $discount) {
    echo "<tr><td>{$discount['offer']->getDescription()} </td><td>{$discount['product']->getName()}</td> <td>{$discount['product']->getCode()} </td> <td></td><td></td> <td> -&#36;{$discount['discountAmount']}</td></tr>";
}


$basketTotal = $basket->getTotal();
echo "<tr><td><strong>Items Total:</strong></td><td colspan='4'></td><td>&#36;{$basket->calculateItemsTotal()}</td></tr>";
echo "<tr><td><strong>Delivery:</strong></td><td colspan='4'></td><td>&#36;{$delivery->calculateDelivery($basket->calculateItemsTotal())}</td></tr>";
echo "<tr><td><strong>Basket Total:</strong></td><td colspan='4'></td><td><strong>&#36;{$basketTotal}</strong></td></tr>";


echo "</table>";



