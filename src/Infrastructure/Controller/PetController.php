<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 16/05/18
 * Time: 20:01
 */

namespace App\Infrastructure\Controller;

use App\Application\Pet\InsertPet\InsertPet;
use App\Application\Pet\InsertPet\InsertPetCommand;
use App\Application\Pet\ListMatchedPet\ListMatchedPet;
use App\Application\Pet\ListMatchedPet\ListMatchedPetCommand;
use App\Application\Pet\ListPet\ListPet;
use App\Application\Pet\ListPet\ListPetCommand;
use App\Application\Pet\ListPetByKey\ListPetByKey;
use App\Application\Pet\ListPetByKey\ListPetByKeyCommand;
use App\Application\Pet\ListPetByUserId\ListPetByUserId;
use App\Application\Pet\ListPetByUserId\ListPetByUserIdCommand;
use App\Application\Pet\UpdatePet\UpdatePet;
use App\Application\Pet\UpdatePet\UpdatePetCommand;
use App\Domain\Model\Entity\Pet\PetRepositoryInterface;
use App\Domain\Model\Entity\User\UserRepositoryInterface;
use App\Infrastructure\Repository\Pet\PetRepository;
use App\Infrastructure\Service\ReactRequestTransform;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PetController extends Controller
{
    /**
     * @param Request $request
     * @param InsertPet $insertPet
     * @param ReactRequestTransform $reactRequestTransform
     * @return JsonResponse
     * @throws \Assert\AssertionFailedException
     */
    public function insertPet(
        Request $request,
        InsertPet $insertPet,
        ReactRequestTransform $reactRequestTransform
    ) {

        $item = $reactRequestTransform->transform($request);

        $output = $insertPet->handle(
            new InsertPetCommand(
                $item['name'],
                $item['typePet'],
                $item['sex'],
                $item['race'],
                $item['userId'],
                $item['birthDate']
            )
        );
        return new JsonResponse($output['data'], $output['code']);
    }

    /**
     * @param ListPet $listPet
     * @return JsonResponse
     */
    public function listPet(
        ListPet $listPet
    ) {
        $output = $listPet->handle(new ListPetCommand());
        return $this->json($output);
    }

    /**
     * @param Request $request
     * @param UpdatePet $updatePet
     * @param ReactRequestTransform $reactRequestTransform
     * @return JsonResponse
     * @throws \Assert\AssertionFailedException
     */
    public function updatePet(
        Request $request,
        UpdatePet $updatePet,
        ReactRequestTransform $reactRequestTransform
    ) {
        $item = $reactRequestTransform->transform($request);

        $output = $updatePet->handle(
            new UpdatePetCommand(
                $item['id'],
                $item['name'],
                $item['typePet'],
                $item['sex'],
                $item['race'],
                $item['birthDate']
            )
        );
        return new JsonResponse($output['data'], $output['code']);
    }

    /**
     * @param string $key
     * @param string $value
     * @param ListPetByKey $listPetByKey
     * @return JsonResponse
     * @throws \Assert\AssertionFailedException
     */
    public function listPetByKey(
        string $key,
        string $value,
        ListPetByKey $listPetByKey
    ) {
        $output = $listPetByKey->handle(new ListPetByKeyCommand($key, $value));
        return $this->json($output);
    }

    /**
     * @param int $id
     * @param Request $request
     * @param PetRepositoryInterface $petRepository
     * @return JsonResponse
     */
    public function uploadPetImage(
        int $id,
        Request $request,
        PetRepositoryInterface $petRepository
    ) {

        $file = $request->getContent();

        $date = date('Y-m-d h:i:s');

        $output = "./Uploads/Pet/".$id."_".$date."image.jpg";
        $urlDb = "/Uploads/Pet/".$id."_".$date."image.jpg";

        //unlink($output);

        $fp = fopen($output, 'w');
        fwrite($fp, $file);

        $petRepository->setUrlPetImage($id, $urlDb);

        return new JsonResponse('Imagen enviada con éxito');
    }

    /**
     * @param int $id
     * @param ListPetByUserId $listPetByUserId
     * @return JsonResponse
     * @throws \Assert\AssertionFailedException
     */
    public function listPetByUserId(
        int $id,
        ListPetByUserId $listPetByUserId
    ) {

        $output = $listPetByUserId->handle(new ListPetByUserIdCommand($id));

        return $this->json($output);
    }

    /**
     * @param string $typePet
     * @param string $sex
     * @param string $race
     * @param int $userId
     * @param ListMatchedPet $listMatchedPet
     * @return JsonResponse
     * @throws \Assert\AssertionFailedException
     */
    public function listMatchedPet(
        string $typePet,
        string $sex,
        string $race,
        int $userId,
        ListMatchedPet $listMatchedPet
    ) {

        $output = $listMatchedPet->handle(new ListMatchedPetCommand($typePet, $sex, $race, $userId));
        return $this->json($output);

    }

    /**
     * @param Request $request
     * @param ReactRequestTransform $reactRequestTransform
     * @param \Swift_Mailer $mailer
     * @param UserRepositoryInterface $userRepository
     * @return JsonResponse
     */
    public function sendEmailMatchedPet(
        Request $request,
        ReactRequestTransform $reactRequestTransform,
        \Swift_Mailer $mailer,
        UserRepositoryInterface $userRepository
    ) {
        $item = $reactRequestTransform->transform($request);

        $userId = $item['userId'];
        $receiverEmail = $item['receiverEmail'];
        $petName = $item['petName'];

        $userSender = $userRepository->findUserById($userId);
        $senderEmail = $userSender->getEmail();

        $message = (new \Swift_Message('Solicitud de contacto para tu mascota'))
            ->setFrom('noreply@mascotas.com')
            ->setTo($receiverEmail)
            ->setBody(
                $this->renderView(
                    'pet/emailMatchedPet.twig',
                    [
                        'senderEmail' => $senderEmail,
                        'receiverEmail' => $receiverEmail,
                        'petName' => $petName
                    ]
                ),
                'text/html'
            )
        ;

        $mailer->send($message);

        return new JsonResponse(["Email enviado con éxito"]);
    }
}