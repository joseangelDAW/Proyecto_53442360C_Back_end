<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 6/05/18
 * Time: 19:07
 */

namespace App\Infrastructure\Controller;


use App\Application\Address\InsertAddress\InsertAddress;
use App\Application\Address\InsertAddress\InsertAddressCommand;
use App\Application\Address\ListAddress\ListAddress;
use App\Application\Address\ListAddress\ListAddressCommand;
use App\Application\Address\ListAddressByKey\ListAddressByKey;
use App\Application\Address\ListAddressByKey\ListAddressByKeyCommand;
use App\Application\Address\ListAddressByUserId\ListAddressByUserId;
use App\Application\Address\ListAddressByUserId\ListAddressByUserIdCommand;
use App\Application\Address\UpdateAddress\UpdateAddress;
use App\Application\Address\UpdateAddress\UpdateAddressCommand;
use App\Infrastructure\Service\ReactRequestTransform;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AddressController extends Controller
{
    /**
     * @param Request $request
     * @param InsertAddress $insertAddress
     * @param ReactRequestTransform $reactRequestTransform
     * @return JsonResponse
     * @throws \Assert\AssertionFailedException
     */
    public function insertAddress(
        Request $request,
        InsertAddress $insertAddress,
        ReactRequestTransform $reactRequestTransform
    ) {

        $item = $reactRequestTransform->transform($request);

        $output = $insertAddress->handle(
            new InsertAddressCommand(
                $item['street'],
                $item['number'],
                $item['userId'],
                $item['floor'],
                $item['floorInformation'],
                $item['province'],
                $item['city'],
                $item['cp']
            )
        );

        return new JsonResponse($output['data'], $output['code']);

    }

    /**
     * @param ListAddress $listAddress
     * @return JsonResponse
     */
    public function listAddress(ListAddress $listAddress)
    {
        $output = $listAddress->handle(new ListAddressCommand());
        return $this->json($output);
    }

    /**
     * @param Request $request
     * @param UpdateAddress $updateAddress
     * @param ReactRequestTransform $reactRequestTransform
     * @return JsonResponse
     * @throws \Assert\AssertionFailedException
     */
    public function updateAddress(
        Request $request,
        UpdateAddress $updateAddress,
        ReactRequestTransform $reactRequestTransform
    ) {
        $item = $reactRequestTransform->transform($request);

        $output = $updateAddress->handle(
            new UpdateAddressCommand(
                $item['id'],
                $item['street'],
                $item['number'],
                $item['floor'],
                $item['floorInformation'],
                $item['province'],
                $item['city'],
                $item['cp']
            )
        );
        return new JsonResponse($output['data'], $output['code']);
    }

    /**
     * @param string $key
     * @param string $value
     * @param ListAddressByKey $listAddressByKey
     * @return JsonResponse
     * @throws \Assert\AssertionFailedException
     */
    public function listAddressByKey(string $key, string $value, ListAddressByKey $listAddressByKey)
    {
        $output = $listAddressByKey->handle(new ListAddressByKeyCommand($key, $value));
        return $this->json($output);
    }

    /**
     * @param int $id
     * @param ListAddressByUserId $listAddressByUserId
     * @return JsonResponse
     * @throws \Assert\AssertionFailedException
     */
    public function listAddressByUserId(
        int $id,
        ListAddressByUserId $listAddressByUserId
    ) {

        $output = $listAddressByUserId->handle(new ListAddressByUserIdCommand($id));

        return $this->json($output);
    }


}