<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 30/05/18
 * Time: 19:07
 */

namespace App\Domain\Model\Entity\User;


class RoleDoesNotMatchException extends \Exception
{
    public function __construct()
    {
        $message = 'Está intentando acceder con un rol no asignado';
        $code = 404;
        parent::__construct($message, $code);
    }
}