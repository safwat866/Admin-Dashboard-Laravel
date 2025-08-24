@props(['type' => 'text', "name" => '', "placeholder" => "", 'id' => ""])

<div class="form-control">
  <input type="{{$type}}" name="{{$name}}" placeholder="{{$placeholder}}" value="{{old($name)}}" id="{{$id}}"
    {{$attributes->merge([
  "class" => "input " . ($errors->has($name) ? "error-input" : "")
])}} />
  @error($name)
    <span class="error-text">{{ $message }}</span>
  @enderror
</div>