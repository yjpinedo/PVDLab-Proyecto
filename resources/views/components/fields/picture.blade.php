<div class="form-group col-12">
    <div class="m-card-profile">
        <div class="m-card-profile__pic">
            <div class="m-card-profile__pic-wrapper" style="margin: 0; width: 150px; min-height: 150px;">
                <img id="preview" style="min-width: 130px; min-height: 130px; max-width: 130px; max-height: 130px;" src="{{ $field['default'] }}" alt="Picture">
            </div>
        </div>
    </div>
    {{ Form::file($field['name'], [
        'id' => $id,
        'class' => 'form-control',
        'accept' => $field['accept'] ?? '.jpg,.jpeg'
    ]) }}
</div>
