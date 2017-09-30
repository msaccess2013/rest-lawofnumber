<?php
namespace App\Managers;
class Manager {
    private $container;
    function __construct($container)
    {
        $this->container = $container;
    }
    public function __get($property)
    {
        if ($this->container->{$property}){
            return $this->container->{$property};
        }
        return null;
    }
}