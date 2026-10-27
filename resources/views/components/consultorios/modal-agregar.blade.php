<button type="button" class="btn-nuevo" onclick="document.getElementById('ModalConsultorioAgregar').showModal()">
    Nuevo Consultorio
</button>

<dialog id="ModalConsultorioAgregar" class="ModalPersonalizar">
    <form action="{{ route('consultorio.create') }}" method="POST">
        @csrf
        <div class="ModalAbierto">
            <h2>Registrar Nuevo Consultorio</h2>
            <button type="button" class="btn-cerrar" onclick="document.getElementById('ModalConsultorioAgregar').close()">×</button>
        </div>
        <div class="ModalBody">
            <div class="mb-3">
                <label class="ModalTexto">Número</label>
                <input type="text" name="numero" value="{{ old('numero') }}" class="ModalInput" placeholder="Ingrese número del consultorio">
                @error('numero')
                <div class="MensajeError" style="color: #dc2626;">
                    <small>{{ $message }}</small>
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="ModalTexto">Ubicación</label>
                <input type="text" name="ubicacion" value="{{ old('ubicacion') }}" class="ModalInput" placeholder="Ingrese ubicación del consultorio">
                @error('ubicacion')
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