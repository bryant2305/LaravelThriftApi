<?php

namespace App\Tools;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Exceptions\SomethingWentWrong;
use Illuminate\Support\Facades\Storage;

trait MinioBucketTrait
{
    public function upload(Request $request, $fileName, $prefix = 'PNB')
    {

        if (!$request->file($fileName)) {
            return $file = array(
                "name" => null,
                "url" => null,
                "ext" => null,
                "size" => null,
                "type" => null
            );
        }

        try {
            // Initialize Minio Storage
            $disk = Storage::disk('minio');
            $user = auth()->user()->id; //Nuevo para Evitar Duplicidad en Congestion
            $name = strtoupper($prefix . $user . "-" . Carbon::now()->format('Y-m-d') . "-" . time() . "." . $request->file($fileName)->getClientOriginalExtension());


            $disk->put(env('MINIO_FOLDER') . '/' . $name, file_get_contents($request->file($fileName)));
            $url = env('MINIO_BUCKET') . "/" . env('MINIO_FOLDER') . '/' . $name;

            $file = array(
                "name" => $name,
                "url" => $disk->url($url),
                "ext" => $request->file($fileName)->getClientOriginalExtension(),
                "size" => $request->file($fileName)->getSize(),
                "type" => $request->file($fileName)->getType(),
            );

            return $file;
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }
}
