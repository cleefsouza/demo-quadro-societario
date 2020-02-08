<?php


namespace App\Controller;


use App\Entity\Socio;
use App\Repository\SocioRepository;
use App\Services\SocioService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SocioController extends AbstractController {

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var SocioRepository
     */
    private $repository;

    /**
     * @var SocioService
     */
    private $socioService;

    public function __construct(
        EntityManagerInterface $entityManager,
        SocioService $socioService,
        SocioRepository $repository
    ) {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
        $this->socioService = $socioService;
    }

    /**
     * @Route("/socio", methods={"POST"})
     */
    public function create(Request $request) : Response {

        $body = $request->getContent();
        $socio = $this->socioService->criarSocio($body);

        $this->entityManager->persist($socio);
        $this->entityManager->flush();

        return new JsonResponse($socio);
    }

    /**
     * @Route("/socio/{id}", methods={"GET"})
     */
    public function read(int $id) : Response {

        $socio = $this->getSocio($id);
        $statusCode = is_null($socio) ? Response::HTTP_NO_CONTENT : Response::HTTP_OK;

        return new JsonResponse($socio, $statusCode);
    }

    /**
     * @Route("/socios", methods={"GET"})
     */
    public function all() : Response {
        $socios = $this->repository->findAll();
        return new JsonResponse($socios);
    }

    /**
     * @Route("/socio/{id}", methods={"PUT"})
     */
    public function update(int $id, Request $request) : Response {

        $body = $request->getContent();
        $socioAux = $this->socioService->criarSocio($body);
        $socio = $this->socioService->atualizarSocio($id, $socioAux);

        if (is_null($socio)) {
            return new JsonResponse('', Response::HTTP_NOT_FOUND);
        };

        $this->entityManager->flush();

        return new JsonResponse($socio);
    }

    /**
     * @Route("/socio/{id}", methods={"DELETE"})
     */
    public function delete(int $id) : Response {
        $socio = $this->getSocio($id);

        if (is_null($socio)) {
            return new JsonResponse('', Response::HTTP_NOT_FOUND);
        };

        $this->entityManager->remove($socio);
        $this->entityManager->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }

    /**
     * @param int $id
     * @return Socio|object|null
     */
    public function getSocio(int $id) {
        $socio = $this->repository->find($id);
        return $socio;
    }

}