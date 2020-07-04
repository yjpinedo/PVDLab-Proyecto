<div class="m-portlet" id="table-portlet">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text m--font-brand">{{ __('app.titles.warehouses') }}</h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                @yield('toolsWarehouse')
            </ul>
        </div>
    </div>
    <div class="m-portlet__body m--padding-10">
        @yield('tableWarehouse')
    </div>
</div>
