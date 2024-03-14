<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadImageService
{
    private $path = '/public/clients';

    private function deleteClientImage($photoName)
    {
        if (Storage::exists("clients/{$photoName}")) {
            Storage::delete("clients/{$photoName}");
        }
    }

    public function handleImageUpload($request, $currentImage = null)
    {
        try {
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                // Se existe uma foto atual, exclua
                if ($currentImage) {
                    $this->deleteClientImage($currentImage);
                }

                // Faça o upload da nova foto
                $name = Str::kebab($request->name);
                $extension = $request->file('photo')->extension();
                $nameFile = "{$name}.{$extension}";

                $upload = $request->photo->storeAs($this->path, $nameFile);

                if (!$upload) {
                    return null;
                }

                return $nameFile;
            }

            return $currentImage;
        } catch (\Exception $e) {
            Log::error('Erro durante o upload da imagem: '.$e->getMessage());

            return null;
        }
    }
}
