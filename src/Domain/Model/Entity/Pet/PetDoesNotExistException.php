<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 17/05/18
 * Time: 8:50
 */

namespace App\Domain\Model\Entity\Pet;

class PetDoesNotExistException extends \Exception
{
    public function __construct()
    {
        $message = 'La mascota no existe';
        $code = 404;
        parent::__construct($message, $code);
    }
}