<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="Relatorio Toque",
 *     description="API Endpoints for Relatorio Toque"
 * )
 * 
 * @OA\SecurityRequirement(
 *     security={
 *         {"bearerAuth": {}}
 *     }
 * )
 */
class RelatorioToque extends ResourceController
{
    protected $relatorioService;
    protected $sistemaRepository;

    public function __construct()
    {
        $this->relatorioService = new \App\Services\RelatorioService();
        $this->sistemaRepository = new \App\Repositories\SistemaRepository();
    }

    /**
     * @OA\Post(
     *     path="/v2/relatorio-toque/{appSystemKey}/sincronizar",
     *     tags={"Relatorio Toque"},
     *     summary="Synchronize a single report",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="appSystemKey",
     *         in="path",
     *         required=true,
     *         description="System UUID",
     *         @OA\Schema(type="string", format="uuid")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/RelatorioDto")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Success")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="System not found"
     *     )
     * )
     */
    public function sincronizar($appSystemKey = null)
    {
        $sistema = $this->sistemaRepository->findByUuid($appSystemKey);
        if (!$sistema) {
            return $this->failNotFound('System not found');
        }
        
        $dto = $this->request->getJSON();
        $this->relatorioService->sync($dto, $sistema->codigo);
        
        return $this->respond(['message' => 'Success'], 200);
    }

    /**
     * @OA\Post(
     *     path="/v2/relatorio-toque/{appSystemKey}/sincronizar/massa",
     *     tags={"Relatorio Toque"},
     *     summary="Synchronize multiple reports",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="appSystemKey",
     *         in="path",
     *         required=true,
     *         description="System UUID",
     *         @OA\Schema(type="string", format="uuid")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/RelatorioDto")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="sucesso",
     *                 type="array",
     *                 @OA\Items(type="string")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="System not found"
     *     )
     * )
     */
    public function sincronizarMassa($appSystemKey = null)
    {
        $sistema = $this->sistemaRepository->findByUuid($appSystemKey);
        if (!$sistema) {
            return $this->failNotFound('System not found');
        }
        
        $dtos = $this->request->getJSON();
        $sucesso = [];
        foreach ($dtos as $report) {
            try {
                $this->relatorioService->sync($report, $sistema->codigo);
                $sucesso[] = $report->uuid;
            } catch (\Exception $e) {
                log_message('error', $e->getMessage());
            }
        }
        
        return $this->respond(['sucesso' => $sucesso], 200);
    }
} 