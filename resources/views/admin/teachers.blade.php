@extends('admin.index')

@section('main')
    @push('styles')
        <style>
            .skeleton {
                background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
                background-size: 200% 100%;
                animation: loading 1.5s infinite;
                border-radius: 0.375rem;
            }

            @keyframes loading {
                0% {
                    background-position: 200% 0;
                }

                100% {
                    background-position: -200% 0;
                }
            }

            .stat-card {
                transition: all 0.3s ease;
            }

            .stat-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            }

            .table-row-hover:hover {
                background-color: #f9fafb;
            }

            .modal-enter {
                animation: modalFadeIn 0.3s ease-out;
            }

            @keyframes modalFadeIn {
                from {
                    opacity: 0;
                    transform: scale(0.95);
                }

                to {
                    opacity: 1;
                    transform: scale(1);
                }
            }

            .fade-in {
                animation: fadeIn 0.5s ease-in-out;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .status-active {
                background-color: #d1fae5;
                color: #065f46;
            }

            .status-inactive {
                background-color: #fee2e2;
                color: #991b1b;
            }

            .status-pending {
                background-color: #fef3c7;
                color: #92400e;
            }

            .action-btn {
                transition: all 0.2s ease;
            }

            .action-btn:hover {
                transform: scale(1.05);
            }

            .avatar-upload {
                border: 2px dashed #d1d5db;
                transition: all 0.3s ease;
            }

            .avatar-upload:hover {
                border-color: #3b82f6;
                background-color: #f0f9ff;
            }
        </style>
    @endpush

    <main class="p-6">


        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Professores -->
            <div class="stat-card bg-white rounded-xl p-6 shadow-sm fade-in">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total de Professores</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">24</h3>
                        <p class="text-sm text-green-600 mt-2">
                            <i class="fas fa-arrow-up mr-1"></i>
                            8% este mês
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-chalkboard-teacher text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Professores Ativos -->
            <div class="stat-card bg-white rounded-xl p-6 shadow-sm fade-in" style="animation-delay: 0.1s">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Professores Ativos</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">18</h3>
                        <p class="text-sm text-green-600 mt-2">
                            <i class="fas fa-check-circle mr-1"></i>
                            75% do total
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user-check text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Cursos -->
            <div class="stat-card bg-white rounded-xl p-6 shadow-sm fade-in" style="animation-delay: 0.2s">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total de Cursos</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">42</h3>
                        <p class="text-sm text-blue-600 mt-2">
                            <i class="fas fa-book mr-1"></i>
                            14 por professor
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-book-open text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Avaliação Média -->
            <div class="stat-card bg-white rounded-xl p-6 shadow-sm fade-in" style="animation-delay: 0.3s">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Avaliação Média</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">4.7</h3>
                        <p class="text-sm text-yellow-600 mt-2">
                            <i class="fas fa-star mr-1"></i>
                            Excelente
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-star text-yellow-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white rounded-xl border p-4 mb-6">
            <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                <div class="w-full md:w-auto md:flex-1">
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" placeholder="Buscar docentes por nome, especialidade ou email..."
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all duration-200">
                    </div>
                </div>
                <div class="flex gap-3 w-full md:w-auto">
                    <select
                        class="border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <option value="">Todos os status</option>
                        <option value="active">Ativo</option>
                        <option value="inactive">Inativo</option>
                        <option value="pending">Pendente</option>
                    </select>
                    <select
                        class="border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <option value="">Todas as especialidades</option>
                        <option value="programming">Programação</option>
                        <option value="design">Design</option>
                        <option value="business">Negócios</option>
                        <option value="marketing">Marketing</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Teachers Table -->
        <div class="bg-white rounded-xl border overflow-hidden fade-in">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" class="rounded border-gray-300">
                                    <span>Docente</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Especialidade
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Cursos
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Avaliação
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <!-- Teacher 1 -->
                        <tr class="table-row-hover hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <input type="checkbox" class="rounded border-gray-300 mr-3">
                                    <div
                                        class="flex-shrink-0 h-10 w-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-semibold">
                                        CS
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Carlos Silva</div>
                                        <div class="text-sm text-gray-500">carlos.silva@exemplo.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1">
                                    <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-800">Programação</span>
                                    <span class="px-2 py-1 text-xs rounded bg-purple-100 text-purple-800">JavaScript</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <span class="text-sm font-medium text-gray-900">8 cursos</span>
                                    <span class="text-xs text-gray-500 ml-2">156 vídeos</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex">
                                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        <i class="fas fa-star-half-alt text-yellow-400 text-sm"></i>
                                    </div>
                                    <span class="text-sm text-gray-600 ml-2">4.8</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs rounded-full font-medium status-active">
                                    <i class="fas fa-circle mr-1 text-xs"></i>
                                    Ativo
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <button
                                        class="action-btn p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-150"
                                        title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button
                                        class="action-btn p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors duration-150"
                                        title="Ver perfil">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button
                                        class="action-btn p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors duration-150"
                                        title="Desativar">
                                        <i class="fas fa-user-slash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Teacher 2 -->
                        <tr class="table-row-hover hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <input type="checkbox" class="rounded border-gray-300 mr-3">
                                    <div
                                        class="flex-shrink-0 h-10 w-10 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center text-white font-semibold">
                                        AS
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Ana Santos</div>
                                        <div class="text-sm text-gray-500">ana.santos@exemplo.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1">
                                    <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-800">Design</span>
                                    <span class="px-2 py-1 text-xs rounded bg-pink-100 text-pink-800">UI/UX</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <span class="text-sm font-medium text-gray-900">6 cursos</span>
                                    <span class="text-xs text-gray-500 ml-2">98 vídeos</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex">
                                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                                    </div>
                                    <span class="text-sm text-gray-600 ml-2">5.0</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs rounded-full font-medium status-active">
                                    <i class="fas fa-circle mr-1 text-xs"></i>
                                    Ativo
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <button
                                        class="action-btn p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-150"
                                        title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button
                                        class="action-btn p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors duration-150"
                                        title="Ver perfil">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button
                                        class="action-btn p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors duration-150"
                                        title="Desativar">
                                        <i class="fas fa-user-slash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Teacher 3 -->
                        <tr class="table-row-hover hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <input type="checkbox" class="rounded border-gray-300 mr-3">
                                    <div
                                        class="flex-shrink-0 h-10 w-10 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold">
                                        RM
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Ricardo Mendes</div>
                                        <div class="text-sm text-gray-500">ricardo.mendes@exemplo.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1">
                                    <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-800">Marketing</span>
                                    <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-800">SEO</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <span class="text-sm font-medium text-gray-900">4 cursos</span>
                                    <span class="text-xs text-gray-500 ml-2">72 vídeos</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex">
                                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        <i class="far fa-star text-gray-300 text-sm"></i>
                                    </div>
                                    <span class="text-sm text-gray-600 ml-2">4.0</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs rounded-full font-medium status-pending">
                                    <i class="fas fa-clock mr-1 text-xs"></i>
                                    Pendente
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <button
                                        class="action-btn p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-150"
                                        title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button
                                        class="action-btn p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors duration-150"
                                        title="Ver perfil">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button
                                        class="action-btn p-2 text-yellow-600 hover:bg-yellow-50 rounded-lg transition-colors duration-150"
                                        title="Aprovar">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Mostrando <span class="font-medium">1</span> a <span class="font-medium">3</span> de <span
                            class="font-medium">24</span> resultados
                    </div>
                    <div class="flex items-center gap-2">
                        <button
                            class="px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed"
                            disabled>
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="px-3 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700">
                            1
                        </button>
                        <button
                            class="px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                            2
                        </button>
                        <button
                            class="px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                            3
                        </button>
                        <button
                            class="px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @push('scripts')
        <script>
            // Search functionality
            const searchInput = document.querySelector('input[type="text"]');
            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const rows = document.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            });

            // Status filter functionality
            const statusFilter = document.querySelector('select:first-of-type');
            statusFilter.addEventListener('change', function(e) {
                const status = e.target.value;
                const rows = document.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    const statusSpan = row.querySelector('.status-active, .status-inactive, .status-pending');
                    const rowStatus = statusSpan.classList.contains('status-active') ? 'active' :
                        statusSpan.classList.contains('status-inactive') ? 'inactive' : 'pending';

                    if (!status || status === rowStatus) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        </script>
    @endpush
@endsection
