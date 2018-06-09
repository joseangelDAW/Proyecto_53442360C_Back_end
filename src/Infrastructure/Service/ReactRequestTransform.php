<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 16/05/18
 * Time: 16:22
 */

namespace App\Infrastructure\Service;


use Symfony\Component\HttpFoundation\Request;

class ReactRequestTransform
{
    /**
     * @param Request $request
     * @return array
     */
    public function transform(Request $request): array
    {
        $arrayRequest = array(json_decode($request->getContent()));
        $item = [];

        foreach ($arrayRequest[0] as $key => $value) {
            $item[$key] = $value;
        }

        return $item;
    }
}