# Acme Basket
**Interview test submission**

##Installation

Copy the `acme-basket` into a web accessible path i.e `/var/www/html`
Open your browser and point to your configured `<ServerName>`/acme-basket i.e http://localhost/acme-basket

##Test cases

The ideal solution should contain automated tests and fixtures. 
As I don't actually have experience writing those myself, I have simply coded the 4 test cases within the `index.php`.

You can navigate through each of the test cases using the navigation or simply passing a URL parameter

**Example URLs**

Test Case 1: http://localhost/acme-basket?case=1

Test Case 2: http://localhost/acme-basket?case=2

Test Case 3: http://localhost/acme-basket?case=3

Test Case 4: http://localhost/acme-basket?case=4

##Code structure

This solution is not using the most modern coding practices but I would expect it to follow PSR-12 coding style and PHP7.4 methods

The class structure hopefully is self-explanatory as I kept it very simple. 
I haven't used any particular OO paradigm like Inheritance, Encapsulation, Polymorphism etc...

### Class `Products` 
The product catalog is initialised with 3 `Product` objects with three attributes (name, code, price)  

```
$products = new Products(
    [
        new Product("Red Widget", "R01", 32.95),
        new Product("Green Widget", "G01", 24.95),
        new Product("Blue Widget", "B01", 7.95),
    ]
);
```
### Class `Delivery` 
The delivery object is initialised with an array of the delivery strategy which specifies the Cost based on basket value range.

``` 
$delivery = new delivery(
    [
        ['bottom' => 0, 'top' => 50, 'cost' => 4.95],
        ['bottom' => 51, 'top' => 90, 'cost' => 2.95],
        ['bottom' => 91, 'top' => null, 'cost' => 0],
    ]
);
```


### Class `Offers`
This class represents the collection of available offers as an array of `Offer` objects. 
Each offer has five attributes ($description, $type, $value, $qualifierQuantity, $productCodeOnOffer) 

```
$offers = new Offers(
    [
        new Offer("Buy one get one half price", Offer::TYPE_PERCENT, 0.5, 2, "R01"),
    ]
);
```

The offers class is responsible for the calculation of the discounts.
I am assuming there are two types of Offer (discount). These two types are represented through the constants: TYPE_PERCENT and TYPE_FIXED

For the purpose of this excercise I have only modeled the one required for this example.

**Note:** Offers are modeled to relate to specific products. However if this was done properly the discount logic should be abstracted from the product it applies to by introducing more classes.

### Class `Basket`
As requested in the brief, the basket is initialised with the `Products` catalogue `Offers` and `Delivery` rules.
And has the two methods requested in the brief `add` and `getTotal` in addition to `calculateItemsTotal` which is responsible for returning the total minus the delivery.

