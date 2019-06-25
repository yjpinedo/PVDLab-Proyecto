<div class="m-portlet" style="margin-bottom: 0" id="table-portlet">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption"></div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                @yield('table_tools')
            </ul>
        </div>
    </div>
    <div class="m-portlet__body m--padding-10">
        @yield('filters')
        @yield('table')
    </div>
</div>
