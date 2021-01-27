<div class="form-group" >
        <div class="row">
            <label for="{{$name}} " class="col-md-3">{{$title}}</label>
            <div class="col-md-6"><input id="{{$name}}" type="{{$type}}" name="{{$name}}" 
                class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" 
                value="{{ old($name, isset($value) ? $value : '') }}"  required=>
                @if ($errors->has($name))
                <div class="invalid-feedback" >
                    {{ $errors->first($name) }}
                </div>
                @endif
            </div>     
            <div class="clearfix"></div>   
        </div>
        
</div>

<div class="col-sm-6">
    <div class="form-group">
        <label for="{{$name}}">{{$title}}</label>
        <input id="{{$name}}" type="{{$type}}" class="form-control{{$errors->has($name)? 'is-invalid' : ''}} " name="{{$name}}"
        value="{{ old($name, isset($value) ? $value : '') }}" placeholder="Entrer {{$title}}" value="{{ old($name, isset($value) ? $value : '') }}"
         {{ $required ? 'required' : ''}} >
        @if ($errors->has($name))
            <div class="invalid-feedback">
                {{ $errors->first($name) }}
            </div>
        @endif
    </div>
</div>