<?php

namespace Tests\Feature\Trait;

use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait Utils
{
    protected function createFakeImage(Faker $faker, $width = 640, $height = 480)
    {
        // Gere um nome de arquivo aleatório
        $imageName = Str::random(10).'.png';

        // Gere um conteúdo de imagem falso usando o Faker
        $imageContent = $faker->image(null, $width, $height);

        // Crie uma instância UploadedFile para simular o upload de imagem
        $image = new UploadedFile(
            $imageContent,
            $imageName,
            'image/png',
            null,
            true
        );

        // Crie um caminho completo para o arquivo no armazenamento local temporário
        $path = 'temp/'.$imageName;

        // Salve o conteúdo no armazenamento local temporário
        Storage::disk('local')->put($path, file_get_contents($image->path()));

        return $image;
    }
}
