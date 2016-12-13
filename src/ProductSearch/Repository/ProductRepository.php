<?php
namespace ProductSearch\Repository;

interface ProductRepository
{
    /**
     * @param string $id
     * @return array
     */
    public function find($id);
}
