{{ Form::text($field['name'], null, [
    'id' => $id,
    'class' => 'form-control ' . $field['format'] ?? 'datepicker',
    'data-provide' => 'datepicker',
    'style' => 'width: 100%',
    'autocomplete' => 'off'
]) }}
