<div class="invalid-feedback">
    {{-- Validation, show error in input, first check if there is error--}}
    @if($errors->has($field))
        {{ $errors->get($field)[0] }}
    @endif
</div>