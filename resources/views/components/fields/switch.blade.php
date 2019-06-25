{{ Form::checkbox($field['name'], 1, false, [
    'id' => $id,
    'class' => 'switch',
    'data-switch' => 'true',
    'data-size' => 'small',
    'data-on-text' => __('base.selects.switch.yes'), 'data-off-text' => __('base.selects.switch.no'),
]) }}
