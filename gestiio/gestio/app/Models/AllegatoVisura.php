<?php

namespace App\Models;

use App\Http\Funzioni\FunzioniAllegato;
use App\Http\Funzioni\ThumbnailGenerationService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AllegatoVisura extends Model
{
    use FunzioniAllegato;

    protected $table = 'visure_allegati';

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::saving(function ($model) {
            $estensione = strtolower(pathinfo($model->filename_originale, PATHINFO_EXTENSION));
            $model->tipo_file = self::tipoFile($estensione);

            $thumbnailGenerationService = new ThumbnailGenerationService();
            $thumbnailPath = $thumbnailGenerationService->generate($model->path_filename, $model->tipo_file, 500, 500);
            $model->thumbnail = $thumbnailPath;

        });

        static::deleting(function ($model) {
            \Storage::delete($model->path_filename);
            \Log::debug('deleting;');
            if ($model->thumbnail) {
                \Storage::delete($model->thumbnail);
            }

        });
    }

    public static function perBlade($uid, $id, $perCliente = 0)
    {

        $qb = self::where(function ($q) use ($uid, $id) {
            $q->where('uid', $uid);
            if ($id) {
                $q->orWhere('visura_id', $id);
            }
        });

        $qb->where('per_cliente', $perCliente);


        return $qb->get(['id', 'path_filename', 'dimensione_file', 'thumbnail'])->toArray();
    }


}
