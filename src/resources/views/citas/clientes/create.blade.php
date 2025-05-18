<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Crear cita') }}
            </h2>
            <a href="{{ route('citasclientes.index') }}" class="btn btn-outline-primary px-2 py-1 rounded-md">
                {{ __('Volver') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('citasclientes.store') }}" method="POST">
                        @csrf
                        <!-- Introducimos campo oculto para que envíe datos de id del cliente que pide la cita (tb valdría Auth::id() en el value)-->
                        <input type="hidden" name="cliente_id" id="cliente_id" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ Auth::user()->id }}" required>                    
                        <div class="mb-4">
                            <label for="marca" class="block text-gray-700">{{ __('Marca') }}</label>
                            <input type="text" name="marca" id="marca" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('marca') }}" required>
                            @error('marca')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="modelo" class="block text-gray-700">{{ __('Modelo') }}</label>
                            <input type="text" name="modelo" id="modelo" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('modelo') }}" required>
                            @error('modelo')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="matricula" class="block text-gray-700">{{ __('Matrícula') }}</label>
                            <input type="text" name="matricula" id="matricula" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('matricula') }}" required>
                            @error('matricula')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-outline-primary px-4 py-2 rounded-md">
                            {{ __('Crear') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>