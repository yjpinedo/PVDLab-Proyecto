@extends((!empty($form ?? []) and !empty($table ?? [])) ? 'layouts.crud' : (!empty($table ?? []) ? 'layouts.table' : 'layouts.form'))

@section('title', $title)

@section('subtitle', $subtitle ?? null)

@section('subtitle_form', $subtitle_form ?? null)

@section('tools')
    @component('components.tools', [
        'crud' => $crud,
        'create' => $crud !== 'articles' && $crud !== 'loans' && $crud !== 'beneficiary.loans' ? $tools['create'] ?? false and !empty($form) : $tools['create'] ?? false,
        'reload' => $tools['reload'] ?? false,
        'export' => $tools['export'] ?? false,
        'to_return' => $tools['to_return'] ?? false
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

@section('form')
    @component('components.wizard', [
        'crud' => $crud,
        'edit' => $tools['edit'] ?? false,
        'fields' => $form ?? [],
    ])@endcomponent
@endsection

@push('scripts')
    @include('includes.scripts')
    @if (file_exists('js/app/' . $crud . '.js'))
        <script type="text/javascript" src="{{ asset('js/app/' . $crud . '.js') }}" defer></script>
    @endif
@endpush
