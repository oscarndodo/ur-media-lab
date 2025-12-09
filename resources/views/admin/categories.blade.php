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

            .action-btn {
                transition: all 0.2s ease;
            }

            .action-btn:hover {
                transform: scale(1.05);
            }

            .category-color {
                width: 20px;
                height: 20px;
                border-radius: 4px;
                display: inline-block;
            }

            .drag-handle {
                cursor: move;
                transition: color 0.2s ease;
            }

            .drag-handle:hover {
                color: #3b82f6;
            }

            .sortable-ghost {
                opacity: 0.4;
                background: #f3f4f6;
            }

            .sortable-chosen {
                background-color: #f0f9ff;
            }
        </style>
    @endpush

    <main class="p-6">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Gestão de Categorias</h1>
                <p class="text-gray-600 mt-1">Organize os conteúdos por categorias e subcategorias</p>
            </div>
            <div class="flex gap-3">
                <button id="sortCategories"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-3 rounded-lg font-medium flex items-center gap-2 transition-all duration-200">
                    <i class="fas fa-sort"></i>
                    <span>Ordenar</span>
                </button>
                <button id="addCategoryBtn"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-lg font-medium flex items-center gap-2 transition-all duration-200">
                    <i class="fas fa-plus"></i>
                    <span>Nova Categoria</span>
                </button>
            </div>
        </div>


        <!-- Categories Table -->
        <div class="bg-white rounded-xl border overflow-hidden fade-in" id="categoriesTable">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-12">
                                Ordem
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Categoria
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Cor
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Vídeos
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200" id="sortableCategories">

                        @forelse ([1, 1, 1, 1, 1, 1, 1, 1, 1] as $item)
                            <!-- Category 1 -->
                            <tr class="table-row-hover hover:bg-gray-50 transition-colors duration-150 sortable-item"
                                data-id="1">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <span class="drag-handle text-gray-400 cursor-move">
                                            <i class="fas fa-grip-vertical"></i>
                                        </span>
                                        <span class="text-sm text-gray-500">1</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div
                                            class="flex-shrink-0 h-10 w-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-code text-white"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Programação</div>
                                            <div class="text-sm text-gray-500">Cursos de desenvolvimento de software</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="category-color" style="background-color: #3b82f6;"></div>
                                        <span class="text-sm text-gray-600">Azul</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <span class="text-sm font-medium text-gray-900">58</span>
                                        <span class="text-xs text-gray-500 ml-1">vídeos</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <button
                                            class="action-btn edit-category p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-150"
                                            title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button
                                            class="action-btn p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors duration-150"
                                            title="Ver detalhes">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button
                                            class="action-btn p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors duration-150"
                                            title="Desativar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10">
                                    <div class="flex flex-col items-center justify-center text-gray-500">

                                        <!-- Ícone -->
                                        <div
                                            class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center mb-3">
                                            <i class="fas fa-folder-open text-2xl text-gray-400"></i>
                                        </div>

                                        <!-- Mensagem principal -->
                                        <p class="text-sm font-medium text-gray-600">Nenhuma categoria encontrado</p>

                                        <!-- Submensagem -->
                                        <p class="text-xs text-gray-400 mt-1">A sua tabela ainda não possui categorias para
                                            mostrar</p>


                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Mostrando <span class="font-medium">1</span> a <span class="font-medium">4</span> de <span
                            class="font-medium">15</span> categorias
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

    <!-- Add Category Modal -->
    <div id="addCategoryModal"
        class="fixed w-screen h-screen inset-0 bg-black bg-opacity-50 backdrop-blur flex hidden items-center justify-center p-4 z-50">
        <div class="bg-white rounded-xl max-w-2xl modal-enter">
            <div class="border-b border-gray-200 p-6">
                <h2 class="text-xl font-semibold text-gray-900">Nova Categoria</h2>
                <p class="text-gray-600 mt-1">Adicione uma nova categoria ao sistema</p>
            </div>

            <div class="p-6">
                <form id="addCategoryForm" class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nome da Categoria</label>
                        <input type="text"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all duration-200"
                            placeholder="Ex: Design, Programação, etc.">
                    </div>



                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cor de Identificação</label>
                        <div class="grid grid-cols-3 gap-3">

                            <!-- Vermelho -->
                            <label for="red" class="flex items-center gap-2 cursor-pointer select-none">
                                <input type="radio" name="color" id="red" value="red"
                                    class="peer h-4 w-4 text-red-600 focus:ring-red-500">
                                <div
                                    class="w-5 h-5 rounded bg-red-500 border border-red-600 peer-checked:ring-2 peer-checked:ring-red-500">
                                </div>
                                <span class="text-sm">Vermelho</span>
                            </label>

                            <!-- Laranja -->
                            <label for="orange" class="flex items-center gap-2 cursor-pointer select-none">
                                <input type="radio" name="color" id="orange" value="orange"
                                    class="peer h-4 w-4 text-orange-600 focus:ring-orange-500">
                                <div
                                    class="w-5 h-5 rounded bg-orange-500 border border-orange-600 peer-checked:ring-2 peer-checked:ring-orange-500">
                                </div>
                                <span class="text-sm">Laranja</span>
                            </label>



                            <!-- Amarelo -->
                            <label for="yellow" class="flex items-center gap-2 cursor-pointer select-none">
                                <input type="radio" name="color" id="yellow" value="yellow"
                                    class="peer h-4 w-4 text-yellow-600 focus:ring-yellow-500">
                                <div
                                    class="w-5 h-5 rounded bg-yellow-500 border border-yellow-600 peer-checked:ring-2 peer-checked:ring-yellow-500">
                                </div>
                                <span class="text-sm">Amarelo</span>
                            </label>

                            <!-- Lima -->
                            <label for="lime" class="flex items-center gap-2 cursor-pointer select-none">
                                <input type="radio" name="color" id="lime" value="lime"
                                    class="peer h-4 w-4 text-lime-600 focus:ring-lime-500">
                                <div
                                    class="w-5 h-5 rounded bg-lime-500 border border-lime-600 peer-checked:ring-2 peer-checked:ring-lime-500">
                                </div>
                                <span class="text-sm">Lima</span>
                            </label>

                            <!-- Verde -->
                            <label for="green" class="flex items-center gap-2 cursor-pointer select-none">
                                <input type="radio" name="color" id="green" value="green"
                                    class="peer h-4 w-4 text-green-600 focus:ring-green-500">
                                <div
                                    class="w-5 h-5 rounded bg-green-500 border border-green-600 peer-checked:ring-2 peer-checked:ring-green-500">
                                </div>
                                <span class="text-sm">Verde</span>
                            </label>



                            <!-- Ciano -->
                            <label for="cyan" class="flex items-center gap-2 cursor-pointer select-none">
                                <input type="radio" name="color" id="cyan" value="cyan"
                                    class="peer h-4 w-4 text-cyan-600 focus:ring-cyan-500">
                                <div
                                    class="w-5 h-5 rounded bg-cyan-500 border border-cyan-600 peer-checked:ring-2 peer-checked:ring-cyan-500">
                                </div>
                                <span class="text-sm">Ciano</span>
                            </label>


                            <!-- Azul -->
                            <label for="blue" class="flex items-center gap-2 cursor-pointer select-none">
                                <input type="radio" name="color" id="blue" value="blue"
                                    class="peer h-4 w-4 text-blue-600 focus:ring-blue-500">
                                <div
                                    class="w-5 h-5 rounded bg-blue-500 border border-blue-600 peer-checked:ring-2 peer-checked:ring-blue-500">
                                </div>
                                <span class="text-sm">Azul</span>
                            </label>



                            <!-- Roxo -->
                            <label for="purple" class="flex items-center gap-2 cursor-pointer select-none">
                                <input type="radio" name="color" id="purple" value="purple"
                                    class="peer h-4 w-4 text-purple-600 focus:ring-purple-500">
                                <div
                                    class="w-5 h-5 rounded bg-purple-500 border border-purple-600 peer-checked:ring-2 peer-checked:ring-purple-500">
                                </div>
                                <span class="text-sm">Roxo</span>
                            </label>


                            <!-- Rosa -->
                            <label for="pink" class="flex items-center gap-2 cursor-pointer select-none">
                                <input type="radio" name="color" id="pink" value="pink"
                                    class="peer h-4 w-4 text-pink-600 focus:ring-pink-500">
                                <div
                                    class="w-5 h-5 rounded bg-pink-500 border border-pink-600 peer-checked:ring-2 peer-checked:ring-pink-500">
                                </div>
                                <span class="text-sm">Rosa</span>
                            </label>


                        </div>

                    </div>

                </form>
            </div>

            <div class="border-t border-gray-200 p-6 flex justify-end gap-3">
                <button id="cancelAddCategory"
                    class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition-colors duration-200">
                    Cancelar
                </button>
                <button
                    class="px-6 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors duration-200">
                    Criar Categoria
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Modal functionality
            const addCategoryBtn = document.getElementById('addCategoryBtn');
            const addCategoryModal = document.getElementById('addCategoryModal');
            const cancelAddCategory = document.getElementById('cancelAddCategory');

            function openModal() {
                addCategoryModal.classList.remove('hidden');
                addCategoryModal.classList.add('flex');
                document.body.style.overflow = 'hidden';
            }

            function closeModal() {
                addCategoryModal.classList.remove('flex');
                addCategoryModal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }

            addCategoryBtn.addEventListener('click', openModal);
            cancelAddCategory.addEventListener('click', closeModal);

            // Close modal when clicking outside
            addCategoryModal.addEventListener('click', (e) => {
                if (e.target === addCategoryModal) {
                    closeModal();
                }
            });
        </script>
    @endpush
@endsection
