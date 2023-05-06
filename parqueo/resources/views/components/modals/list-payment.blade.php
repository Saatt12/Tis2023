<div>
    <div class="modal fade" id="{{$name}}" data-bs-backdrop="static" data-bs-keyboard="false"
         tabindex="-1" aria-labelledby="{{$name}}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-red-cherry text-pink-light justify-content-center">
                    <h1 class="modal-title fs-5 text-center" id="{{$name}}Label">{{$title}}
                    </h1>
                </div>
                <div class="modal-body">
                    <div class="text-center ">
                        <div class="row max-height-70">
                            {{ $slot }}
                            {{--@foreach ($vehicles as $key => $vehicle)
                                <div class="col-7 pb-2">
                                    {{ $vehicle->marca }} {{ $vehicle->placa }}
                                </div>
                                <div class="col-5 pb-2">
                                    <a href="" class="btn btn-secondary bg-blue-dark"
                                       data-bs-toggle="modal"
                                       data-bs-target="#vehicle_show_{{ $vehicle->id }}"> Ver </a>
                                </div>
                            @endforeach--}}
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-4">
                                <button type="button" class="btn btn-secondary bg-blue-dark"
                                        data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
