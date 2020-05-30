@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Как с нами связаться</div>

                <div class="card-body">

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">Группа в контакте</label>

                            <div class="col-md-6">
                                
<script type="text/javascript" src="https://vk.com/js/api/openapi.js?159"></script>

<!-- VK Widget -->
<div id="vk_groups"></div>
<script type="text/javascript">
VK.Widgets.Group("vk_groups", {mode: 1}, 173224258);
</script>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Адрес') }}</label>

                            <div class="col-md-6">
support@boostnet.ru
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Whatsup</label>

                            <div class="col-md-6">

                                 
                                       +79528801390
                                

                            </div>
                        </div>

            </div>
        </div>
    </div>
</div>
@endsection
