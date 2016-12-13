<?php
namespace ProductSearch\Repository;

use ProductSearch\Driver\DriverAdapter;

class DriverProductRepository implements ProductRepository
{
    /**
     * @var DriverAdapter
     */
    private $driverAdapter;

    public function __construct(DriverAdapter $driverAdapter)
    {
        $this->driverAdapter = $driverAdapter;
    }

    /**
     * @param string $id
     * @return array
     */
    public function find($id)
    {
        return $this->driverAdapter->findProduct($id);
    }
}
