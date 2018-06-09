<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 8/05/18
 * Time: 21:42
 */

namespace App\Application\Address\ListAddressByKey;

use Assert\Assertion;

class ListAddressByKeyCommand
{
    private $key;
    private $value;

    /**
     * ListAddressByKeyCommand constructor.
     * @param $key
     * @param $value
     * @throws \Assert\AssertionFailedException
     */
    public function __construct($key, $value)
    {
        Assertion::notBlank($key);
        Assertion::string($key);

        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }


}