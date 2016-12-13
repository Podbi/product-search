<?php
namespace ProductSearchFramework\Json;

class JsonParser
{
    /**
     * @param string $data
     * @return array
     */
    public function decode(string $data) : array
    {
        return json_decode($data, true);
    }

    /**
     * @param mixed $data
     * @return string
     */
    public function encode($data) : string
    {
        return json_encode($data);
    }
}
