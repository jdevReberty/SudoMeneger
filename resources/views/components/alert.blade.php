<div class="text-danger">
    <div class="adu ako aqt">
        <div class="jw">
            {{-- <h3 class="awa awe aze"> {{ $errorCount != 0 ? ("A ". $errorCount." encontrados") : "" }}</h3> --}}
            <div class="lb awa azd">
                @foreach ($errors->messages() as $key => $error)
                    <p>{{$error[0]}}</p>
                @endforeach
                {{--  --}}
            </div>
        </div>
    </div>
</div>
