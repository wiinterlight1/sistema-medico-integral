@props(['consultorio'])

<button type="button" class="btn-accion actualizar" onclick="document.getElementById('ModalConsultorioUpdate-{{ $consultorio->id }}').showModal()">
    Actualizar
</button>

<dialog id="ModalConsultorioUpdate-{{ $consultorio->id }}" class="ModalPersonalizar">
    <form action="{{ route('consultorios.update', $consultorio->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="ModalAbierto">
            <h2>Actualizar Consultorio</h2>
            <button type="button" class="btn-cerrar" onclick="document.getElementById('ModalConsultorioUpdate-{{ $consultorio->id }}').close()">×</button>
        </div>
        <div class="ModalBody">
            <div class="mb-3">
                <label class="ModalTexto">Número</label>
                <input type="text" name="numero" value="{{ $consultorio->numero }}" class="ModalInput">
            </div>
            <div class="mb-3">
                <label class="ModalTexto">Ubicación</label>
                <input type="text" name="ubicacion" value="{{ $consultorio->ubicacion }}" class="ModalInput">
            </div>
            <div class="mb-3">
                <label class="ModalTexto">Estado</label>
                <select name="activo" class="ModalInput">
                    <option value="1" {{ $consultorio->activo == 1 ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ $consultorio->activo == 0 ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
            <div class="acciones-modal">
                <button type="submit" class="BotonGuardar">Guardar cambios</button>
            </div>
        </div>
    </form>
</dialog>