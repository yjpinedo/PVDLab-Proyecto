<div class="m-portlet" style="margin-bottom: 0" id="form-portlet">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 id="formTitle" class="m-portlet__head-text m--font-brand" data-create="{{ __('base.titles.create') }}" data-name="" data-show="{{ __('base.titles.show') }}" data-update="{{ __('base.titles.update') }}"></h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                @yield('form_tools')
            </ul>
        </div>
    </div>
    @yield('form')
</div>
