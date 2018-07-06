<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 6/07/18
 * Time: 12:36
 */

namespace App\Infrastructure\Service;

use App\Domain\Model\Entity\User\UserRepositoryInterface;
use Swift_Mailer;
use Swift_Message;
use Twig_Environment;

class SenderMailRegister
{
    private $userRepository;
    private $mailer;
    private $twig_Environment;

    public function __construct(
        Swift_Mailer $mailer,
        Twig_Environment $twig_Environment,
        UserRepositoryInterface $userRepository
    )
    {
        $this->mailer = $mailer;
        $this->twig_Environment = $twig_Environment;
        $this->userRepository = $userRepository;
    }

    /**
     * @param $userId
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function send (
        $userId
    ) {
        $user = $this->userRepository->findUserById($userId);
        $name = $user->getName();
        $receiverEmail = $user->getEmail();

        $message = (new Swift_Message('Confirmacion registro en Web de mascotas'))
            ->setFrom('noreply@mascotas.com')
            ->setTo($receiverEmail)
            ->setBody(
                $this->twig_Environment->render(
                    'user/emailUserRegistered.twig',
                    [
                        'name' => $name
                    ]
                ),
                'text/html'
            )
        ;
        $this->mailer->send($message);
    }
}