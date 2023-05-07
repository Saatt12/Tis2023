@extends('layouts.client')

@section('content-admin')
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-8 col-md-8 col-lg-7">
                <div class="bg-red-cherry text-white py-3">
                    <h4 class="text-center mb-0">Chat</h4>
                </div>
                <div class="content-chat position-relative">
                    <div id="body-chat" class="chat-body">
                        @foreach($messages as $message)
                            @if($message->sender_id === auth()->id())
                            <div class="right-content-chat my-2">
                                <div class="content-message p-3">
                                    {{$message->content}}
                                 </div>
                            </div>
                            @else
                            <div class="left-content-chat my-2">
                                <div class="content-message p-3">
                                    {{$message->content}}
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="footer-chat position-absolute pe-3">
                        <hr class="m-0">
                        <form class="bg-white" action="{{route('claim.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="bg-white w-100 py-2 d-flex">
                                <input autocomplete="off" name="message" type="text" class="bg-pick-chat rounded-pill px-3 flex-grow-1">
                                <label for="message-file" class="bg-white">
                                    <img src="{{asset('images/upload_file.png')}}" alt="">
                                </label>
                                <input id="message-file" type="file" name="file" class="visually-hidden">
                                <button type="submit" class="btn-icon bg-white">
                                    <img src="{{asset('images/icon_send_message.png')}}" alt="">
                                </button>

                            </div>
                            <div class="row justify-content-center ">
                                <div class="col-4">
                                    <a href="{{url('/client')}}" class="btn btn-primary bg-blue-dark"> Cerrar </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#body-chat').scrollTop($(document).height());
        });
    </script>
@endsection
