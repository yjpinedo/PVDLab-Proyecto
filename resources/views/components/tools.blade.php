@if($reload ?? false)
    <li class="m-portlet__nav-item">
        <a onclick="update()"
           data-toggle="m-tooltip" data-original-title="{{ __('base.buttons.reload') }}"
           class="m-portlet__nav-link btn btn-lg btn-secondary m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill">
            <i class="fa fa-sync-alt m--font-brand"></i>
        </a>
    </li>
@endif

@if($filters ?? false)
    <li class="m-portlet__nav-item">
        <a id="filters_bottom"
           data-toggle="m-tooltip" data-original-title="{{ __('base.buttons.filters') }}"
           class="m-portlet__nav-link btn btn-lg btn-secondary m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill">
            <i class="fa fa-filter m--font-brand"></i>
        </a>
    </li>
@endif

@can($crud . '.update')
    @if($edit ?? false)
        <li class="m-portlet__nav-item">
            <a id="formReset"
               data-toggle="m-tooltip" data-original-title="{{ __('base.buttons.cancel') }}"
               class="m-portlet__nav-link btn btn-lg btn-secondary m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill">
                <i class="fa fa-times m--font-brand"></i>
            </a>
        </li>
        <li class="m-portlet__nav-item">
            <a id="formButton"
               data-toggle="m-tooltip" data-original-title="{{ __('base.buttons.edit') }}" data-action="create" data-show="{{ __('base.buttons.edit') }}" data-store="{{ __('base.buttons.store') }}" data-update="{{ __('base.buttons.update') }}"
               class="m-portlet__nav-link btn btn-lg btn-secondary m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill">
                <i class="fa fa-edit m--font-brand"></i>
            </a>
        </li>
    @endif

    @if($massive ?? false or $active ?? false)
        <li class="m-portlet__nav-item">
            <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                <a id="massiveButton" data-toggle="m-tooltip" data-original-title="{{ __('base.buttons.massive') }}" data-message="{{ __('base.messages.massive') }}"
                   class="m-portlet__nav-link btn btn-lg btn-secondary m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill m-dropdown__toggle">
                    <i class="fa fa-check-square m--font-brand"></i>
                </a>
                <div class="m-dropdown__wrapper">
                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                    <div class="m-dropdown__inner">
                        <div class="m-dropdown__body">
                            <div class="m-dropdown__content">
                                <ul class="m-nav">
                                    @if($active ?? false)
                                        <li class="m-nav__item">
                                            <a href="javascript:" class="m-nav__link" onclick="openMassive(active, 1)">
                                                <i class="m-nav__link-icon la la-check-circle"></i>
                                                <span class="m-nav__link-text">{{ __('base.buttons.activate') }}</span>
                                            </a>
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="javascript:" class="m-nav__link" onclick="openMassive(active, 0)">
                                                <i class="m-nav__link-icon la la-times-circle"></i>
                                                <span class="m-nav__link-text">{{ __('base.buttons.deactivate') }}</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    @endif
@endcan

@if($export ?? false)
    <li class="m-portlet__nav-item">
        <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
            <a data-toggle="m-tooltip" data-original-title="{{ __('base.buttons.export') }}"
               class="m-portlet__nav-link btn btn-lg btn-secondary m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill m-dropdown__toggle">
                <i class="fa fa-download m--font-brand"></i>
            </a>
            <div class="m-dropdown__wrapper">
                <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                <div class="m-dropdown__inner">
                    <div class="m-dropdown__body">
                        <div class="m-dropdown__content">
                            <ul class="m-nav">
                                <li class="m-nav__item">
                                    <a id="excelExport" href="javascript:" class="m-nav__link">
                                        <i class="m-nav__link-icon fa fa-file-excel"></i>
                                        <span class="m-nav__link-text">Excel</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
@endif

@can($crud . '.store')
    @if($import ?? false)
        <li class="m-portlet__nav-item">
            <a onclick="openModal('import_modal')"
               data-toggle="m-tooltip" data-original-title="{{ __('base.buttons.import') }}"
               class="m-portlet__nav-link btn btn-lg btn-secondary m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill m-dropdown__toggle">
                <i class="fa fa-upload m--font-brand"></i>
            </a>
        </li>
    @endif

    @if($create ?? false)
        <li class="m-portlet__nav-item">
            <a onclick="create()" data-toggle="m-tooltip" data-original-title="{{ __('base.buttons.create') }}"
               class="m-portlet__nav-link btn btn-lg btn-secondary m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill m-dropdown__toggle">
                <i class="fa fa-plus m--font-brand"></i>
            </a>
        </li>
    @endif
@endcan
