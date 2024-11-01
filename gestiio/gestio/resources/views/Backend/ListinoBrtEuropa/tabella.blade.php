<div class="table-responsive">
    <table class="table table-row-bordered" id="tabella-elenco">
        <thead>
        <tr class="fw-bolder fs-6 text-gray-800">
            <th class="">Da peso - A peso</th>
            <th class="text-end">Gruppo A</th>
            <th class="text-end">Gruppo B</th>
            <th class="text-end">Gruppo C</th>
            <th class="text-end">Gruppo D</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($records as $record)
            <tr class="">
                <td class="">{{number_format($record->da_peso,1,',','.')}}
                    - {{number_format($record->a_peso,1,',','.')}}</td>
                <td class="text-end">{{\App\importo($record->gruppo_a)}}</td>
                <td class="text-end">{{\App\importo($record->gruppo_b)}}</td>
                <td class="text-end">{{\App\importo($record->gruppo_c)}}</td>
                <td class="text-end">{{\App\importo($record->gruppo_d)}}</td>

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
