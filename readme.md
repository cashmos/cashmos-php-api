## PHP API for Cashmos Payments
The is the official PHP SDK for Cashmos Payment Processing.

### Installation
The SDK can be easily installed using [composer](https://getcomposer.org/).
To install, run the following command on your terminal or command 
prompt on Windows
(make sure composer is installed and available in your project directory).

 ~~~~
 composer require cashmos/cashmos-php-api
 ~~~~

 If you don't want to use composer, you may directly download a zip
 file from among the releases.
 
### Authentication & Cashmos Services
To consume any of the services offered by this SDK, you'll need the
``client id`` and ``secret`` for your business account. These can be viewed under the 
API tab of your business screen of Cashmos online.
Create a business at [Cashmos.com](https://cashmos.herokuapp.com) if
you don't already have an account.

 ```php
$cashmos = new Cashmos\Cashmos($clientId, $secret);
```
 
### Order Processing
Use the following steps to process an order with Cashmos:

I. Create an order:
 ~~~~php
   $order = new Cashmos\Services\Order\Order();
    
   // Add items to order
   
   $order->addItem(
        new Cashmos\Services\Order\Item($name, $unitPrice, $quantity, $description),
   );
    
   $order->addItem(
       new Cashmos\Services\Order\Item($name2, $unitPrice2, $quantity2, $description2),
   );
   
   
   // Set order total.
   // Note that this is the total amount to be charged to the user.
   // Cashmos does not do any item level calculations for total amount.
   
   $order->setOrderTotal($orderTotal)
   
   
   // Set return and cancel urls
   
   $order->returnUrl(https://business.com/paid); // Url when payment authorization was successful.
   $order->cancelUrl(https://business.com/canceled); // Url when payment authorization was canceled.
  ~~~~

II. Process Order Authorization:
   
   This step allows the user to choose their payment method and provide
   authorization for the purchase. However, the user's is NOT actually charged.
   Use the next step to confirm the order and actually charge the user. 
 ~~~~php
    $cashmos = new Cashmos\Cashmos($clientId, $secret);
    $cashmos->process($order);
 ~~~~   
 
 If the user authorizes the payment, Cashmos will return to the "returnUrl" provided
 with a payment token as a query parameter (?token="random-token"). This payment token is used to confirm the payment.

III. Confirm Order:
   ```php
    $confirmation = new Cashmos\Services\Order\OrderConfirmation($token);
    $cashmos = new Cashmos\Cashmos($clientId, $secret);
    
    if($cashmos->process($confirmation)){
        // Order confirmed successfully.
    }else{
        // There was an error with order confirmation
        echo $cashmos->getError();
    }
   ```

### Prerequisites
* PHP 5.3 or above
* [curl](https://secure.php.net/manual/en/book.curl.php) and
[openssl](https://secure.php.net/manual/en/book.openssl.php)
extensions.

### Security Vulnerabilities
If you discover a security vulnerability in this API, 
please email the details of the vulnerability to 
[technical@omnile.com](mailto:technical@omnile.com).

### License

