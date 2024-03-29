<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientStoreUpdateRequest;
use App\Http\Resources\ClientResource;
use App\Services\ClientService;
use App\Services\UploadImageService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     schema="Client",
 *     required={"id", "name", "social_name", "birth_date", "cpf", "photo"},
 *
 *     @OA\Property(
 *         property="id",
 *         type="string",
 *         format="uuid",
 *         description="ID único do cliente (UUID)"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Nome"
 *     ),
 *     @OA\Property(
 *         property="social_name",
 *         type="string",
 *         description="Nome Social"
 *     ),
 *     @OA\Property(
 *         property="birth_date",
 *         type="date",
 *         description="Data de Nascimento"
 *     ),
 *     @OA\Property(
 *         property="cpf",
 *         type="string",
 *         description="CPF"
 *     ),
 *     @OA\Property(
 *         property="photo",
 *         type="file",
 *         nullable=true,
 *         description="Foto"
 *     ),
 * )
 *
 * @OA\Schema(
 *     schema="ClientStoreUpdateRequest",
 *     title="ClientStoreUpdateRequest",
 *     required={"name", "social_name", "birth_date", "cpf", "photo"},
 *
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Nome"
 *     ),
 *     @OA\Property(
 *         property="social_name",
 *         type="string",
 *         description="Nome Social"
 *     ),
 *     @OA\Property(
 *         property="birth_date",
 *         type="date",
 *         description="Data de Nascimento"
 *     ),
 *     @OA\Property(
 *         property="cpf",
 *         type="string",
 *         description="CPF"
 *     ),
 *     @OA\Property(
 *         property="photo",
 *         type="file",
 *         nullable=true,
 *         description="Foto"
 *     ),
 * )
 */
class ClientController extends Controller
{
    private $service;
    private $uploadImageService;

    public function __construct(ClientService $service, UploadImageService $uploadImage)
    {
        $this->service = $service;
        $this->uploadImageService = $uploadImage;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/clients",
     *     summary="Listar todos os clientes",
     *     tags={"Client"},
     *
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Filtro para busca de clientes",
     *         required=false,
     *
     *         @OA\Schema(type="string")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Lista de clientes retornada com sucesso",
     *
     *         @OA\JsonContent(
     *             type="array",
     *
     *             @OA\Items(ref="#/components/schemas/Client")
     *         )
     *     ),
     * )
     */
    public function index(Request $request): JsonResponse
    {
        $name = $request->input('name');

        $clients = $this->service->getPaginate($name);

        return ClientResource::collection($clients)->response();
    }

    /**
     * @OA\Get(
     *     path="/api/v1/clients/{id}",
     *     summary="Obter detalhes de cliente",
     *     tags={"Client"},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Id do cliente",
     *
     *         @OA\Schema(
     *             type="string",
     *             format="uuid"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Detalhes do cliente",
     *
     *             @OA\Items(ref="#/components/schemas/Client")
     *         )
     *     ),
     *
     *      @OA\Response(
     *         response=404,
     *         description="Cliente não encontrado",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Cliente não encontrado"
     *             )
     *         )
     *     )
     * )
     */
    public function show($clientUuid): JsonResponse
    {
        $client = $this->service->getByUUid($clientUuid);

        if (!$client) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        return ClientResource::make($client)->response();
    }

    /**
     * @OA\Post(
     *     path="/api/v1/clients",
     *     summary="Criar um novo cliente",
     *     tags={"Client"},
     *
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados do cliente",
     *
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *
     *             @OA\Schema(ref="#/components/schemas/ClientStoreUpdateRequest")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Cliente criado com sucesso",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Cliente criado com sucesso"),
     *             @OA\Property(property="client", ref="#/components/schemas/Client")
     *         )
     *     )
     * )
     */
    public function store(ClientStoreUpdateRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();

            $data['birth_date'] = Carbon::createFromFormat('d/m/Y', $data['birth_date'])->format('Y-m-d');

            // Service para manipular o upload da imagem
            $uploadedImage = $this->uploadImageService->handleImageUpload($request);

            if ($uploadedImage !== null) {
                $data['photo'] = $uploadedImage;
            }

            $newClient = $this->service->create($data);

            return response()->json([
                'client' => new ClientResource($newClient),
            ], 201);
        } catch (\Exception $e) {
            Log::error('Erro ao processar a solicitação: '.$e->getMessage());

            return response()->json([
                'error' => 'Ocorreu um erro durante o cadastro. Por favor, tente novamente.'], 500);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/v1/clients/{id}",
     *     summary="Atualizar cliente",
     *     tags={"Client"},
     *
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do cliente a ser atualizado",
     *         required=true,
     *
     *         @OA\Schema(
     *             type="string",
     *             format="uuid"
     *         )
     *     ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados do cliente a ser atualizado",
     *
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *
     *             @OA\Schema(ref="#/components/schemas/ClientStoreUpdateRequest")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Cliente atualizado com sucesso",
     *
     *         @OA\JsonContent(ref="#/components/schemas/Client")
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Cliente não encontrado"
     *     )
     * )
     */
    public function update(ClientStoreUpdateRequest $request, $clientUuid): JsonResponse
    {
        try {
            $data = $request->validated();

            $data['birth_date'] = Carbon::createFromFormat('d/m/Y', $data['birth_date'])->format('Y-m-d');

            $client = $this->service->getByUUid($clientUuid);

            if (!$client) {
                return response()->json(['message' => 'Cliente não encontrado'], 404);
            }

            $uploadedImage = $this->uploadImageService->handleImageUpload($request, $client->photo);

            if ($uploadedImage !== null) {
                $data['photo'] = $uploadedImage;
            }

            $client = $this->service->update($data, $clientUuid);

            // return new ClientResource($client);
            return response()->json([new ClientResource($client)], 200);
        } catch (\Exception $e) {
            Log::error('Erro ao processar a solicitação: '.$e->getMessage());

            return response()->json([
                'error' => 'Ocorreu um erro durante a atualização. Por favor, tente novamente.'], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/clients/{id}",
     *     summary="Deletar cliente existente",
     *     tags={"Client"},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do cliente a ser deletado",
     *         required=true,
     *
     *         @OA\Schema(
     *             type="string",
     *             format="uuid"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Cliente deletado com sucesso"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Cliente não encontrado"
     *     )
     * )
     */
    public function destroy($clientUuid): JsonResponse
    {
        $this->service->delete($clientUuid);

        return response()->json(['message' => 'Cliente deletado'], 204);
    }
}
