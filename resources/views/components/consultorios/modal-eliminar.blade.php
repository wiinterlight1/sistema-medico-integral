@props(['consultorio'])

<button type="button" class="btn-accion eliminar" onclick="document.getElementById('ModalConsultorioDelete-{{ $consultorio->id }}').showModal()">
    Eliminar
</button>

<dialog id="ModalConsultorioDelete-{{ $consultorio->id }}" class="ModalPersonalizar">
    <form action="{{ route('consultorios.delete', $consultorio->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="ModalAbierto">
            <h2>¿Eliminar consultorio?</h2>
            <button type="button" class="btn-cerrar" onclick="document.getElementById('ModalConsultorioDelete-{{ $consultorio->id }}').close()">×</button>
        </div>
        <div class="ModalBody">
            <p class="ModalTexto" style="text-align: center; margin-bottom: 20px;">
                ¿Estás seguro de que deseas eliminar el consultorio "{{ $consultorio->numero }}"?
            </p>
            <div class="acciones-modal" style="justify-content: center;">
                <button type="button" class="BotonEliminarNo" onclick="document.getElementById('ModalConsultorioDelete-{{ $consultorio->id }}').close()">
                    Cancelar
                </button>
                <button type="submit" class="BotonEliminarSi">
                    Eliminar
                </button>
            </div>
        </div>
    </form>
</dialog>