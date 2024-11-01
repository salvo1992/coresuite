<div class=" mb-6" id="div_{{$campo}}">
    <label class="fw-bold fs-6 @if($required??false) required @endif" for="{{$campo}}" id="label_{{$campo}}">{{$testo}}</label>
    @if($tooltip??false)
        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="{{$tooltip}}" aria-label="{{$tooltip}}"></i>
    @endif
    <input type="text" id="{{$campo}}" name="{{$campo}}" class="form-control bg-transparent {{$classe??''}}" placeholder="{{$placeholder??''}}"
           value="{{ old($campo,$record->$campo) }}" data-required="{{$required??''}}"
           @if($required??false) required @endif
           autocomplete="{{$autocomplete??''}}"
            {!! $altro??'' !!}
    >
    @if($help??false)
        <div class="form-text">{{$help}}</div>
    @endif
    @includeWhen($include??false,$include??'')
    <div class="fv-plugins-message-container invalid-feedback">
        @error($campo)
        {{$message}}
        @enderror
    </div>
</div>

