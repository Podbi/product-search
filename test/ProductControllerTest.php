<?php
use \Cache\Adapter\Common\AbstractCachePool;
use \League\Flysystem\FilesystemInterface;
use \ProductSearch\Repository\CachedProductRepository;
use \ProductSearch\Repository\DriverProductRepository;
use \ProductSearch\RequestRecorder\ProductRepositoryRequestRecorderDecorator;
use \ProductSearchFramework\Cache\FilesystemProductCache;
use \ProductSearchFramework\Cache\FilesystemProductCacheItemTransformer;
use \ProductSearchFramework\Driver\ElasticSearchDriverAdapter;
use \ProductSearchFramework\Json\JsonParser;
use \ProductSearchFramework\RequestRecorder\FileProductRequestRecorderRepository;
use \ProductSearchFramework\RequestRecorder\JsonProductRequestRecorder;
use \ProductSearchFramework\ResponseFactory\JsonResponseFactory;
use \Prophecy\Argument;
use \Prophecy\Prophecy\ObjectProphecy;
use \Psr\Cache\CacheItemInterface;

class ProductControllerTest extends \PHPUnit_Framework_TestCase
{
    const PRODUCT_REQUEST_RECORDER_FILE_NAME = 'product_request_count.json';

    /**
     * @var ProductController
     */
    private $controller;

    /**
     * @var AbstractCachePool|ObjectProphecy $cachePool
     */
    private $cachePool;

    /**
     * @var IElasticSearchDriver|ObjectProphecy $elasticSearchDriver
     */
    private $elasticSearchDriver;

    /**
     * @var FilesystemInterface|ObjectProphecy $filesystem
     */
    private $filesystem;

    public function setUp()
    {
        $this->cachePool = $this->prophesize(AbstractCachePool::class);
        $this->elasticSearchDriver = $this->prophesize(IElasticSearchDriver::class);
        $this->filesystem = $this->prophesize(FilesystemInterface::class);

        $this->controller = new ProductController(
            new ProductRepositoryRequestRecorderDecorator(
                new CachedProductRepository(
                    new FilesystemProductCache(
                        $this->cachePool->reveal(),
                        new FilesystemProductCacheItemTransformer()
                    ),
                    new DriverProductRepository(
                        new ElasticSearchDriverAdapter(
                            $this->elasticSearchDriver->reveal()
                        )
                    )
                ),
                new JsonProductRequestRecorder(
                    new FileProductRequestRecorderRepository(
                        $this->filesystem->reveal(),
                        self::PRODUCT_REQUEST_RECORDER_FILE_NAME
                    ),
                    new JsonParser()
                )
            ),
            new JsonResponseFactory(
                new JsonParser()
            )
        );
    }

    public function test_it_returns_json_response_on_product_requested()
    {
        $id = 42;
        $product = ['id' => $id];
        $records = json_encode([$id => 101]);

        $this->cachePool->hasItem($id)->willReturn(false);
        $this->elasticSearchDriver->findById($id)->willReturn($product);
        $this->cachePool->save(Argument::type(CacheItemInterface::class))->shouldBeCalled();
        $this->filesystem->has(self::PRODUCT_REQUEST_RECORDER_FILE_NAME)->willReturn(true);
        $this->filesystem->read(self::PRODUCT_REQUEST_RECORDER_FILE_NAME)->willReturn($records);
        $this->filesystem->write(self::PRODUCT_REQUEST_RECORDER_FILE_NAME, json_encode([$id => 102]))->shouldBeCalled();

        $response = $this->controller->detail($id);

        $this->assertEquals(json_encode($product), $response);
    }
}
