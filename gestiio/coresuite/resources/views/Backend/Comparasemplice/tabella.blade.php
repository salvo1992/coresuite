<div class="table-responsive">
    <table class="table table-row-bordered" id="tabella-elenco">
        <thead>
        <tr class="fw-bolder fs-6 text-gray-800">
            <th class="">Data</th>
            <th class="">Esito</th>
            <th class="">Nominativo</th>
            <th class="">Email</th>
            <th class="">Agente</th>
            <th class="">Pagato</th>
            <th class="text-center">Azioni</th>
        </tr>
        </thead>
        <tbody>
        @include('Backend.Comparasemplice.tbody')
        </tbody>
    </table>
</div>
@if($records instanceof \Illuminate\Pagination\LengthAwarePaginator )
    <div class="w-100 text-center">
        {{$records->links()}}
    </div>
@endif
