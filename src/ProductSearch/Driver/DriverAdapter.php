<?php
namespace ProductSearch\Driver;

interface DriverAdapter
{
    /**
     * @param string $id
     * @return array
     */
    public function findProduct($id);
}
