@extends('Backend._layout._main')
@section('toolbar')
@endsection

@section('content')
    @php($vecchio=$record->id)
    <div class="card">
        <div class="card-body">
            @include('Backend._components.alertErrori')
            <form method="POST" action="{{action([$controller,'update'],$record->id??'')}}">
                @csrf
                @method($record->id?'PATCH':'POST')
<div class="row">
      <div class="col-md-12">
@include('Backend._inputs.inputTextAreaCol',['campo'=>'testo','testo'=>'Testo','required'=>true,'col'=>2])
       </div>
</div>
<div class="row">
      <div class="col-md-6">
@include('Backend._inputs.inputText',['campo'=>'recipients','testo'=>'Recipients','required'=>true,'autocomplete'=>'off'])
       </div>
</div>
<div class="row">
      <div class="col-md-6">
@include('Backend._inputs.inputText',['campo'=>'response','testo'=>'Response','autocomplete'=>'off'])
       </div>
</div>
<div class="row">
      <div class="col-md-6">
@include('Backend._inputs.inputText',['campo'=>'credito','testo'=>'Credito',"classe"=>"autonumericImporto"])
       </div>
</div>
<div class="row">
      <div class="col-md-6">
@include('Backend._inputs.inputText',['campo'=>'esito','testo'=>'Esito','autocomplete'=>'off'])
       </div>
</div>

                <div class="row">
                    <div class="col-md-4 offset-md-4 text-center">
                        <button class="btn btn-primary mt-3" type="submit" id="submit">{{$vecchio?'Salva modifiche':'Crea '.\App\Models\Sms::NOME_SINGOLARE}}</button>
                    </div>
                    @if($vecchio)
                        <div class="col-md-4 text-end">
                            @if($eliminabile===true)
                                <a class="btn btn-danger mt-3" id="elimina" href="{{action([$controller,'destroy'],$record->id)}}">Elimina</a>
                            @elseif(is_string($eliminabile))
                                <span data-bs-toggle="tooltip" title="{{$eliminabile}}">
                                    <a class="btn btn-danger mt-3 disabled" href="javascript:void(0)">Elimina</a>
                                </span>
                            @endif
                        </div>
                    @endif
                </div>

            </form>
        </div>
    </div>
@endsection
@push('customScript')
<script src="/assets_backend/js-miei/autoNumeric.min.js"></script>
<script>
 $(function (){
            eliminaHandler('Questa voce verrà eliminata definitivamente');
            
autonumericImporto('autonumericImporto');
});
</script>
@endpush