<?php
namespace Cl\Core\Essence\Abstract;

use Cl\Core\Essence\Interface;

abstract class Essence implements Interface\Essence{

    /**
     * 
     *
     * @param mixed $data
     */
    public function __construct(protected mixed $data = null)
    {

    }
    
    /**
     * Set RAW data
     * 
     * @param array $data data 
     * 
     * @return $this
     */
    public function setRawData(mixed $data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Get RAW data
     * 
     * @return mixed
     */
    public function getRawData()
    {
        return $this->data;
    }

    /**
     * 
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function setData(string $key, mixed $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getData(string $key)
    {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    public function __set(...$args)
    {

    }

}