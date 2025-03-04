<x-app-layout>
    <form action="{{ route('selector') }}" method="get">
        @csrf
        <select name="pista_id">
            @foreach ($pistas as $pista)
                <option value="{{$pista->id}}">{{$pista->nombre}}</option>
            @endforeach
        </select>
        <x-primary-button>Enviar</x-primary-button>
    </form>
</x-app-layout>
