<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 1/05/18
 * Time: 10:03
 */

namespace App\Infrastructure\Controller;

use App\Application\User\InsertUser\InsertUser;
use App\Application\User\InsertUser\InsertUserCommand;
use App\Application\User\ListUser\ListUser;
use App\Application\User\ListUser\ListUserCommand;
use App\Application\User\ListUserByKey\ListUserByKey;
use App\Application\User\ListUserByKey\ListUserByKeyCommand;
use App\Application\User\LoginUser\LoginUser;
use App\Application\User\LoginUser\LoginUserCommand;
use App\Application\User\SendEmailWhenRegistered\SendEmailWhenRegistered;
use App\Application\User\UpdateUser\UpdateUser;
use App\Application\User\UpdateUser\UpdateUserCommand;
use App\Domain\Model\Entity\User\UserRepositoryInterface;
use App\Infrastructure\Service\ReactRequestTransform;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @param UserRepositoryInterface $userRepository
     * @return JsonResponse
     */
    public function insertDefaultAdmin(
        UserRepositoryInterface $userRepository
    )
    {
        $userRepository->insertDefaultAdmin();
        return new JsonResponse("Admin insertado");
    }


    /**
     * @param Request $request
     * @param InsertUser $insertUser
     * @param ReactRequestTransform $reactRequestTransform
     * @return JsonResponse
     * @throws \Assert\AssertionFailedException
     */
    public function insertUser(
        Request $request,
        InsertUser $insertUser,
        ReactRequestTransform $reactRequestTransform
    ) {
        $item = $reactRequestTransform->transform($request);

        $output = $insertUser->handle(
            new InsertUserCommand(
                $item['name'],
                $item['surname'],
                $item['birthDate'],
                $item['nickName'],
                $item['email'],
                $item['password']
            )
        );
        return new JsonResponse($output['data'], $output['code']);
    }

    /**
     * @param Request $request
     * @param LoginUser $loginUser
     * @param ReactRequestTransform $reactRequestTransform
     * @return JsonResponse
     * @throws \Assert\AssertionFailedException
     */
    public function loginUser(
        Request $request,
        LoginUser $loginUser,
        ReactRequestTransform $reactRequestTransform
    ) {
        $item = $reactRequestTransform->transform($request);

        $output = $loginUser->handle(
            new LoginUserCommand(
                $item['nickname'],
                $item['password'],
                $item['role']
            )
        );
        return new JsonResponse($output['data'], $output['code']);
    }

    /**
     * @param ListUser $listUser
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function listUser(ListUser $listUser)
    {
        $output = $listUser->handle(new ListUserCommand());
        return $this->json($output);
    }

    /**
     * @param Request $request
     * @param UpdateUser $updateUser
     * @param ReactRequestTransform $reactRequestTransform
     * @return JsonResponse
     * @throws \Assert\AssertionFailedException
     */
    public function updateUser (
        Request $request,
        UpdateUser $updateUser,
        ReactRequestTransform $reactRequestTransform
    ) {

        $item = $reactRequestTransform->transform($request);

        $output = $updateUser->handle(
            new UpdateUserCommand(
                $item['id'],
                $item['name'],
                $item['surname'],
                $item['nickName'],
                $item['email']
            )
        );

        return new JsonResponse($output['data'], $output['code']);
    }

    /**
     * @param string $key
     * @param string $value
     * @param ListUserByKey $listUserByKey
     * @return JsonResponse
     * @throws \Assert\AssertionFailedException
     */
    public function listUserByKey(string $key, string $value, ListUserByKey $listUserByKey)
    {
        $output = $listUserByKey->handle(
            new ListUserByKeyCommand($key, $value));
        return $this->json($output);
    }

    /**
     * @param $name
     * @param $fecha_nacimiento
     * @return Response
     */
    public function success($name, $fecha_nacimiento)
    {
        return $this->json([
            'success' => 'Los datos del formulario se han introducido con exito',
            'nombre' => $name,
            'facha_nacimiento' => $fecha_nacimiento,
        ]);
    }

    /**
     * @param Request $request
     * @param SendEmailWhenRegistered $sendEmailWhenRegistered
     * @param ReactRequestTransform $reactRequestTransform
     * @return JsonResponse
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendEmailWhenRegistered(
        Request $request,
        SendEmailWhenRegistered $sendEmailWhenRegistered,
        ReactRequestTransform $reactRequestTransform
    ) {
        $item = $reactRequestTransform->transform($request);
        $userId = $item['userId'];
        $sendEmailWhenRegistered->handle($userId);

        return new JsonResponse(["Email enviado con éxito"]);
    }
}