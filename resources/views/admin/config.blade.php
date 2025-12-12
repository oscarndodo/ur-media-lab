@extends('admin.index')

@section('main')
    @push('styles')
        <style>
            /* Configurações Layout */
            .settings-container {
                max-width: 1200px;
                margin: 0 auto;
            }

            .settings-card {
                background: white;
                border-radius: 12px;
                border: 1px solid #e5e7eb;
                transition: all 0.3s ease;
            }

            .settings-card:hover {
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            }

            .settings-nav {
                position: sticky;
                top: 2rem;
                height: fit-content;
            }

            .nav-link {
                display: flex;
                align-items: center;
                padding: 0.75rem 1rem;
                border-radius: 8px;
                color: #6b7280;
                text-decoration: none;
                transition: all 0.2s ease;
                margin-bottom: 0.25rem;
            }

            .nav-link:hover {
                background-color: #f3f4f6;
                color: #374151;
            }

            .nav-link.active {
                background-color: #eff6ff;
                color: #1d4ed8;
                font-weight: 500;
            }

            .nav-link .icon {
                width: 20px;
                text-align: center;
                margin-right: 0.75rem;
            }

            .settings-section {
                padding: 1.5rem;
            }

            .settings-title {
                font-size: 1.5rem;
                font-weight: 600;
                color: #111827;
                margin-bottom: 0.5rem;
            }

            .settings-subtitle {
                color: #6b7280;
                margin-bottom: 1.5rem;
            }

            .form-group {
                margin-bottom: 1.5rem;
            }

            .form-label {
                display: block;
                font-size: 0.875rem;
                font-weight: 500;
                color: #374151;
                margin-bottom: 0.5rem;
            }

            .form-hint {
                display: block;
                font-size: 0.75rem;
                color: #6b7280;
                margin-top: 0.25rem;
            }

            .toggle-switch {
                position: relative;
                display: inline-block;
                width: 52px;
                height: 28px;
            }

            .toggle-switch input {
                opacity: 0;
                width: 0;
                height: 0;
            }

            .toggle-slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #d1d5db;
                transition: .4s;
                border-radius: 34px;
            }

            .toggle-slider:before {
                position: absolute;
                content: "";
                height: 20px;
                width: 20px;
                left: 4px;
                bottom: 4px;
                background-color: white;
                transition: .4s;
                border-radius: 50%;
            }

            input:checked+.toggle-slider {
                background-color: #3b82f6;
            }

            input:checked+.toggle-slider:before {
                transform: translateX(24px);
            }

            .input-group {
                position: relative;
            }

            .input-prefix {
                position: absolute;
                left: 12px;
                top: 50%;
                transform: translateY(-50%);
                color: #6b7280;
                font-weight: 500;
            }

            .input-with-prefix {
                padding-left: 40px;
            }

            /* Badge de status */
            .status-badge {
                display: inline-flex;
                align-items: center;
                padding: 0.25rem 0.75rem;
                border-radius: 9999px;
                font-size: 0.75rem;
                font-weight: 500;
            }

            .status-badge.active {
                background-color: #d1fae5;
                color: #065f46;
            }

            .status-badge.inactive {
                background-color: #f3f4f6;
                color: #6b7280;
            }

            /* Tabela de logs */
            .log-table {
                width: 100%;
                border-collapse: separate;
                border-spacing: 0;
            }

            .log-table th {
                text-align: left;
                padding: 0.75rem 1rem;
                font-size: 0.75rem;
                font-weight: 500;
                color: #6b7280;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                border-bottom: 1px solid #e5e7eb;
            }

            .log-table td {
                padding: 1rem;
                border-bottom: 1px solid #f3f4f6;
            }

            .log-table tr:hover {
                background-color: #f9fafb;
            }

            /* Modal de confirmação */
            .modal-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 1000;
                align-items: center;
                justify-content: center;
            }

            .modal-overlay.active {
                display: flex;
            }

            .modal-content {
                background: white;
                border-radius: 12px;
                width: 90%;
                max-width: 400px;
                animation: modalSlideIn 0.3s ease;
            }

            @keyframes modalSlideIn {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
    @endpush

    <!-- Main Layout Structure -->
    <div class="flex w-full bg-gray-50">
        <!-- Main Content -->
        <main class="flex-1">


            <!-- Settings Content -->
            <div class="p-6 sm:mt-8">
                <div class="settings-container">
                    <div class="flex flex-col lg:flex-row gap-6">


                        <!-- Main Settings Content -->
                        <div class="max-w-6xl grid grid-cols-2 gap-8">


                            <!-- Conta Section (Hidden by default) -->
                            {{-- <div id="conta-section" class="settings-section settings-card">
                                <h2 class="settings-title">Configurações da Conta</h2>
                                <p class="settings-subtitle">Gerencie suas informações pessoais</p>

                                <form onsubmit="saveAccountSettings(event)">
                                    <div class="flex items-start gap-6 mb-6">


                                        <div class="flex-1">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <div class="form-group">
                                                    <label class="form-label">Nome Completo</label>
                                                    <input type="text"
                                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                                                        value="Carlos Silva" required>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Email</label>
                                                    <input type="email"
                                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                                                        value="admin@edutechpro.com" required>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Cargo</label>
                                                    <input type="text"
                                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                                                        value="Administrador" disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Data de Cadastro</label>
                                                    <input type="text"
                                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none bg-gray-50"
                                                        value="15/01/2023" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">Biografia</label>
                                                <textarea
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                                                    rows="3" placeholder="Conte um pouco sobre você...">Administrador da plataforma com foco em tecnologia educacional.</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex justify-end gap-3">
                                        <button type="button"
                                            class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                            Cancelar
                                        </button>
                                        <button type="submit"
                                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium">
                                            Atualizar Perfil
                                        </button>
                                    </div>
                                </form>
                            </div> --}}

                            <!-- Segurança Section (Hidden by default) -->
                            <div id="seguranca-section" class="settings-section settings-card">
                                <h2 class="settings-title">Segurança</h2>
                                <p class="settings-subtitle">Gerencie a segurança da sua conta</p>

                                <div class="space-y-6">
                                    <!-- Alterar Senha -->
                                    <div class="border border-gray-200 rounded-lg p-5">
                                        <h3 class="font-semibold text-gray-900 mb-4">Alterar Senha</h3>
                                        <form onsubmit="changePassword(event)" action="{{ route('update') }}"
                                            method="POST">
                                            @csrf
                                            <div class="space-y-4">
                                                <div class="form-group">
                                                    <label class="form-label">Senha Atual</label>
                                                    <input type="password" name="password"
                                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                                                        required>
                                                </div>

                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Nova Senha</label>
                                                        <input type="text" name="new-password"
                                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                                                            required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="form-label">Confirmar Nova Senha</label>
                                                        <input type="text" name="confirm-password"
                                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="flex justify-end mt-6">
                                                <button type="submit"
                                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium">
                                                    Atualizar Senha
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
