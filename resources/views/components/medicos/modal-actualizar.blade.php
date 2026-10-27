@props(['medico', 'especialidades'])

<button type="button" class="btn-accion actualizar" onclick="document.getElementById('ModalMedicoUpdate-{{ $medico->id }}').showModal()">
    Actualizar
</button>

<dialog id="ModalMedicoUpdate-{{ $medico->id }}" class="ModalPersonalizar">
    <form action="{{ route('medicos.update', $medico->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="ModalAbierto">
            <h2>Actualizar Médico</h2>
            <button type="button" class="btn-cerrar" onclick="document.getElementById('ModalMedicoUpdate-{{ $medico->id }}').close()">×</button>
        </div>
        <div class="ModalBody">
            <div class="mb-3">
                <label class="ModalTexto">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $medico->nombre) }}" class="ModalInput">
                @error('nombre')
                <div class="MensajeError" style="color: #dc2626;">
                    <small>{{ $message }}</small>
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="ModalTexto">Apellido</label>
                <input type="text" name="apellido" value="{{ old('apellido', $medico->apellido) }}" class="ModalInput">
                @error('apellido')
                <div class="MensajeError" style="color: #dc2626;">
                    <small>{{ $message }}</small>
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="ModalTexto">Teléfono</label>
                <input type="text" name="telefono" value="{{ old('telefono', $medico->telefono) }}" class="ModalInput">
                @error('telefono')
                <div class="MensajeError" style="color: #dc2626;">
                    <small>{{ $message }}</small>
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="ModalTexto">Especialidad</label>
                <select name="especialidad_id" class="ModalInput">
                    <option value="">Seleccione una especialidad</option>
                    @forelse($especialidades as $esp)
                        <option value="{{ $esp->id }}" {{ (old('especialidad_id', $medico->especialidades_id) == $esp->id) ? 'selected' : '' }}>
                            {{ $esp->nombre }}
                        </option>
                    @empty
                        <option value="" disabled>No tienes especialidades registradas</option>
                    @endforelse
                </select>
                @error('especialidad_id')
                <div class="MensajeError" style="color: #dc2626;">
                    <small>{{ $message }}</small>
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="ModalTexto">Estado</label>
                <select name="activo" class="ModalInput">
                    <option value="1" {{ (old('activo', $medico->activo) == 1) ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ (old('activo', $medico->activo) == 0) ? 'selected' : '' }}>Inactivo</option>
                </select>
                @error('activo')
                <div class="MensajeError" style="color: #dc2626;">
                    <small>{{ $message }}</small>
                </div>
                @enderror
            </div>
            <div class="acciones-modal">
                <button type="submit" class="BotonGuardar">Guardar cambios</button>
            </div>
        </div>
    </form>
</dialog>