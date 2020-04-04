<?php

namespace Cybersai\UssdStore;

class UssdStore
{
    protected $store;

    public function __construct(array $store = [])
    {
        $this->store = $store;
    }

    public function toArray(): array
    {
        return $this->store;
    }

    public function set(string $key, $value): void
    {
        $this->store[$key] = $value;
    }

    public function get(string $key)
    {
        if (array_key_exists($key, $this->store)) {
            return $this->store[$key];
        }
        return null;
    }

    public function isset(string $key): bool
    {
        return isset($this->store[$key]);
    }

    public function unset(string $key): void
    {
        if (array_key_exists($key, $this->store)) {
            unset($this->store[$key]);
        }
    }

    public static function parse(string $data): UssdStore
    {
        return unserialize(base64_decode($data));
    }

    public function __serialize(): array
    {
        return $this->store;
    }

    public function __unserialize(array $data): void
    {
        $this->store = $data;
    }

    public function __toString()
    {
        return base64_encode(serialize($this));
    }

    public function __set($name, $value)
    {
        $this->set($name, $value);
    }

    public function __get($name)
    {
        return $this->get($name);
    }

    public function __isset($name)
    {
        return $this->isset($name);
    }

    public function __unset($name)
    {
        return $this->unset($name);
    }

    public function __invoke($argument)
    {
        if (is_string($argument)) {
            return $this->get($argument);
        } else if (is_array($argument)) {
            $this->store = array_merge($this->store, $argument);
        }
    }
}
