@extends('layouts.form')

@section('card')
    @component('admin.components.card')
        @slot('title')
            @lang('Connexion')            
        @endslot
        @isset($url)
            <form action="{{ url("login/$url") }} " method="POST">
        @else
            <form action="{{ route('login') }} " method="POST">    
        @endisset

            {{ csrf_field() }}
            @include('admin.partials.form-group', [
                'title' => __('Adresse email'),
                'type' => 'email',
                'name' => 'email',
                'required' => true,
                ])
           @include('admin.partials.form-group', [
            'title' => __('Mot de passe'),
            'type' => 'password',
            'name' => 'password',
            'required' => true,
            ])
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input"
                id="remember" name="remember" {{ old('remember') ?'checked' : '' }}>
                <label class="custom-control-label" for="remember"> 
                    @lang('Se rappeler de moi')
                </label>
            </div>
            @component('admin.components.button')
                @lang('Connexion')
            @endcomponent
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    @lang('Mot de passe oublié ?')
                </a>
            </form>
    @endcomponent
@endsection
