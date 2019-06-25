<div class="form-group {{ $size ?? 'col-12' }}">
    {{ Form::button($field['text'] ?? __('app.buttons.' . $field['name']), [
        'id' => $id,
        'class' => 'btn btn-primary btn-block',
    ]) }}
</div>
