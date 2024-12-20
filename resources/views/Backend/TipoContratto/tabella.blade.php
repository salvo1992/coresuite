<div class="table-responsive">
    <table class="table table-row-bordered" id="tabella-elenco">
        <thead>
        <tr class="fw-bolder fs-6 text-gray-800">
            <th class="">Nome</th>
            <th class="">Gestore</th>
            <th class="text-center">Durata contratto</th>
            <th class="text-center">Attivo</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($records as $record)
            <tr class="">
                <td class="">{{$record->nome}}</td>
                <td class="" style="color: {{$record->gestore?->colore_hex}};">
                    @if($record->gestore_id)
                        {{$record->gestore->nome}}
                    @endif
                </td>
                <td class="text-center">
                    @if($record->durata_contratto)
                        {{\App\singolareOplurale($record->durata_contratto,'mese','mesi')}}
                    @endif
                </td>

                <td class="text-center">
                    @if($record->attivo)
                        <i class="fas fa-check fs-3" style="color: #26C281;"></i>
                    @endif
                </td>

                <td class="text-end text-nowrap">
                    <a data-targetZ="kt_modal" data-toggleZ="modal-ajax"
                       class="btn btn-sm btn-light btn-active-light-primary"
                       href="{{action([$controller,'edit'],$record->id)}}">Modifica</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@if($records instanceof \Illuminate\Pagination\LengthAwarePaginator )
    <div class="w-100 text-center">
        {{$records->links()}}
    </div>
@endif
