<?php
namespace Cl\Core\Essence\Interface;

interface Essence{

    /**
     * @return array
     */
    public function getRawData();

    /**
     * @param array $data
     * @return $this
     */
    public function setRawData(array $data);

    /**
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function setData(string $key, mixed $value);

    /**
     * @param string $key
     * @return mixed
     */
    public function getData(string $key);
}