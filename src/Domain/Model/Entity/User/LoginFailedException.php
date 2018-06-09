<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 19/05/18
 * Time: 11:06
 */

namespace App\Domain\Model\Entity\User;


class LoginFailedException extends \Exception
{
    public function __construct()
    {
        $message = 'Contraseña incorrecta';
        $code = 404;
        parent::__construct($message, $code);
    }
}