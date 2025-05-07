<?php

namespace App\Models;

use CodeIgniter\Model;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="RelatorioDto",
 *     type="object",
 *     required={"uuid", "data", "hora", "codigo", "nome", "sistema"},
 *     @OA\Property(
 *         property="uuid",
 *         type="string",
 *         format="uuid",
 *         description="Unique identifier for the report"
 *     ),
 *     @OA\Property(
 *         property="data",
 *         type="string",
 *         format="date",
 *         description="Report date"
 *     ),
 *     @OA\Property(
 *         property="hora",
 *         type="string",
 *         format="time",
 *         description="Report time"
 *     ),
 *     @OA\Property(
 *         property="codigo",
 *         type="string",
 *         description="Report code"
 *     ),
 *     @OA\Property(
 *         property="nome",
 *         type="string",
 *         description="Report name"
 *     ),
 *     @OA\Property(
 *         property="sistema",
 *         type="string",
 *         description="System code"
 *     )
 * )
 */
class RelatorioDto extends Model
{
    protected $table = 'relatorios';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['uuid', 'data', 'hora', 'codigo', 'nome', 'sistema'];
} 