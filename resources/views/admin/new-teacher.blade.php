@extends('admin.index')

@section('main')
    @push('styles')
        <style>
            .form-container {
                max-width: 800px;
                margin: 0 auto;
                background: white;
                border-radius: 12px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                overflow: hidden;
            }

            .form-header {
                background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
                color: white;
                padding: 1.5rem 2rem;
            }

            .form-header h1 {
                font-size: 1.5rem;
                font-weight: 600;
                display: flex;
                align-items: center;
                gap: 0.75rem;
            }

            .form-body {
                padding: 2rem;
            }

            .form-section {
                margin-bottom: 2rem;
                padding-bottom: 2rem;
                border-bottom: 1px solid #e5e7eb;
            }

            .form-section:last-child {
                border-bottom: none;
                margin-bottom: 0;
                padding-bottom: 0;
            }

            .section-title {
                font-size: 1.125rem;
                font-weight: 600;
                color: #111827;
                margin-bottom: 1.5rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .section-title i {
                color: #3b82f6;
            }

            .form-group {
                margin-bottom: 1.5rem;
            }

            .form-row {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 1.5rem;
            }

            @media (max-width: 768px) {
                .form-row {
                    grid-template-columns: 1fr;
                }
            }

            .form-label {
                display: block;
                font-size: 0.875rem;
                font-weight: 500;
                color: #374151;
                margin-bottom: 0.5rem;
            }

            .required::after {
                content: '*';
                color: #ef4444;
                margin-left: 0.25rem;
            }

            .form-input {
                width: 100%;
                padding: 0.75rem 1rem;
                border: 1px solid #d1d5db;
                border-radius: 8px;
                font-size: 0.875rem;
                color: #111827;
                transition: all 0.2s;
                background: white;
            }

            .form-input:focus {
                outline: none;
                border-color: #3b82f6;
                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            }

            .form-input.has-error {
                border-color: #ef4444;
            }

            .form-input.has-error:focus {
                box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
            }

            .error-message {
                font-size: 0.75rem;
                color: #ef4444;
                margin-top: 0.25rem;
                display: flex;
                align-items: center;
                gap: 0.25rem;
            }

            .select-wrapper {
                position: relative;
            }

            .select-wrapper::after {
                content: '\f078';
                font-family: 'Font Awesome 6 Free';
                font-weight: 900;
                position: absolute;
                right: 1rem;
                top: 50%;
                transform: translateY(-50%);
                color: #6b7280;
                pointer-events: none;
            }

            .select-wrapper select {
                appearance: none;
                cursor: pointer;
            }

            .checkbox-group {
                display: flex;
                flex-wrap: wrap;
                gap: 1rem;
            }

            .checkbox-label {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                cursor: pointer;
                font-size: 0.875rem;
                color: #374151;
            }

            .checkbox-label input[type="checkbox"] {
                width: 16px;
                height: 16px;
                border-radius: 4px;
                border: 1px solid #d1d5db;
                cursor: pointer;
            }

            .checkbox-label input[type="checkbox"]:checked {
                background-color: #3b82f6;
                border-color: #3b82f6;
            }

            .textarea {
                min-height: 100px;
                resize: vertical;
            }

            .avatar-upload {
                display: flex;
                align-items: center;
                gap: 1.5rem;
            }

            .avatar-preview {
                width: 100px;
                height: 100px;
                border-radius: 50%;
                background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                overflow: hidden;
                border: 2px dashed #d1d5db;
            }

            .avatar-preview img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .avatar-preview i {
                font-size: 2rem;
                color: #9ca3af;
            }

            .upload-btn {
                padding: 0.75rem 1.5rem;
                background: white;
                border: 1px solid #d1d5db;
                border-radius: 8px;
                color: #374151;
                font-size: 0.875rem;
                font-weight: 500;
                cursor: pointer;
                transition: all 0.2s;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .upload-btn:hover {
                background: #f9fafb;
                border-color: #9ca3af;
            }

            .form-footer {
                background: #f9fafb;
                padding: 1.5rem 2rem;
                border-top: 1px solid #e5e7eb;
                display: flex;
                justify-content: flex-end;
                gap: 1rem;
            }

            .btn {
                padding: 0.75rem 1.5rem;
                border-radius: 8px;
                font-size: 0.875rem;
                font-weight: 500;
                cursor: pointer;
                transition: all 0.2s;
                display: flex;
                align-items: center;
                gap: 0.5rem;
                border: none;
            }

            .btn-secondary {
                background: white;
                border: 1px solid #d1d5db;
                color: #374151;
            }

            .btn-secondary:hover {
                background: #f3f4f6;
            }

            .btn-primary {
                background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
                color: white;
                box-shadow: 0 2px 4px rgba(59, 130, 246, 0.2);
            }

            .btn-primary:hover {
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
            }

            .btn-primary:disabled {
                opacity: 0.5;
                cursor: not-allowed;
                transform: none;
            }

            .char-counter {
                font-size: 0.75rem;
                color: #6b7280;
                text-align: right;
                margin-top: 0.25rem;
            }

            .char-counter.warning {
                color: #f59e0b;
            }

            .char-counter.error {
                color: #ef4444;
            }

            .info-text {
                font-size: 0.75rem;
                color: #6b7280;
                margin-top: 0.25rem;
                font-style: italic;
            }

            .status-toggle {
                display: flex;
                gap: 1rem;
            }

            .toggle-option {
                flex: 1;
            }

            .toggle-option input[type="radio"] {
                display: none;
            }

            .toggle-label {
                display: block;
                padding: 0.75rem 1rem;
                text-align: center;
                border: 1px solid #d1d5db;
                border-radius: 8px;
                cursor: pointer;
                font-size: 0.875rem;
                transition: all 0.2s;
            }

            .toggle-label:hover {
                background: #f9fafb;
            }

            .toggle-option input[type="radio"]:checked+.toggle-label {
                background: #3b82f6;
                color: white;
                border-color: #3b82f6;
            }

            .loading {
                opacity: 0.7;
                pointer-events: none;
            }

            .loading::after {
                content: '';
                display: inline-block;
                width: 1rem;
                height: 1rem;
                border: 2px solid #ffffff;
                border-radius: 50%;
                border-top-color: transparent;
                animation: spin 1s linear infinite;
                margin-left: 0.5rem;
            }

            @keyframes spin {
                to {
                    transform: rotate(360deg);
                }
            }
        </style>
    @endpush

    <main class="p-6">
        <form class="form-container" action="{{ route('admin.teachers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Cabeçalho do Formulário -->
            <div class="form-header flex items-center">
                <a href="{{ route('admin.teachers') }}"
                    class="w-28 bg-white border-2 text-blue-500 mr-6 px-4 rounded py-2 hover:opacity-80 ease-in-out duration-700 active:scale-95">
                    <i class="fas fa-arrow-left mr-1"></i>
                    <span class="font-semibold">Voltar</span>
                </a>
                <h1>
                    <i class="fas fa-user-plus"></i>
                    Cadastro de novo Docente
                </h1>
            </div>

            <!-- Corpo do Formulário -->
            <div id="teacherForm" class="form-body">
                <!-- Seção 1: Informações Pessoais -->
                <div class="form-section">
                    <h2 class="section-title">
                        <i class="fas fa-user-circle"></i>
                        Informações Pessoais
                    </h2>
                    <div class="space-y-3">

                        <!-- Título + instruções -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-800">
                                Foto do Perfil
                            </label>
                            <p class="text-xs text-gray-500">
                                Recomendado: 400x400px • JPG ou PNG até 2MB
                            </p>
                        </div>

                        <!-- Preview -->
                        <div class="flex items-center gap-4">

                            <div id="avatarPreview"
                                class="w-20 h-20 object-cover rounded-full bg-gray-100 border border-gray-300 flex items-center justify-center
                    overflow-hidden shadow-sm transition-all duration-200 hover:ring-2 hover:ring-blue-400 cursor-pointer">
                                <i class="fas fa-user text-gray-400 text-3xl"></i>
                            </div>

                            <div>
                                <input type="file" id="avatarInput" name="file" accept="image/*" class="hidden"
                                    onchange="previewAvatar(event)">

                                <button type="button" onclick="document.getElementById('avatarInput').click()"
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg
                           hover:bg-blue-700 active:bg-blue-800 transition-all duration-150">
                                    <i class="fas fa-upload"></i>
                                    Carregar Foto
                                </button>

                                <p class="text-xs text-gray-500 mt-1">Clique para escolher uma imagem</p>
                            </div>

                        </div>

                    </div>


                    <div class="form-row">
                        <div class="form-group">
                            <label for="name" class="form-label required">Nome Completo</label>
                            <input type="text" id="name" name="name" class="form-input"
                                placeholder="Ex: Carlos Silva" required>
                            <div class="error-message" id="nameError"></div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label required">Email</label>
                            <input type="email" id="email" name="email" class="form-input"
                                placeholder="Ex: professor@exemplo.com" required>
                            <div class="error-message" id="emailError"></div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="bio" class="form-label">Biografia</label>
                        <textarea id="bio" name="description" class="form-input textarea"
                            placeholder="Descreva a formação e experiência do docente..." maxlength="500"></textarea>
                        <div class="char-counter" id="bioCounter">0/500</div>
                        <div class="error-message" id="bioError"></div>
                    </div>
                </div>

                <!-- Seção 2: Informações Acadêmicas -->
                <div class="form-section">
                    <h2 class="section-title">
                        <i class="fas fa-graduation-cap"></i>
                        Informações Acadêmicas
                    </h2>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="formation" class="form-label required">Formação</label>
                            <div class="select-wrapper">
                                <select id="formation" name="formation" class="form-input" required>
                                    <option value="">Selecione uma formação</option>
                                    <option value="Licenciatura">Licenciatura</option>
                                    <option value="Mestrado">Mestrado</option>
                                    <option value="Doutorado">Doutorado</option>
                                </select>
                            </div>
                            <div class="error-message" id="formationError"></div>
                        </div>

                        <div class="form-group">
                            <label for="course" class="form-label required">Curso/Área</label>
                            <input type="text" id="course" name="area" class="form-input"
                                placeholder="Ex: Letras - Inglês" required>
                            <div class="error-message" id="courseError"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="institution" class="form-label required">Instituição</label>
                        <input type="text" id="institution" name="institute" class="form-input"
                            placeholder="Ex: Universidade Rovuma" required>
                        <div class="error-message" id="institutionError"></div>
                    </div>
                </div>

            </div>

            <!-- Rodapé do Formulário -->
            <div class="form-footer">
                <button type="reset" class="btn btn-secondary" onclick="cancelForm()">
                    <i class="fas fa-times"></i>
                    Cancelar
                </button>
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-save"></i>
                    Salvar Professor
                </button>
            </div>
        </form>
    </main>

    @push('scripts')
        <script>
            // Preview do avatar
            function previewAvatar(event) {
                const input = event.target;
                const preview = document.getElementById('avatarPreview');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    @endpush
@endsection
