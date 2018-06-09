<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 13/05/18
 * Time: 12:39
 */

namespace App\Domain\Model\Entity\User;


class EmailExistsException extends \Exception
{
    public function __construct()
    {
        $message = 'El email introducido ya existe';
        $code = 409;
        parent::__construct($message, $code);
    }
}