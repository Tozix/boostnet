@extends('admin.main')
@section('admincontent')
<div class="col-md-12">
    <h4> Генератор конфига для VPN</h4>
    <hr>
    <form method="POST" action="">
        <div class="form-group row">
            <label for="server_id" class="col-sm-2 col-form-label text-md-right">{{ __('Сервер') }}</label>
            <div class="col-md-2">
                <select class="form-control" id="server_id" name="server_id">
                    @foreach($server as $item)
                    <option value="{{$item->id}}" {{ $item->id ===  $server_id  ? 'selected' : '' }}>{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" name="internet" id="internet" {{  $internet ===  'on' ? 'checked="""' : '' }}>
                    <label class="custom-control-label" for="internet">Интернет</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="tunnel" name="tunnel" {{  $tunnel ===  'on'  ? 'checked="""' : '' }}>
                    <label class="custom-control-label" for="tunnel">Туннель</label>
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">
                    {{ __('Генерировать') }}
                </button>
            </div>
        </div>
        @csrf
        @if(session('success'))
        <div class="form-group">
            <label for="conf">Конфиг</label>
            <textarea readonly class="form-control" id="conf" rows="3"
                style="height: 259px;">{!! session('success') !!}</textarea>
        </div>
        @endif
    </form>
                        @if(session('success'))
                        <div class="form-group row text-center">
                            <div class="col-12">
                                <button onclick="copy()" type="submit" class="btn btn-primary">
                                    {{ __('Скопировать') }}
                                </button>

                            </div>
                        </div>
                        @endif

</div>
@push('scripts')
<script>
function copy() {
  let textarea = document.getElementById("conf");
  textarea.select();
  document.execCommand("copy");
  alert('Скопированно в буффер обмена')
}
 </script>
@endpush
@endsection