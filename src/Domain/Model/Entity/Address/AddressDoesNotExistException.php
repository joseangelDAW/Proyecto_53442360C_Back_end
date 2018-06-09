<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 13/05/18
 * Time: 20:17
 */

namespace App\Domain\Model\Entity\Address;


class AddressDoesNotExistException extends \Exception
{
    public function __construct()
    {
        $message = 'La dirección no existe';
        $code = 404;
        parent::__construct($message, $code);
    }
}