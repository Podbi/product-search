<?php
namespace ProductSearchFramework\Driver;

use ProductSearch\Driver\DriverAdapter;

class ElasticSearchDriverAdapter implements DriverAdapter
{
    /**
     * @var \IElasticSearchDriver
     */
    private $elasticSearchDriver;

    public function __construct(\IElasticSearchDriver $elasticSearchDriver)
    {
        $this->elasticSearchDriver = $elasticSearchDriver;
    }

    public function findProduct($id)
    {
        return $this->elasticSearchDriver->findById($id);
    }
}
