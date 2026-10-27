<button type="button" class="btn-nuevo" onclick="document.getElementById('ModalMedicoAgregar').showModal()">
    Nuevo Médico
</button>

<dialog id="ModalMedicoAgregar" class="ModalPersonalizar">
    <form action="{{ route('medicos.create') }}" method="POST">
        @csrf
        <div class="ModalAbierto">
            <h2>Registrar Nuevo Médico</h2>
            <button type="button" class="btn-cerrar" onclick="document.getElementById('ModalMedicoAgregar').close()">×</button>
        </div>
        <div class="ModalBody">
            <div class="mb-3">
                <label class="ModalTexto">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" class="ModalInput" placeholder="Nombre del médico">
                @error('nombre')
                <div class="MensajeError" style="color: #dc2626;">
                    <small>{{ $message }}</small>
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="ModalTexto">Apellido</label>
                <input type="text" name="apellido" value="{{ old('apellido') }}" class="ModalInput" placeholder="Apellido del médico">
                @error('apellido')
                <div class="MensajeError" style="color: #dc2626;">
                    <small>{{ $message }}</small>
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="ModalTexto">Teléfono</label>
                <input type="text" name="telefono" value="{{ old('telefono') }}" class="ModalInput" placeholder="Teléfono de contacto">
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
                        <option value="{{ $esp->id }}" {{ old('especialidad_id') == $esp->id ? 'selected' : '' }}>{{ $esp->nombre }}</option>
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
                    <option value="1" {{ old('activo') == '1' ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ old('activo') == '0' ? 'selected' : '' }}>Inactivo</option>
                </select>
                @error('activo')
                <div class="MensajeError" style="color: #dc2626;">
                    <small>{{ $message }}</small>
                </div>
                @enderror
            </div>
            <div class="acciones-modal">
                <button type="submit" class="BotonGuardar">Guardar</button>
            </div>
        </div>
    </form>
</dialog>