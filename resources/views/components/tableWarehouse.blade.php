<div class="m-loader m-loader--brand table-loader" style="display: inline-block; width: 100%;"></div>
<table class="table table-striped- table-bordered table-hover table-checkable m--hide table-component ajax" id="table">
    <thead>
    <tr>
        @foreach($fields as $field)
            <th name="{{ $field }}">{{__('validation.attributes.' . $field)}}</th>
        @endforeach
    </tr>
    </thead>
</table>
