@extends('layouts.admin')
{{--@section('subhead-custom')
<div class="d-flex">
    <form action="{{route('search_request')}}" method="POST">
        @csrf
        <input type="search" name="keyword" value="{{@$keyword}}">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
</div>
@endsection--}}

@section('content-admin')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{url('/conversation_emails')}}" class="btn btn-primary my-2">Enviar Mensajess </a>
    <table class="table table-striped table-blue-light">
        <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">CI</th>
            <th scope="col">Email</th>
            <th scope="col">
                <button onclick="selectedAll()" type="button" class="btn btn-primary bg-blue-dark">
                    Seleccionar Todo
                </button>
                <button
                    type="button"
                    class="btn btn-primary bg-blue-dark"
                    data-bs-toggle="modal"
                    data-bs-target="#reject-modal"
                    onclick="addDataChecks('conversations_requests')"
                >
                    Eliminar
                </button>
            </th>

        </tr>
        </thead>
        <tbody>
        @foreach($conversations as $conversation)
            <tr>
                <td>{{$conversation->receiver_id!==auth()->user()->id?$conversation->receiver->name:$conversation->sender->name}}</td>
                <td>{{$conversation->receiver_id!==auth()->user()->id?$conversation->receiver->ci:$conversation->sender->ci}}</td>
                <td>{{$conversation->receiver_id!==auth()->user()->id?$conversation->receiver->email:$conversation->sender->email}}</td>
                <td>
                    <div class="row justify-content-center">
                        <div class="col-3">
                            <a
                                href="{{url('/conversations_messages/'.$conversation->id)}}"
                                class="text-blue-dark text-decoration-none"
                            > Ver </a>
                        </div>
                        <div class="col-1">
                    <input type="checkbox" name="items[]" value="{{$conversation->id}}" class="form-check-input">

                        </div></div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <x-generic-modal name="reject-modal" title="Confirmar">
        <x-slot name="content" class="">
            <form action="{{ route('conversation_emails.delete') }}" method="POST">
                @csrf
                @method('DELETE')
                <p>
                    ¿Deseas eliminar estos reclamos?
                </p>
                <input type="hidden" id="conversations_requests" name="conversation_ids">
                <div class="row justify-content-center">
                    <div class="col-4">
                        <button type="button" class="btn btn-secondary bg-blue-dark"
                                data-bs-dismiss="modal">Cerrar</button>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-secondary bg-blue-dark"
                                data-bs-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </form>
        </x-slot>
        <x-slot name="buttons" class=""></x-slot>
    </x-generic-modal>
    </div>
@endsection
@section('scripts')
    <script>
        function selectedAll(){
            $('input[type="checkbox"]').prop('checked', true);
        }
        function addDataChecks(name='selected_checks'){
            let checked = []
            $("input[name='items[]']:checked").each(function ()
            {
                checked.push(parseInt($(this).val()));
            });
            $('#'+name).val(checked.join(','));
        }
    </script>
@endsection
