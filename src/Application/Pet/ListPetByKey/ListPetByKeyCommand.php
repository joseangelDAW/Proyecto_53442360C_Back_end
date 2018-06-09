<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 17/05/18
 * Time: 15:14
 */

namespace App\Application\Pet\ListPetByKey;

use Assert\Assertion;

class ListPetByKeyCommand
{
    private $key;
    private $value;

    /**
     * ListPetByKeyCommand constructor.
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