<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 30/05/18
 * Time: 9:26
 */

namespace App\Infrastructure\Controller;

use App\Application\News\InsertNews\InsertNews;
use App\Application\News\InsertNews\InsertNewsCommand;
use App\Application\News\ListNews\ListNews;
use App\Application\News\ListNews\ListNewsCommand;
use App\Domain\Model\Entity\News\EntryEntityRepositoryInterface;
use App\Infrastructure\Service\ReactRequestTransform;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class NewsController extends Controller
{
    /**
     * @param InsertNews $insertNews
     * @param Request $request
     * @param ReactRequestTransform $reactRequestTransform
     * @return JsonResponse
     * @throws \Assert\AssertionFailedException
     */
    public function insertEntry(
        InsertNews $insertNews,
        Request $request,
        ReactRequestTransform $reactRequestTransform
    ) {
        $item = $reactRequestTransform->transform($request);

        $output = $insertNews->handle(new InsertNewsCommand(
            $item['title'],
            $item['content']
        ));

        return $this->json($output);
    }


    /**
     * @param ListNews $listNews
     *
     * @return JsonResponse
     */
    public function listEntries(
        ListNews $listNews
    ) {
        $output = $listNews->handle(new ListNewsCommand());
        return $this->json($output);
    }

    /**
     * @param int $id
     * @param Request $request
     * @param EntryEntityRepositoryInterface $entryEntityRepository
     * @return JsonResponse
     */
    public function uploadImage(
        int $id,
        Request $request,
        EntryEntityRepositoryInterface $entryEntityRepository
    ) {
        $file = $request->getContent();

        $date = date('Y-m-d h:i:s');

        $output = "./Uploads/News/".$id."_".$date."image.jpg";
        $urlDb = "/Uploads/News/".$id."_".$date."image.jpg";

        $fp = fopen($output, 'w');
        fwrite($fp, $file);

        $entryEntityRepository->setUrlNewsImage($id, $urlDb);

        return new JsonResponse('Imagen enviada con éxito');
    }
}