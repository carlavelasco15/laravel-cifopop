<x-alert type="danger" message="Se han producido errores:">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</x-alert>