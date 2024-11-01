<div class="table-responsive">
    <table class="table table-row-bordered" id="tabella-elenco">
        <thead>
        <tr class="fw-bolder fs-6 text-gray-800">
            <th class="">Nome</th>
            <th class="">Tipo</th>
            <th class="text-end">Prezzo cliente</th>
            <th class="text-end">Prezzo agente</th>
            <th class="text-center">Abilitato</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($records as $record)
            <tr class="">
                <td class="">{{$record->nome}}</td>
                <td class="">{{ucfirst($record->tipo_visura)}}</td>
                <td class="text-end">{{$record->prezzo_cliente}}</td>
                <td class="text-end">{{$record->prezzo_agente}}</td>
                <td class="text-center">
                    @if($record->abilitato)
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
