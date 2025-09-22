@push('scripts')
    @if ($message = session()->get('success'))
        <script>
            toastr.success('{{ $message }}');
        </script>
    @endif
    @if ($message = session()->get('error'))
        <script>
            toastr.error('{{ $message }}');
        </script>
    @endif
    @if ($message = session()->get('info'))
        <script>
            toastr.info('{{ $message }}');
        </script>
    @endif
    @if ($message = session()->get('warning'))
        <script>
            toastr.warning('{{ $message }}');
        </script>
    @endif
@endpush
