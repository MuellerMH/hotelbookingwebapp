<?php
namespace lib\core;
/**
 * Class Model
 * @package lib\core
 */
abstract class Model {


    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->{$name};
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->{$name} = $value;
    }
}