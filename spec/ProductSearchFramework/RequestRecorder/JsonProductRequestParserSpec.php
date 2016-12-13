<?php
namespace spec\ProductSearchFramework\RequestRecorder;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin \ProductSearchFramework\RequestRecorder\JsonProductRequestParser
 */
class JsonProductRequestParserSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(\ProductSearchFramework\RequestRecorder\JsonProductRequestParser::class);
    }

    public function it_should_decode_json_to_array()
    {
        $array = ['key' => 'value'];

        $this->decode(json_encode($array))->shouldReturn($array);
    }

    public function it_should_encode_array_to_json()
    {
        $array = ['key' => 'value'];

        $this->encode($array)->shouldReturn(json_encode($array));
    }
}
