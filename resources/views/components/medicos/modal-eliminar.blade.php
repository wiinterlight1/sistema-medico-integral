@props(['medico'])

<button type="button" class="btn-accion eliminar" onclick="document.getElementById('ModalMedicoDelete-{{ $medico->id }}').showModal()">
    Eliminar
</button>

<dialog id="ModalMedicoDelete-{{ $medico->id }}" class="ModalPersonalizar">
    <form action="{{ route('medicos.delete', $medico->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="ModalAbierto">
            <h2>¿Eliminar médico?</h2>
            <button type="button" class="btn-cerrar" onclick="document.getElementById('ModalMedicoDelete-{{ $medico->id }}').close()">×</button>
        </div>
        <div class="ModalBody">
            <p class="ModalTexto" style="text-align: center; margin-bottom: 20px;">
                ¿Estás seguro de que deseas eliminar al Dr. {{ $medico->nombre }} {{ $medico->apellido }}?
            </p>
            <div class="acciones-modal" style="justify-content: center;">
                <button type="button" class="BotonEliminarNo" onclick="document.getElementById('ModalMedicoDelete-{{ $medico->id }}').close()">
                    Cancelar
                </button>
                <button type="submit" class="BotonEliminarSi">
                    Eliminar
                </button>
            </div>
        </div>
    </form>
</dialog>