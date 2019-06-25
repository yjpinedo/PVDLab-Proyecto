<div class="m-checkbox-list">
    @foreach($field['value'] as $value)
        <label class="m-checkbox m-checkbox--solid m-checkbox--brand">
            {{ Form::checkbox($value, 1, false, ['id' => $id]) }}{{ __($route . $value) }}<span></span>
        </label>
    @endforeach
</div>
