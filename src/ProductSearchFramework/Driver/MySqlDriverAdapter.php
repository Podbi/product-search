<?php
namespace ProductSearchFramework\Driver;

use \ProductSearch\Driver\DriverAdapter;

class MySqlDriverAdapter implements DriverAdapter
{
    /**
     * @var \IMySQLDriver
     */
    private $mySqlDriver;

    public function __construct(\IMySQLDriver $mySqlDriver)
    {
        $this->mySqlDriver = $mySqlDriver;
    }

    public function findProduct($id)
    {
        return $this->mySqlDriver->findProduct($id);
    }
}
