<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\MieClassi\AlertMessage2;
use App\Http\MieClassi\DatiRitorno;
use App\Models\File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartellaFiles;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CartellaFilesController extends Controller
{
    protected $conFiltro = false;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $cartellaId = 0)
    {
        $nomeClasse = get_class($this);


        if ($request->ajax()) {
            $cartelleQb = $this->applicaFiltriCartelle($request);
            $filesQb = $this->applicaFiltriFiles($request);

            return [
                'html' => base64_encode(view('Backend.CartellaFiles.elenchi', [
                    'cartelle' => $cartelleQb->withCount('files')->get(),
                    'files' => $filesQb->get(),
                    'controller' => $nomeClasse,
                    'cartellaId' => $cartellaId,
                    'cartellePrev' => []
                ]))
            ];

        }

        if (!$cartellaId) {
            $cartelleQb = CartellaFiles::whereIsRoot();
            $cartellePrev = [];
        } else {
            $cartella = CartellaFiles::find($cartellaId);
            $cartelleQb = CartellaFiles::whereDescendantOf($cartella);
            $cartellePrev = CartellaFiles::ancestorsAndSelf($cartellaId);
        }

        $cartelleQb->orderBy('nome');

        return view('Backend.CartellaFiles.index_new', [
            'cartellaId' => $cartellaId,
            'files' => File::where('cartella_id', $cartellaId)->orderBy('filename_originale')->get(),
            'cartelle' => $cartelleQb->withCount('files')->get(),
            'controller' => $nomeClasse,
            'titoloPagina' => 'Elenco ' . \App\Models\CartellaFiles::NOME_PLURALE,
            'ordinamenti' => null,// $ordinamenti,
            'filtro' => $filtro ?? 'tutti',
            'conFiltro' => $this->conFiltro,
            'testoNuovo' => 'Nuova cartella',
            'testoCerca' => 'Cerca nel nome',
            'cartellePrev' => $cartellePrev

        ]);


    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function applicaFiltriCartelle($request)
    {

        $queryBuilder = \App\Models\CartellaFiles::orderBy('nome');
        $term = $request->input('cerca');
        if ($term) {
            $arrTerm = explode(' ', $term);
            foreach ($arrTerm as $t) {
                $queryBuilder->where(DB::raw('concat_ws(\' \',nome)'), 'like', "%$t%");
            }
        }

        return $queryBuilder;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function applicaFiltriFiles($request)
    {

        $queryBuilder = \App\Models\File::orderBy('filename_originale');
        $term = $request->input('cerca');
        if ($term) {
            $arrTerm = explode(' ', $term);
            foreach ($arrTerm as $t) {
                $queryBuilder->where(DB::raw('concat_ws(\' \',filename_originale)'), 'like', "%$t%");
            }
        }

        return $queryBuilder;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($cartellaId)
    {
        $record = new CartellaFiles();
        return view('Backend.CartellaFiles.edit', [
            'record' => $record,
            'titoloPagina' => 'Nuova cartella',
            'controller' => get_class($this),
            'cartellaId' => $cartellaId,
            'action' => 'store',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $cartellaId)
    {
        $cartellaId = $cartellaId == 0 ? null : $cartellaId;
        $request->validate($this->rules(null));
        $record = new CartellaFiles();
        $record->parent_id = $cartellaId;
        $this->salvaDati($record, $request);
        CartellaFiles::fixTree();
        $datiRitorno = new DatiRitorno();

        $datiRitorno->redirect(action([CartellaFilesController::class, 'index'], $cartellaId));

        return $datiRitorno->getArray();

        $html = view('Backend.CartellaFiles.elencoCartelle', [
            'records' => $this->applicaFiltriCartelle($request)->paginate(),
            'controller' => get_class($this),
            'redirect' => true,
            'cartellaId' => null

        ]);
        return $datiRitorno->chiudiDialog(true)->oggettoReload('cartelle', $html)->getArray();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if (\request()->ajax()) {

            $filesQb = File::query()->orderBy('filename_originale');
            if ($request->has('cerca')) {
                $term = $request->input('cerca');
                $filesQb->whereRaw('filename_originale like ?', "%$term%");
                $filtro = true;
            } elseif ($id > 0) {
                $filtro = false;
                $filesQb->where('cartella_id', $id);
            }

            $datiRitorno = new DatiRitorno();
            $html = view('Backend.CartellaFiles.elencoFiles', [
                'files' => $filesQb->get(),
                'cartellaId' => $id,
                'controller' => get_class($this),
                'reload' => true,
            ]);
            return $datiRitorno->oggettoReload('aa', $html)->id($id)->getArray();
        }


        $record = CartellaFiles::find($id);
        abort_if(!$record, 404, 'Questa cartellafiles non esiste');
        return view('Backend.CartellaFiles.show', [
            'record' => $record,
            'controller' => CartellaFilesController::class,
            'titoloPagina' => CartellaFiles::NOME_SINGOLARE,
            'breadcrumbs' => [action([CartellaFilesController::class, 'index']) => 'Torna a elenco ' . CartellaFiles::NOME_PLURALE]

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cartellaId, $id)
    {
        $record = CartellaFiles::withCount('files')->withCount('descendants')->find($id);
        abort_if(!$record, 404, 'Questa cartellafiles non esiste');
        if ($record->files_count || $record->descendants_count) {
            $eliminabile = 'Non eliminabile perchè non vuota';
        } else {
            $eliminabile = true;
        }
        return view('Backend.CartellaFiles.edit', [
            'record' => $record,
            'controller' => CartellaFilesController::class,
            'titoloPagina' => 'Modifica ' . CartellaFiles::NOME_SINGOLARE,
            'eliminabile' => $eliminabile,
            'action' => 'edit',
            'cartellaId' => $cartellaId


        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cartellaId, $id)
    {

        $record = CartellaFiles::find($id);
        abort_if(!$record, 404, 'Questa ' . CartellaFiles::NOME_SINGOLARE . ' non esiste');
        $request->validate($this->rules($id));
        $this->salvaDati($record, $request);
        $datiRitorno = new DatiRitorno();

        $datiRitorno->redirect(action([CartellaFilesController::class, 'index'], $cartellaId));

        return $datiRitorno->getArray();

        $html = view('Backend.CartellaFiles.elencoCartelle', [
            'records' => $this->applicaFiltriCartelle($request)->paginate(),
            'controller' => get_class($this),
            'reload' => true,
            'cartellaId' => null

        ]);
        return $datiRitorno->chiudiDialog(true)->oggettoReload('cartelle', $html)->getArray();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cartellaId, $id)
    {
        $record = CartellaFiles::find($id);
        abort_if(!$record, 404, 'Questa cartellafiles non esiste');

        $record->delete();


        return [
            'success' => true,
            'redirect' => action([CartellaFilesController::class, 'index']),
        ];
    }


    public function upload(Request $request, $cartellaId)
    {
        if ($request->file('file')) {
            $file = new File();
            $filePath = $request->file('file');
            $estensione = $filePath->extension();
            $fileName = Str::ulid() . '.' . $estensione;
            $cartella = config('configurazione.file_manager.cartella');
            $request->file('file')->storeAs($cartella, $fileName);
            $file->cartella_id = $cartellaId;
            $file->path_filename = $cartella . '/' . $fileName;
            $file->filename_originale = $filePath->getClientOriginalName();
            $file->dimensione_file = $filePath->getSize();
            $file->save();

            return response()->json(['success' => true, 'id' => $file->id, 'filename' => $fileName]);

        }

    }

    public function cancellaFile(Request $request)
    {
        $id = $request->input('id');
        $record = File::find($id);
        if (!$record) {
            abort(404, 'Questo file non esiste.');
        }
        $record->delete();
        $datiRitorno = new DatiRitorno();
        return $datiRitorno->rimuoviOggetto('#file_' . $id)->getArray();


    }

    public function download($id)
    {
        $record = File::find($id);
        abort_if(!$record, 404);
        return response()->download(Storage::path($record->path_filename), $record->filename_originale);
    }


    /**
     * @param CartellaFiles $model
     * @param Request $request
     * @return mixed
     */
    protected function salvaDati($model, $request)
    {

        $nuovo = !$model->id;

        if ($nuovo) {
        }

        //Ciclo su campi
        $campi = [
            'nome' => 'app\getInputUcwords',
        ];
        foreach ($campi as $campo => $funzione) {
            $valore = $request->$campo;
            if ($funzione != '') {
                $valore = $funzione($valore);
            }
            $model->$campo = $valore;
        }

        $model->save();
        return $model;
    }

    protected function backToIndex()
    {
        return redirect()->action([get_class($this), 'index']);
    }

    /** Query per index
     * @return array
     */
    protected function queryBuilderIndexSemplice()
    {
        return \App\Models\CartellaFiles::get();
    }


    protected function rules($id = null)
    {


        $rules = [
            'nome' => ['required', 'max:255'],
        ];

        return $rules;
    }

}
