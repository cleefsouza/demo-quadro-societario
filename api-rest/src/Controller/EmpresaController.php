<?php


namespace App\Controller;


use App\Entity\Empresa;
use App\Repository\EmpresaRepository;
use App\Services\EmpresaService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmpresaController extends AbstractController {

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var EmpresaService
     */
    private $empresaService;
    /**
     * @var EmpresaRepository
     */
    private $repository;

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
     */
    public function create(Request $request) : Response {

        $body = $request->getContent();
        $empresa = $this->empresaService->criarEmpresa($body);

        $this->entityManager->persist($empresa);
        $this->entityManager->flush();

        return new JsonResponse($empresa);
    }

    /**
     * @Route("/empresa/{id}", methods={"GET"})
     */
    public function read(int $id) : Response {

        $empresa = $this->getEmpresa($id);
        $statusCode = is_null($empresa) ? Response::HTTP_NO_CONTENT : Response::HTTP_OK;

        return new JsonResponse($empresa, $statusCode);
    }

    /**
     * @Route("/empresas", methods={"GET"})
     */
    public function all() : Response {
        $empresas = $this->repository->findAll();
        $statusCode = empty($empresas) ? Response::HTTP_NO_CONTENT : Response::HTTP_OK;

        return new JsonResponse($empresas, $statusCode);
    }

    /**
     * @Route("/empresa/{id}", methods={"PUT"})
     */
    public function update(int $id, Request $request) : Response {

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
     */
    public function delete(int $id) : Response {
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
     * @return Empresa|object|null
     */
    public function getEmpresa(int $id) {
        $empresa = $this->repository->find($id);
        return $empresa;
    }
}