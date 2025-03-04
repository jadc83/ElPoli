<x-app-layout>
    <h1 class="text-center text-xl font-bold mb-4">Disponibilidad de Pistas</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full table-auto text-center mx-auto border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    @for ($i = 0; $i < 5; $i++)
                        <th class="px-4 py-2 border border-gray-300">{{ $hoy->copy()->addDay($i)->format('l') }}</th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @for ($j = 10; $j < 20; $j++)
                    <tr>
                        @for ($i = 0; $i < 5; $i++)
                            @php
                                $hora = $hoy->copy()->addDay($i)->setTime($j, 0);
                                $reservada = \App\Models\Reserva::where('pista_id', $pista->id)
                                    ->where('fecha_hora', $hora)
                                    ->exists();
                            @endphp

                            <td class="px-4 py-2 border border-gray-300">
                                @if ($reservada)
                                    <form action="{{ route('reservas.destroy', $reservada) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name="hora" value="{{ $hora }}">
                                        <input type="hidden" name="pista_id" value="{{ $pista->id }}">
                                        <x-primary-button class="bg-red-500 hover:bg-red-600">
                                            Anular
                                        </x-primary-button>
                                    </form>
                                @else
                                    <form action="{{ route('reservas.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="hora" value="{{ $hora }}">
                                        <input type="hidden" name="pista_id" value="{{ $pista->id }}">
                                        <x-primary-button class="bg-blue-500 hover:bg-blue-600">
                                            {{ $hora->format('H:i') }}
                                        </x-primary-button>
                                    </form>
                                @endif
                            </td>
                        @endfor
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
</x-app-layout>
