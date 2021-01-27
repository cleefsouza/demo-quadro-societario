<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Socio;
use App\Repository\SocioRepository;
use App\Services\SocioService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{JsonResponse, Request, Response};
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SocioController
 * @package App\Controller
 */
class SocioController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * @var SocioRepository
     */
    private SocioRepository $repository;

    /**
     * @var SocioService
     */
    private SocioService $socioService;

    /**
     * SocioController constructor.
     * @param EntityManagerInterface $entityManager
     * @param SocioService $socioService
     * @param SocioRepository $repository
     */
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
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $body = $request->getContent();
        $socio = $this->socioService->criarSocio($body);

        $this->entityManager->persist($socio);
        $this->entityManager->flush();

        return new JsonResponse($socio);
    }

    /**
     * @Route("/socio/{id}", methods={"GET"})
     * @param int $id
     * @return Response
     */
    public function read(int $id): Response
    {
        $socio = $this->getSocio($id);
        $statusCode = is_null($socio) ? Response::HTTP_NO_CONTENT : Response::HTTP_OK;

        return new JsonResponse($socio, $statusCode);
    }

    /**
     * @Route("/socios", methods={"GET"})
     * @return Response
     */
    public function all(): Response
    {
        $socios = $this->repository->findAll();
        $statusCode = empty($socios) ? Response::HTTP_NO_CONTENT : Response::HTTP_OK;

        return new JsonResponse($socios, $statusCode);
    }

    /**
     * @Route("/socio/{id}", methods={"PUT"})
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function update(int $id, Request $request): Response
    {
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
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        $socio = $this->getSocio($id);

        if (is_null($socio)) {
            return new JsonResponse('', Response::HTTP_NOT_FOUND);
        };

        $this->entityManager->remove($socio);
        $this->entityManager->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/socios/empresa/{id}", methods={"GET"})
     * @param int $id
     * @return Response
     */
    public function socioPorEmpresa(int $id): Response
    {
        $socios = $this->getSocioPorEmpresa($id);
        $statusCode = empty($socios) ? Response::HTTP_NO_CONTENT : Response::HTTP_OK;

        return new JsonResponse($socios, $statusCode);
    }

    /**
     * @param int $id
     * @return Socio|null
     */
    public function getSocio(int $id): ?Socio
    {
        return $this->repository->find($id);
    }

    /**
     * @param int $empresaId
     * @return Socio|null
     */
    public function getSocioPorEmpresa(int $empresaId): ?Socio
    {
        return $this->repository->buscarPorEmpresa($empresaId);
    }
}