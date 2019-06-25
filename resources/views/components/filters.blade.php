@if(!empty($fields))
    @if(count($fields) <= 6)
        <div id="filters" class="m--hide">
            @component('components.form', [
                'button' => [
                    'type' => 'button',
                    'text' => __('base.buttons.filters')
                ],
                'crud' => $crud,
                'fields' => $fields,
                'id' => 'filters',
                'size' => 'col-sm-6 col-md-4',
                'suffix' => 'filter'
            ])@endcomponent
        </div>
    @else
        <div id="filters" class="m--hide">
            {{Form::open(['id' => 'filters_form'])}}
            <div>
                <div class="row">
                    @component('components.fields', [
                       'crud' => $crud,
                       'fields' => array_slice($fields, 0, 6),
                       'size' => 'col-sm-6 col-md-4',
                       'suffix' => 'filter'
                    ])@endcomponent
                </div>
            </div>
            <div id="filters_more" class="m--hide">
                <div class="row">
                    @component('components.fields', [
                       'crud' => $crud,
                       'fields' => array_slice($fields, 6),
                       'size' => 'col-sm-6 col-md-4',
                       'suffix' => 'filter'
                    ])@endcomponent
                </div>
            </div>
            <div class="form-group col-12">
                <a id="filters_more_bottom" class="m-link" rel="noreferrer">{{__('cruds/base.buttons.filters_more')}}</a>
            </div>
            <div class="form-group col-12">
                {{Form::button(__('base.buttons.filters'), [
                    'class' => 'btn btn-primary btn-block',
                    'id' => 'filters_form_button'
                ])}}
            </div>
            {{Form::close()}}
        </div>
    @endif
@else
    <div id="filters_general">
        <div class="row">
            <div class="form-group @if($active)col-md-8 @else col-12 @endif ">
                {{Form::text('search', null, [
                    'id' => 'search_filter',
                    'class' => 'form-control',
                    'placeholder' => __('validation.attributes.search'),
                    'autofocus' => true
                ])}}
            </div>
            @if($active)
                <div class="form-group col-md-4">
                    {{Form::select('enabled', __('base.selects.active'), null, [
                        'id' => 'enabled_filter',
                        'class' => 'form-control m-bootstrap-select m_selectpicker',
                        'data-live-search' => 'true'
                    ])}}
                </div>
            @endif
        </div>
    </div>
@endif
