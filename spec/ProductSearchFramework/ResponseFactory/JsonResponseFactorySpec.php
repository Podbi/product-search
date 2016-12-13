<?php
namespace spec\ProductSearchFramework\ResponseFactory;

use PhpSpec\ObjectBehavior;
use ProductSearchFramework\Json\JsonParser;
use ProductSearchFramework\ResponseFactory\ResponseFactory;
use Prophecy\Argument;

/**
 * @mixin \ProductSearchFramework\ResponseFactory\JsonResponseFactory
 */
class JsonResponseFactorySpec extends ObjectBehavior
{
    public function let(JsonParser $jsonParser)
    {
        $this->beConstructedWith($jsonParser);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(\ProductSearchFramework\ResponseFactory\JsonResponseFactory::class);
    }

    public function it_should_implement_response_factory()
    {
        $this->shouldHaveType(ResponseFactory::class);
    }

    public function it_should_return_json_response(JsonParser $jsonParser)
    {
        $data = ['Data'];
        $response = '{Data}';
        $jsonParser->encode($data)->willReturn($response);

        $this->createResponse($data)->shouldReturn($response);
    }
}
