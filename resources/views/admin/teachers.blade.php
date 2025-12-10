@extends('admin.index')

@section('main')
    @push('styles')
        <style>
            .data-table {
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                background: white;
            }

            .table-header {
                background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
                border-bottom: 2px solid #e5e7eb;
            }

            .table-header th {
                padding: 1rem 1.5rem;
                font-weight: 600;
                color: #374151;
                text-transform: uppercase;
                font-size: 0.75rem;
                letter-spacing: 0.05em;
            }

            .table-row {
                transition: all 0.2s ease;
                border-bottom: 1px solid #f3f4f6;
            }

            .table-row:hover {
                background-color: #f9fafb;
            }

            .teacher-avatar {
                width: 40px;
                height: 40px;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: bold;
                color: white;
                font-size: 0.875rem;
                background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            }

            .status-badge {
                padding: 0.25rem 0.75rem;
                border-radius: 9999px;
                font-size: 0.75rem;
                font-weight: 500;
                display: inline-flex;
                align-items: center;
                gap: 0.25rem;
            }

            .status-active {
                background-color: #d1fae5;
                color: #065f46;
            }

            .status-inactive {
                background-color: #fee2e2;
                color: #991b1b;
            }

            .specialty-tag {
                padding: 0.25rem 0.625rem;
                border-radius: 6px;
                font-size: 0.75rem;
                font-weight: 500;
                background-color: #eff6ff;
                color: #1d4ed8;
            }

            .action-btn {
                width: 32px;
                height: 32px;
                border-radius: 6px;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.2s ease;
                color: #6b7280;
            }

            .action-btn:hover {
                background-color: #f3f4f6;
            }

            .action-edit:hover {
                color: #3b82f6;
            }

            .action-view:hover {
                color: #10b981;
            }

            .action-delete:hover {
                color: #ef4444;
            }

            .btn-new-teacher {
                background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
                color: white;
                padding: 0.625rem 1.25rem;
                border-radius: 8px;
                font-weight: 500;
                display: flex;
                align-items: center;
                gap: 0.5rem;
                transition: all 0.2s ease;
                box-shadow: 0 2px 4px rgba(59, 130, 246, 0.2);
            }

            .btn-new-teacher:hover {
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
            }

            .search-container {
                background: white;
                border: 1px solid #e5e7eb;
                border-radius: 8px;
            }

            .search-input {
                border: none;
                outline: none;
                background: transparent;
                width: 100%;
                padding: 0.75rem 1rem;
                font-size: 0.875rem;
            }

            .pagination-btn {
                width: 32px;
                height: 32px;
                border-radius: 6px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 500;
                background: white;
                border: 1px solid #e5e7eb;
                color: #374151;
                transition: all 0.2s;
            }

            .pagination-btn:hover:not(.active) {
                background-color: #f9fafb;
            }

            .pagination-btn.active {
                background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
                color: white;
                border-color: transparent;
            }
        </style>
    @endpush

    <main class="p-6">
        <!-- Header com Botão -->
        <div class="mb-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Docentes</h1>
                    <p class="text-gray-600 mt-1">Gerencie os professores cadastrados</p>
                </div>
                <a class="btn-new-teacher" href="{{ route('admin.teachers.new') }}">
                    <i class="fas fa-plus"></i>
                    Novo Professor
                </a>
            </div>
        </div>

        <!-- Search -->
        <div class="mb-6">
            <div class="search-container max-w-xl flex items-center flex-row-reverse">
                <button class="fas fa-search mr-3 text-gray-400"></button>
                <input type="text" placeholder="Buscar docentes..." class="search-input ml-2" id="searchInput">
            </div>
        </div>

        <!-- Tabela Simples -->
        <div class="data-table">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="table-header">
                        <tr>
                            <th class="px-6 py-4 text-left">Docente</th>
                            <th class="px-6 py-4 text-left">Especialidade</th>
                            <th class="px-6 py-4 text-left">Vídeos</th>
                            <th class="px-6 py-4 text-left">Status</th>
                            <th class="px-6 py-4 text-left">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Linha 1 -->
                        <tr class="table-row">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="teacher-avatar">
                                        CS
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">Carlos Silva</p>
                                        <p class="text-sm text-gray-500">carlos.silva@exemplo.com</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="specialty-tag">
                                    Língua Inglesa
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-medium text-gray-900">8 vídeos</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="status-badge status-active">
                                    <i class="fas fa-circle text-xs"></i>
                                    Ativo
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <button class="action-btn action-edit" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn action-view" title="Visualizar">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn action-delete" title="Desativar">
                                        <i class="fas fa-user-slash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Linha 2 -->
                        <tr class="table-row">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="teacher-avatar"
                                        style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);">
                                        MS
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">Maria Santos</p>
                                        <p class="text-sm text-gray-500">maria.santos@exemplo.com</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="specialty-tag" style="background-color: #f3e8ff; color: #7c3aed;">
                                    Programação
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-medium text-gray-900">12 vídeos</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="status-badge status-inactive">
                                    <i class="fas fa-circle text-xs"></i>
                                    Inativo
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <button class="action-btn action-edit" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn action-view" title="Visualizar">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn action-delete" title="Ativar">
                                        <i class="fas fa-user-check"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Paginação Simples -->
            <div class="px-6 py-4 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        2 docentes encontrados
                    </div>
                    <div class="flex items-center gap-2">
                        <button class="pagination-btn active">1</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @push('scripts')
        <script>
            // Busca simples
            const searchInput = document.getElementById('searchInput');
            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const rows = document.querySelectorAll('.table-row');

                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            });

            // Adicionar hover effects
            const actionButtons = document.querySelectorAll('.action-btn');
            actionButtons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.1)';
                });

                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            });
        </script>
    @endpush
@endsection
