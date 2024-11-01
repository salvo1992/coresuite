<div class="card card-flush {{$altezza}}">
    <div class="card-header pt-5">
        <h3 class="card-title text-gray-800 fw-bold">Links Gestori</h3>
        <div class="card-toolbar">
        </div>
    </div>
    <div class="card-body card-scroll pt-5">
        @foreach(\App\Http\MieClassiCache\CacheGestoriDashboard::get(Auth::id()) as $record)
            <div class="d-flex flex-stack">
                <a href="{{$record->url}}" target="_blank" class="fw-semibold fs-6 me-2" style="color: {{$record->colore_hex}};">{{$record->nome}}</a>
                <a href="{{$record->url}}" target="_blank" class="btn btn-icon btn-sm h-auto btn-color-gray-400 btn-active-color-primary justify-content-end">
                    <span class="svg-icon svg-icon-2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3"
                                  d="M4.7 17.3V7.7C4.7 6.59543 5.59543 5.7 6.7 5.7H9.8C10.2694 5.7 10.65 5.31944 10.65 4.85C10.65 4.38056 10.2694 4 9.8 4H5C3.89543 4 3 4.89543 3 6V19C3 20.1046 3.89543 21 5 21H18C19.1046 21 20 20.1046 20 19V14.2C20 13.7306 19.6194 13.35 19.15 13.35C18.6806 13.35 18.3 13.7306 18.3 14.2V17.3C18.3 18.4046 17.4046 19.3 16.3 19.3H6.7C5.59543 19.3 4.7 18.4046 4.7 17.3Z"
                                  fill="currentColor"/>
                            <rect x="21.9497" y="3.46448" width="13" height="2" rx="1" transform="rotate(135 21.9497 3.46448)"
                                  fill="currentColor"/>
                            <path d="M19.8284 4.97161L19.8284 9.93937C19.8284 10.5252 20.3033 11 20.8891 11C21.4749 11 21.9497 10.5252 21.9497 9.93937L21.9497 3.05029C21.9497 2.498 21.502 2.05028 20.9497 2.05028L14.0607 2.05027C13.4749 2.05027 13 2.52514 13 3.11094C13 3.69673 13.4749 4.17161 14.0607 4.17161L19.0284 4.17161C19.4702 4.17161 19.8284 4.52978 19.8284 4.97161Z"
                                  fill="currentColor"/>
                        </svg>
                    </span>
                </a>
            </div>
            <div class="separator separator-dashed my-3"></div>
        @endforeach
    </div>
</div>
