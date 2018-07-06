<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 5/07/18
 * Time: 15:51
 */

namespace App\Application\User\SendEmailWhenRegistered;

use App\Infrastructure\Service\SenderMailRegister;

class SendEmailWhenRegistered
{
    private $senderMailRegister;

    public function __construct(
        SenderMailRegister $senderMailRegister
    ) {
        $this->senderMailRegister = $senderMailRegister;
    }

    /**
     * @param int $userId
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function handle(int $userId)
    {
        $this->senderMailRegister->send($userId);
    }
}