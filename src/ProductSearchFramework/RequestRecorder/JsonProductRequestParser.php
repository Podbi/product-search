<?php
namespace ProductSearchFramework\RequestRecorder;

class JsonProductRequestParser
{
    public function decode(string $data) : array
    {
        return json_decode($data, true);
    }

    public function encode(array $data) : string
    {
        return json_encode($data);
    }
}
