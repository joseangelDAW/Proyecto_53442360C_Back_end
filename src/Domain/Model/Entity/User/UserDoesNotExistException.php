<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 13/05/18
 * Time: 12:19
 */

namespace App\Domain\Model\Entity\User;

class UserDoesNotExistException extends \Exception
{
    public function __construct()
    {
        $message = 'El usuario no existe';
        $code = 404;
        parent::__construct($message, $code);
    }
}