<?php

namespace Cybersai\UssdStore\Tests;

use Cybersai\UssdStore\UssdStore;
use PHPUnit\Framework\TestCase;

class UssdStoreTest extends TestCase
{
    public function testCanBeInitialized()
    {
        $this->assertInstanceOf(UssdStore::class, new UssdStore);
    }

    public function testCanBeInitializedWithAnArray()
    {
        $this->assertInstanceOf(UssdStore::class, new UssdStore(['mango' => 'sweet']));
    }

    public function testCanBeConvertedToArray()
    {
        $this->assertIsArray((new UssdStore())->toArray());
    }

    public function testCanAddElement()
    {
        $store = new UssdStore;
        $store->set('key','value');
        $this->assertArrayHasKey('key', $store->toArray());
    }

    public function testAddingElementsWithSameKeyOverridesOldValues()
    {
        $store = new UssdStore(['key' => 'value']);
        $store->set('key', 'new value');
        $this->assertEquals('new value', $store->get('key'));
    }

    public function testCanRetrieveElement()
    {
        $store = new UssdStore(['key' => 'value']);
        $this->assertEquals('value', $store->get('key'));
    }

    public function testMissingElementsReturnNull()
    {
        $store = new UssdStore(['key' => 'value']);
        $this->assertNull($store->get('new_key'));
    }

    public function testCanRemoveElement()
    {
        $store = new UssdStore(['key' => 'value']);
        $store->unset('key');
        $this->assertNull($store->get('key'));
    }

    public function testCanBeSerializedAndUnSerialized()
    {
        $store = new UssdStore(['key' => 'value']);
        $serialized = serialize($store);
        $this->assertIsString($serialized);
        $unserialized = unserialize($serialized);
        $this->assertInstanceOf(UssdStore::class, $unserialized);
        $this->assertArrayHasKey('key', $unserialized->toArray());
    }

    public function testCanBeConvertedToString()
    {
        $store = new UssdStore(['key' => 'value']);
        $this->assertIsString($store->__toString());
    }

    public function testKeysCanSetDynamically()
    {
        $store = new UssdStore;
        $store->key = 'value';
        $this->assertArrayHasKey('key', $store->toArray());
    }

    public function testKeysCanRetrievedDynamically()
    {
        $store = new UssdStore(['key' => 'value']);
        $this->assertEquals('value', $store->key);
    }

    public function testCanRemoveElementsDynamically()
    {
        $store = new UssdStore(['key' => 'value']);
        unset($store->key);
        $this->assertArrayNotHasKey('key', $store->toArray());
    }

    public function testCanBeInvokedToGetValuesUsingString()
    {
        $store = new UssdStore(['key' => 'value']);
        $this->assertEquals('value', $store('key'));
    }

    public function testCanBeInvokedToSetPropertiesUsingArray()
    {
        $store = new UssdStore;
        $store(['key' => 'value']);
        print_r($store->toArray());
        $this->assertArrayHasKey('key', $store->toArray());
        $this->assertEquals('value', $store->get('key'));
    }

    public function testCanCheckIfValueIsSet()
    {
        $store = new UssdStore(['key' => 'value']);
        $this->assertTrue($store->isset('key'));
    }

    public function testCanCheckIfValueIsSetDynamically()
    {
        $store = new UssdStore(['key' => 'value']);
        $this->assertTrue(isset($store->key));
    }

    public function testCanbeParseToAndFromString()
    {
        $store = new UssdStore(['key' => 'value']);
        $string = (string)$store;
        echo $string;
        $new_store = UssdStore::parse($string);
        $this->assertArrayHasKey('key', $new_store->toArray());
    }
}
