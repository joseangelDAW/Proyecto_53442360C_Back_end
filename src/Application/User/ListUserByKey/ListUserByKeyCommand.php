<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 15/05/18
 * Time: 20:57
 */

namespace App\Application\User\ListUserByKey;
use Assert\Assertion;

class ListUserByKeyCommand
{
    private $key;
    private $value;

    /**
     * ListUserByKeyCommand constructor.
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