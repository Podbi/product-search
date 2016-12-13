<?php
namespace ProductSearch\Cache;

interface ProductCache
{
    public function hasProduct(string $id) : bool;

    public function loadProduct(string $id);

    public function saveProduct(string $id, $product);
}
