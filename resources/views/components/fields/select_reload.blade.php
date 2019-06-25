<div class="input-group">
    {{ Form::select($field['name'], [], null, [
        'id' => $id,
        'class' => 'form-control m-bootstrap-select m_selectpicker',
        'placeholder' => __('base.placeholder'),
        'data-live-search' => 'true'
    ]) }}
    <div class="input-group-append">
        {{ Form::button('<i class="fa fa-undo-alt"></i>', [
            'class' => 'btn btn-secondary select-reload',
        ]) }}
    </div>
</div>
