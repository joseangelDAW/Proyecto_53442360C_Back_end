<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 19/05/18
 * Time: 11:27
 */

namespace App\Domain\Model\Entity\User;


class NickNameDoesNotExistException extends \Exception
{
    public function __construct()
    {
        $message = 'El nickname introducido no existe';
        $code = 404;
        parent::__construct($message, $code);
    }
}