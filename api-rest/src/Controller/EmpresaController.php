<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Empresa;
use App\Repository\EmpresaRepository;
use App\Services\EmpresaService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{JsonResponse, Request, Response};
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class EmpresaController
 * @package App\Controller
 */
class EmpresaController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * @var EmpresaService
     */
    private EmpresaService $empresaService;

    /**
     * @var EmpresaRepository
     */
    private EmpresaRepository $repository;

    /**
     * EmpresaController constructor.
     * @param EntityManagerInterface $entityManager
     * @param EmpresaService $empresaService
     * @param EmpresaRepository $repository
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        EmpresaService $empresaService,
        EmpresaRepository $repository
    ) {
        $this->entityManager = $entityManager;
        $this->empresaService = $empresaService;
        $this->repository = $repository;
    }

    /**
     * @Route("/empresa", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $body = $request->getContent();
        $empresa = $this->empresaService->criarEmpresa($body);

        $this->entityManager->persist($empresa);
        $this->entityManager->flush();

        return new JsonResponse($empresa);
    }

    /**
     * @Route("/empresa/{id}", methods={"GET"})
     * @param int $id
     * @return Response
     */
    public function read(int $id): Response
    {
        $empresa = $this->getEmpresa($id);
        $statusCode = is_null($empresa) ? Response::HTTP_NO_CONTENT : Response::HTTP_OK;

        return new JsonResponse($empresa, $statusCode);
    }

    /**
     * @Route("/empresas", methods={"GET"})
     * @return Response
     */
    public function all(): Response
    {
        $empresas = $this->repository->findAll();
        $statusCode = empty($empresas) ? Response::HTTP_NO_CONTENT : Response::HTTP_OK;

        return new JsonResponse($empresas, $statusCode);
    }

    /**
     * @Route("/empresa/{id}", methods={"PUT"})
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function update(int $id, Request $request): Response
    {
        $body = $request->getContent();
        $empresaAux = $this->empresaService->criarEmpresa($body);
        $empresa = $this->empresaService->atualizarEmpresa($id, $empresaAux);

        if (is_null($empresa)) {
            return new JsonResponse('', Response::HTTP_NOT_FOUND);
        };

        $this->entityManager->flush();

        return new JsonResponse($empresa);
    }

    /**
     * @Route("/empresa/{id}", methods={"DELETE"})
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        $empresa = $this->getEmpresa($id);

        if (is_null($empresa)) {
            return new JsonResponse('', Response::HTTP_NOT_FOUND);
        };

        $this->entityManager->remove($empresa);
        $this->entityManager->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }

    /**
     * @param int $id
     * @return Empresa|null
     */
    public function getEmpresa(int $id): ?Empresa
    {
        return $this->repository->find($id);
    }
}