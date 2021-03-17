<div class="modal fade" id="{{ $data_target_id }}" tabindex="0" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __($title_message) }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">{{ $message }}</div>
            <div class="modal-footer">
                <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>
                <a class="btn btn-danger" href="{{ route($route, $params ?? '' ) }}" onclick="event.preventDefault(); document.getElementById('{{ $form_id }}').submit();">{{ __($button_text) }}</a>
                <form id="{{ $form_id }}" action="{{ route($route,$params ?? '' )}}" method="POST" style="display: none;">
                    @csrf
                    @isset($method)
                        @method($method)
                    @endisset
                </form>
            </div>
        </div>
    </div>
</div>
