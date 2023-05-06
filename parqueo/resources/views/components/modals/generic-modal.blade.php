<div>
    @props([
    'content',
    'buttons'
    ])
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
                        <div class="max-height-70">
                            {{ $content }}
                        </div>
                        {{ $buttons }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
