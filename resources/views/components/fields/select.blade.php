{{ Form::select($field['name'], $field['value'] ?? [], null, [
    'id' => $id,
    'class' => 'form-control m-bootstrap-select m_selectpicker',
    'placeholder' => __('base.placeholder'),
    'data-live-search' => 'true'
]) }}
