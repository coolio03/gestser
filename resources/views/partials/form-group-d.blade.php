<div class="col-sm-6">
    <div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
        <label for="{{$name}}">{{$title}}</label>
        <input id="{{$name}}" type="{{$type}}" class="form-control {{$errors->has($name)? 'is-invalid' : ''}} " name="{{$name}}"
        value="{{ old($name, isset($value) ? $value : '') }}" disabled>
        @if ($errors->has($name))
            <div class="invalid-feedback">
                {{ $errors->first($name) }}
            </div>
        @endif
    </div>
</div>