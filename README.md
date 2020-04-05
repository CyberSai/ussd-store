# UssdStore
[![Packagist Version](https://img.shields.io/packagist/v/cybersai/ussd-store?style=for-the-badge)](https://packagist.org/packages/cybersai/ussd-store)
[![Travis (.com)](https://img.shields.io/travis/cybersai/ussd-store?style=for-the-badge)](https://travis-ci.com/cybersai/ussd-store)
[![GitHub repo size](https://img.shields.io/github/repo-size/cybersai/ussd-store?style=for-the-badge)](https://github.com/CyberSai/ussd-store)
![GitHub](https://img.shields.io/github/license/cybersai/ussd-store?style=for-the-badge)

A simple key-value store to save data in an array and serialized them so they can be stored in the database as text.

No Real Documentaion for now, but for now you can [read the tests](https://github.com/cybersai/ussd-store/blob/master/tests/UssdStoreTest.php).

```php
include 'vendor/autoload.php';

use Cybersai\UssdStore\UssdStore;

$store = UssdStore(['name' => 'Ussd App']); // Can initialized it with options data
$store(['phone' => '0545123456']); // Can set data by invoking with array
$store->account_number = '03011231231321'; // can set data using dynamic properties
$store->set('user_type', 'registered'); // can set data explicitlly

echo $store->get('name'); // can retrieve data with one of the few available methods
print_r($store->toArray()); // get all data as array key-value pair

```

## Installation
`composer require cybersai/ussd-store`
