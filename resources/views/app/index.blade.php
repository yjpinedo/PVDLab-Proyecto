@extends((!empty($form ?? []) and !empty($table ?? [])) ? 'layouts.crud' : (!empty($table ?? []) ? 'layouts.table' : 'layouts.form'))

@section('title', $title ?? null)

@section('subtitle', $subtitle ?? null)

@section('subtitle_form', $subtitle_form ?? null)

@if(!empty($table ?? []))
@section('table_tools')
    @component('components.tools', [
        'crud' => $crud,
        'reload' => $tools['reload'] ?? false,
        'filters' => !empty($filters ?? []),
        'massive' => !empty($massive ?? []),
        'active' => $table['active'] ?? false,
        'export' => $tools['export'] ?? false,
        'import' => $tools['import'] ?? false,
        'create' => $tools['create'] ?? false and !empty($form),
    ])@endcomponent
@endsection

@section('filters')
    @component('components.filters', [
        'crud' => $crud,
        'active' => $table['active'] ?? false,
        'fields' => $filters ?? [],
    ])@endcomponent
@endsection

@section('table')
    @component('components.table', [
        'check' => $table['check'] ?? false,
        'fields' => $table['fields'] ?? [],
        'active' => $table['active'] ?? false,
        'actions' => $table['actions'] ?? false,
    ])@endcomponent
@endsection
@endif

@if(!empty($form ?? []))
    @section('form_tools')
        @component('components.tools', [
            'crud' => $crud,
            'edit' => $tools['edit'] ?? false,
        ])@endcomponent
    @endsection

    @section('form')
        @component('components.wizard', [
            'crud' => $crud,
            'fields' => $form ?? [],
        ])@endcomponent
    @endsection
@endif

@push('scripts')
    @include('includes.scripts')
    @if (file_exists('js/app/' . $crud . '.js'))
        <script type="text/javascript" src="{{ asset('js/app/' . $crud . '.js') }}" defer></script>
    @endif
@endpush
