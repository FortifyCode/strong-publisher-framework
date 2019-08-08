<?php

namespace FortifyCode\Core;

use ArrayAccess;
use FortifyCode\Contracts\Container as ContainerContract;

class Container implements ArrayAccess, ContainerContract
{
    protected $instances = [];



    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $key Identifier of the entry to look for.
     *
     * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     *
     * @return mixed Entry.
     */
    public function get(string $key) : mixed {
        return $this->offsetGet($key);
    }

    /**
     * Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     *
     * `has($key)` returning true does not mean that `get($id)` will not throw an exception.
     * It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
     *
     * @param string $key Identifier of the entry to look for.
     *
     * @return bool
     */
    public function has(string $key) : bool
    {
        return $this->offsetExists($key);
    }

    public function offsetExists(mixed $key) : bool {
        return isset($this->instances[$key]);
    }

    public function offsetGet(mixed $key) : mixed {
        return $this->instances[$key];
    }

    public function offsetSet(mixed $key, mixed $value) : void {
        $this->instances[$key] = $value;
    }

    public function offsetUnset(mixed $key) : void {
        unset($this->instances[$key]);
    }
}

