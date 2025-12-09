<!-- Sidebar (Filtros) -->
        <aside id="sidebar" class="lg:w-64 pt-6 lg:pt-0 hidden sm:block">
            <div class="bg-white p-5 rounded-xl border shadow-sm">
                <h4 class="font-semibold text-lg mb-4 text-gray-800">Filtros</h4>

                <div class="mb-6">
                    <h5 class="font-medium text-gray-700 mb-2">Duração</h5>
                    <div class="space-y-2">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" class="mr-2 filter-checkbox" data-filter="duration"
                                value="short">
                            <span class="text-gray-700">Curto (≤ 10 min)</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" class="mr-2 filter-checkbox" data-filter="duration"
                                value="medium">
                            <span class="text-gray-700">Médio (10-30 min)</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" class="mr-2 filter-checkbox" data-filter="duration"
                                value="long">
                            <span class="text-gray-700">Longo (≥ 30 min)</span>
                        </label>
                    </div>
                </div>

                <div class="mb-6">
                    <h5 class="font-medium text-gray-700 mb-2">Nível</h5>
                    <div class="space-y-2">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" class="mr-2 filter-checkbox" data-filter="level"
                                value="beginner">
                            <span class="text-gray-700">Iniciante</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" class="mr-2 filter-checkbox" data-filter="level"
                                value="intermediate">
                            <span class="text-gray-700">Intermediário</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" class="mr-2 filter-checkbox" data-filter="level"
                                value="advanced">
                            <span class="text-gray-700">Avançado</span>
                        </label>
                    </div>
                </div>

                <button id="clear-filters"
                    class="w-full py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-gray-700">
                    Limpar Filtros
                </button>
            </div>

            <!-- Video em destaque -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-5 rounded-xl border border-blue-100 mt-6">
                <h4 class="font-semibold text-lg mb-3 text-gray-800">Em Destaque</h4>
                <div class="space-y-3">
                    <div class="flex items-start gap-3">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-star text-blue-600"></i>
                        </div>
                        <div>
                            <h5 class="font-medium text-sm">JavaScript Avançado</h5>
                            <p class="text-xs text-gray-600">Domine conceitos avançados</p>
                        </div>
                    </div>
                    <div class="text-sm text-gray-700">
                        <p>Novo vídeo disponível! Aprenda técnicas avançadas de JavaScript com exemplos práticos.</p>
                    </div>
                </div>
            </div>
        </aside>