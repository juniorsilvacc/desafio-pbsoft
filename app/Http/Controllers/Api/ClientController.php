<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientStoreUpdateRequest;
use App\Http\Resources\ClientResource;
use App\Services\ClientService;
use App\Services\UploadImageService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $path = 'clients';
    private $service;
    private $uploadImageService;

    public function __construct(ClientService $service, UploadImageService $uploadImage)
    {
        $this->service = $service;
        $this->uploadImageService = $uploadImage;
    }

    public function index(Request $request)
    {
        $filter = $request->input('filter');

        $clients = $this->service->getPaginate($filter);

        return ClientResource::collection($clients);
    }

    public function show($clientUuid)
    {
        $client = $this->service->getByUUid($clientUuid);

        if (!$client) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        return new ClientResource($client);
    }

    public function store(ClientStoreUpdateRequest $request)
    {
        $data = $request->validated();

        // Método para manipular o upload da imagem
        $uploadedImage = $this->uploadImageService->handleImageUpload($request);

        if ($uploadedImage !== null) {
            $data['photo'] = $uploadedImage;
        }

        $newClient = $this->service->create($data);

        return response()->json([
            'client' => new ClientResource($newClient),
        ], 201);
    }
}
