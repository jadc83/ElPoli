<x-app-layout>
    <h1 class="text-center text-xl font-bold mb-4">Disponibilidad de Pistas</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full table-auto text-center mx-auto border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    @foreach (range(0, 4) as $dias)
                        <th class="px-4 py-2 border border-gray-300">{{ $hoy->copy()->addDay($dias)->format('l') }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach (range(10, 19) as $horario)
                    <tr>
                        @foreach (range(0, 4) as $dias)
                            @php
                                $hora = $hoy->copy()->addDay($dias)->setTime($horario, 0);
                                $reservada = \App\Models\Reserva::where('pista_id', $pista->id)
                                    ->where('fecha_hora', $hora)
                                    ->first();
                            @endphp

                            <td class="px-4 py-2 border border-gray-300">
                                <form action="{{ $reservada ? route('reservas.destroy', $reservada) : route('reservas.store') }}" method="POST">
                                    @csrf
                                    @if ($reservada)
                                        @method('delete')
                                        <input type="hidden" name="hora" value="{{ $hora }}">
                                        <input type="hidden" name="pista_id" value="{{ $pista->id }}">

                                        <x-primary-button class="{{ $reservada ? 'bg-red-500 hover:bg-red-600' : 'bg-blue-500 hover:bg-blue-600' }}">
                                            {{ $reservada ? 'Anular' : $hora->format('H:i') }}
                                        </x-primary-button>
                                    @endif
                                </form>
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
