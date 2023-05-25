@extends('layouts.admin')

@section('content-admin')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <div class="w-100 px-3">
            <div class="row pt-3">
                <div class="col-7">
                    <img class="w-100" src="{{ asset('images/photo_parqueo.svg') }}" alt="">
                </div>
                <div class="col-5 d-flex align-items-center justify-content-center">
                    <div>
                    <div class="d-flex justify-content-center mb-4">
                        <a href="{{url('/announcements/create')}}" class="btn btn-danger bg-red-cherry me-4">Convocatoria</a>
                        <a href="{{url('/announcements')}}" class="btn btn-danger bg-red-cherry">Lista Convocatoria</a>
                    </div>
                    <div class="d-flex justify-content-center mb-4">
                        <a href="{{url('/vehicles')}}" class="btn btn-danger bg-red-cherry">Vehiculos registrados</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-content-stretch">
            @foreach ($parkings as $parking)
                <div class="col-2">
                    @if($parking->status==='unavailable')
                        <p class="text-red-cherry">{{ $parking->name }}</p>
                    @else
                        <p>{{ $parking->name }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        {{--const clients =  @json($clients);--}}
        function selectedAll(){
            $('input[type="checkbox"]').prop('checked', true);
        }
        function addDataChecks(name='selected_checks'){
            let checked = []
            $("input[name='users[]']:checked").each(function ()
            {
                checked.push(parseInt($(this).val()));
            });
            // const clients_selected = clients.filter(item=>checked.includes(item.id))
            /*const email_clients = clients_selected.map(
                item=> item.email?`<p class="text-start mb-0"> ${item.email}</p>`:''
            )*/
            $('#'+name).val(checked.join(','));
            // $('#body-chat').html(email_clients.join(''));
        }
    </script>
@endsection
