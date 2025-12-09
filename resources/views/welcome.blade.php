<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Biblioteca Digital - Vídeos Educativos</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Variáveis CSS para temas */
        :root {
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-tertiary: #334155;
            --text-primary: #f1f5f9;
            --text-secondary: #cbd5e1;
            --text-tertiary: #94a3b8;
            --border-color: #475569;
            --accent-color: #3b82f6;
            --accent-hover: #2563eb;
            --card-bg: #1e293b;
            --card-border: #475569;
            --skeleton-light: #334155;
            --skeleton-dark: #475569;
            --badge-green-bg: #064e3b;
            --badge-green-text: #34d399;
            --badge-yellow-bg: #78350f;
            --badge-yellow-text: #fbbf24;
            --badge-red-bg: #7f1d1d;
            --badge-red-text: #f87171;
            --featured-bg: rgba(30, 41, 59, 0.5);
            --featured-border: #475569;
        }

        /* Tema claro */
        .light-theme {
            --bg-primary: #ffffff;
            --bg-secondary: #f8fafc;
            --bg-tertiary: #f1f5f9;
            --text-primary: #0f172a;
            --text-secondary: #334155;
            --text-tertiary: #64748b;
            --border-color: #e2e8f0;
            --accent-color: #3b82f6;
            --accent-hover: #2563eb;
            --card-bg: #ffffff;
            --card-border: #e2e8f0;
            --skeleton-light: #f0f0f0;
            --skeleton-dark: #e0e0e0;
            --badge-green-bg: #d1fae5;
            --badge-green-text: #065f46;
            --badge-yellow-bg: #fef3c7;
            --badge-yellow-text: #92400e;
            --badge-red-bg: #fee2e2;
            --badge-red-text: #991b1b;
            --featured-bg: #eff6ff;
            --featured-border: #dbeafe;
        }

        /* Aplicar tema escuro por padrão */
        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .skeleton {
            background: linear-gradient(90deg, var(--skeleton-light) 25%, var(--skeleton-dark) 50%, var(--skeleton-light) 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite linear;
            border-radius: 0.375rem;
        }

        .video-card {
            transition: all 0.3s ease;
            opacity: 1;
            transform: translateY(0);
            background-color: var(--card-bg);
            border-color: var(--card-border);
        }

        .video-card.hidden-card {
            display: none !important;
        }

        .video-card.animate-in {
            animation: fadeInUp 0.5s ease forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .category-filter.active {
            background-color: var(--accent-color);
            color: white;
            border-color: var(--accent-color);
        }

        .filter-checkbox:checked+span {
            color: var(--accent-color);
            font-weight: 500;
        }

        .filter-checkbox:checked+span:before {
            content: "✓ ";
        }

        /* Modal animation */
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

        /* Progress bar for loading */
        .loading-bar {
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, var(--accent-color) 0%, var(--accent-color) 50%, var(--bg-tertiary) 50%, var(--bg-tertiary) 100%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite linear;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        /* Classes para tema */
        .dark-bg {
            background-color: var(--bg-secondary);
        }

        .dark-bg-primary {
            background-color: var(--bg-primary);
        }

        .dark-border {
            border-color: var(--border-color);
        }

        .dark-text {
            color: var(--text-primary);
        }

        .dark-text-secondary {
            color: var(--text-secondary);
        }

        .dark-input {
            background-color: var(--bg-tertiary);
            border-color: var(--border-color);
            color: var(--text-primary);
        }

        .dark-input::placeholder {
            color: var(--text-tertiary);
        }

        .dark-button {
            background-color: var(--bg-tertiary);
            color: var(--text-primary);
            border-color: var(--border-color);
        }

        .dark-button:hover {
            background-color: var(--bg-secondary);
        }

        .theme-toggle {
            background: var(--bg-tertiary);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            transition: all 0.3s ease;
        }

        .theme-toggle:hover {
            background: var(--bg-secondary);
        }

        /* Estilos para badges no modo escuro */
        .badge-beginner {
            background-color: var(--badge-green-bg);
            color: var(--badge-green-text);
        }

        .badge-intermediate {
            background-color: var(--badge-yellow-bg);
            color: var(--badge-yellow-text);
        }

        .badge-advanced {
            background-color: var(--badge-red-bg);
            color: var(--badge-red-text);
        }

        /* Featured section */
        .featured-section {
            background-color: var(--featured-bg);
            border-color: var(--featured-border);
        }
    </style>
</head>

<body class="dark-theme">
    <!-- Loading bar (hidden after load) -->
    <div id="loading-bar" class="loading-bar fixed top-0 left-0 right-0 z-50"></div>

    <!-- Header -->
    <header class="w-full border-b dark-bg sticky top-0 z-40 dark-border">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center gap-4">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-play text-white text-sm"></i>
                </div>
                <h1 class="hidden sm:block text-2xl font-bold dark-text">Media Lab</h1>
            </div>

            <div class="flex items-center gap-4 w-full sm:w-auto">
                <div class="relative flex-1 sm:flex-none">
                    <input type="text" id="search-input" placeholder="Pesquisar vídeos..."
                        class="px-4 py-2 pl-10 border rounded-lg w-full sm:w-80 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark-input" />
                    <i class="fas fa-search absolute left-3 top-3 dark-text-secondary"></i>
                </div>

                <!-- Botão de alternância de tema -->
                <button id="theme-toggle" class="p-2 border rounded-lg theme-toggle">
                    <i class="fas fa-moon" id="theme-icon"></i>
                </button>

                <button id="filter-toggle" class="p-2 border rounded-lg dark-button sm:hidden">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="max-w-6xl mx-auto px-4 py-10 text-center">
        <!-- Categorias -->
        <div class="flex flex-wrap justify-center gap-2 mb-8" id="category-filters">
            <button class="category-filter active px-4 py-2 rounded-full border transition-all dark-border"
                data-category="all">
                Todos
            </button>
            <button
                class="category-filter px-4 py-2 rounded-full border transition-all dark-border hover:bg-gray-800 dark:hover:bg-gray-100"
                data-category="frontend">
                Frontend
            </button>
            <button
                class="category-filter px-4 py-2 rounded-full border transition-all dark-border hover:bg-gray-800 dark:hover:bg-gray-100"
                data-category="backend">
                Backend
            </button>
            <button
                class="category-filter px-4 py-2 rounded-full border transition-all dark-border hover:bg-gray-800 dark:hover:bg-gray-100"
                data-category="design">
                Design
            </button>
            <button
                class="category-filter px-4 py-2 rounded-full border transition-all dark-border hover:bg-gray-800 dark:hover:bg-gray-100"
                data-category="ciencia">
                Ciência de Dados
            </button>
        </div>
    </section>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 flex flex-col lg:flex-row gap-8 pb-20">
        <!-- Video Grid -->
        <section class="flex-1">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-sm font-semibold dark-text">
                    <span id="video-count">12</span> Vídeos Disponíveis
                </h3>
                <div class="text-sm dark-text-secondary">
                    Ordenar por:
                    <select id="sort-select"
                        class="ml-2 border rounded px-2 py-1 focus:outline-none focus:ring-1 focus:ring-blue-500 dark-input dark-border">
                        <option value="recent">Mais Recentes</option>
                        <option value="title">Título (A-Z)</option>
                        <option value="duration">Duração</option>
                    </select>
                </div>
            </div>

            <!-- Vídeos diretamente no HTML com dados embutidos -->
            <div id="video-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <!-- Skeleton Cards (serão substituídos após carregamento) -->
                <div class="video-card skeleton-card flex flex-col gap-3 p-4 rounded-xl border">
                    <div class="h-40 skeleton"></div>
                    <div class="h-4 w-3/4 skeleton"></div>
                    <div class="h-3 w-1/2 skeleton"></div>
                </div>
                <div class="video-card skeleton-card flex flex-col gap-3 p-4 rounded-xl border">
                    <div class="h-40 skeleton"></div>
                    <div class="h-4 w-3/4 skeleton"></div>
                    <div class="h-3 w-1/2 skeleton"></div>
                </div>
                <div class="video-card skeleton-card flex flex-col gap-3 p-4 rounded-xl border">
                    <div class="h-40 skeleton"></div>
                    <div class="h-4 w-3/4 skeleton"></div>
                    <div class="h-3 w-1/2 skeleton"></div>
                </div>

                <!-- Vídeos reais com dados embutidos em atributos data -->
                @forelse ([1, 1, 1, 1, 1, 1, 1] as $item)
                    <div class="video-card border rounded-xl animate-in hidden" data-id="1"
                        data-title="Introdução ao HTML" data-category="frontend" data-level="beginner"
                        data-duration="12"
                        data-thumb="https://images.unsplash.com/photo-1621839673705-6617adf9e890?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80"
                        data-description="Aprenda os fundamentos do HTML para criação de páginas web. Este vídeo cobre tags básicas, estrutura de documentos e boas práticas.">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1621839673705-6617adf9e890?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80"
                                class="w-full h-40 object-cover rounded-t-xl" alt="Introdução ao HTML" />
                            <div
                                class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded">
                                12 min
                            </div>
                            <div class="absolute top-2 right-2">
                                <span class="px-2 py-1 text-xs rounded badge-beginner">
                                    Iniciante
                                </span>
                            </div>
                        </div>
                        <div class="p-4 flex flex-col flex-1">
                            <h3 class="font-semibold dark-text mb-2">Introdução ao HTML</h3>
                            <div class="flex items-center justify-between mt-auto">
                                <span class="text-xs dark-text-secondary">Frontend</span>
                                <button class="text-blue-400 hover:text-blue-300 text-sm font-medium view-details">
                                    Ver detalhes
                                </button>
                            </div>
                        </div>
                    </div>
                @empty

                    <div class="col-span-full text-center py-10">
                        <i class="fas fa-search text-4xl dark-text-secondary mb-4"></i>
                        <h3 class="text-xl font-semibold dark-text mb-2">Nenhum vídeo encontrado</h3>
                        <p class="dark-text-secondary mb-4">Tente ajustar seus filtros ou termos de busca.</p>
                        <button id="reset-filters-btn"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Limpar filtros
                        </button>
                    </div>
                @endforelse



            </div>

            <!-- Load more button -->
            <div class="mt-10 text-center">
                <button id="load-more"
                    class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    <i class="fas fa-plus mr-2"></i> Carregar Mais Vídeos
                </button>
            </div>
        </section>

        <!-- Sidebar (Filtros) -->
        <aside id="sidebar" class="lg:w-64 pt-6 lg:pt-0 hidden sm:block">
            <div class="dark-bg p-5 rounded-xl border -sm dark-border">
                <h4 class="font-semibold text-lg mb-4 dark-text">Filtros</h4>

                <div class="mb-6">
                    <h5 class="font-medium dark-text mb-2">Duração</h5>
                    <div class="space-y-2">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" class="mr-2 filter-checkbox" data-filter="duration"
                                value="short">
                            <span class="dark-text-secondary">Curto (≤ 10 min)</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" class="mr-2 filter-checkbox" data-filter="duration"
                                value="medium">
                            <span class="dark-text-secondary">Médio (10-30 min)</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" class="mr-2 filter-checkbox" data-filter="duration"
                                value="long">
                            <span class="dark-text-secondary">Longo (≥ 30 min)</span>
                        </label>
                    </div>
                </div>

                <div class="mb-6">
                    <h5 class="font-medium dark-text mb-2">Nível</h5>
                    <div class="space-y-2">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" class="mr-2 filter-checkbox" data-filter="level"
                                value="beginner">
                            <span class="dark-text-secondary">Iniciante</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" class="mr-2 filter-checkbox" data-filter="level"
                                value="intermediate">
                            <span class="dark-text-secondary">Intermediário</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" class="mr-2 filter-checkbox" data-filter="level"
                                value="advanced">
                            <span class="dark-text-secondary">Avançado</span>
                        </label>
                    </div>
                </div>

                <button id="clear-filters" class="w-full py-2 border rounded-lg dark-button dark-border">
                    Limpar Filtros
                </button>
            </div>

            <!-- Video em destaque -->
            <div class="featured-section p-5 rounded-xl border mt-6">
                <h4 class="font-semibold text-lg mb-3 dark-text">Em Destaque</h4>
                <div class="space-y-3">
                    <div class="flex items-start gap-3">
                        <div class="w-12 h-12 bg-blue-900 rounded-lg flex items-center justify-center">
                            <i class="fas fa-star text-blue-400"></i>
                        </div>
                        <div>
                            <h5 class="font-medium text-sm dark-text">JavaScript Avançado</h5>
                            <p class="text-xs dark-text-secondary">Domine conceitos avançados</p>
                        </div>
                    </div>
                    <div class="text-sm dark-text-secondary">
                        <p>Novo vídeo disponível! Aprenda técnicas avançadas de JavaScript com exemplos práticos.</p>
                    </div>
                </div>
            </div>
        </aside>
    </main>

    <!-- Footer -->
    <footer class="dark-bg py-10 mt-12">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <p class="dark-text-secondary">© 2023 Media Lab. Todos os direitos reservados.</p>
        </div>
    </footer>

    <script>
        // Elementos DOM
        const videoGrid = document.getElementById('video-grid');
        const videoCards = document.querySelectorAll('.video-card:not(.skeleton-card)');
        const skeletonCards = document.querySelectorAll('.skeleton-card');
        const searchInput = document.getElementById('search-input');
        const categoryFilters = document.querySelectorAll('.category-filter');
        const sortSelect = document.getElementById('sort-select');
        const loadMoreBtn = document.getElementById('load-more');
        const videoCount = document.getElementById('video-count');
        const filterToggle = document.getElementById('filter-toggle');
        const sidebar = document.getElementById('sidebar');
        const clearFiltersBtn = document.getElementById('clear-filters');
        const loadingBar = document.getElementById('loading-bar');
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');

        // Estado da aplicação
        let currentCategory = 'all';
        let currentFilters = {
            duration: [],
            level: []
        };
        let visibleVideos = 4;
        let allVideosCount = videoCards.length;
        let isDarkMode = true;

        // Inicialização
        document.addEventListener('DOMContentLoaded', function() {
            // Carregar preferência de tema
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'light') {
                enableLightMode();
            }

            // Mostrar loading
            loadingBar.style.display = 'block';

            // Simular carregamento dos vídeos
            setTimeout(() => {
                // Remover skeletons
                skeletonCards.forEach(card => card.remove());

                // Mostrar primeiros vídeos
                showInitialVideos();

                // Atualizar contador
                updateVideoCount();

                // Esconder loading
                loadingBar.style.display = 'none';

                // Adicionar event listeners
                setupEventListeners();
            }, 1000);
        });

        // Função para alternar tema
        function toggleTheme() {
            if (isDarkMode) {
                enableLightMode();
            } else {
                enableDarkMode();
            }
        }

        // Ativar modo claro
        function enableLightMode() {
            document.body.classList.remove('dark-theme');
            document.body.classList.add('light-theme');
            themeIcon.classList.remove('fa-moon');
            themeIcon.classList.add('fa-sun');
            isDarkMode = false;
            localStorage.setItem('theme', 'light');
        }

        // Ativar modo escuro
        function enableDarkMode() {
            document.body.classList.remove('light-theme');
            document.body.classList.add('dark-theme');
            themeIcon.classList.remove('fa-sun');
            themeIcon.classList.add('fa-moon');
            isDarkMode = true;
            localStorage.setItem('theme', 'dark');
        }

        // Mostrar vídeos iniciais
        function showInitialVideos() {
            videoCards.forEach((card, index) => {
                if (index < visibleVideos) {
                    card.classList.remove('hidden');
                    card.style.animationDelay = `${index * 0.1}s`;
                } else {
                    card.classList.add('hidden-card');
                }
            });
        }

        // Atualizar contador de vídeos
        function updateVideoCount() {
            const visibleCards = document.querySelectorAll('.video-card:not(.hidden-card):not(.skeleton-card)');
            const totalCards = document.querySelectorAll('.video-card:not(.skeleton-card)');
            videoCount.textContent = visibleCards.length;

            // Mostrar/ocultar botão "Carregar mais"
            if (visibleCards.length >= totalCards.length) {
                loadMoreBtn.classList.add('hidden');
            } else {
                loadMoreBtn.classList.remove('hidden');
            }
        }

        // Configurar event listeners
        function setupEventListeners() {
            // Alternância de tema
            themeToggle.addEventListener('click', toggleTheme);

            // Pesquisa
            searchInput.addEventListener('input', filterVideos);

            // Filtros de categoria
            categoryFilters.forEach(btn => {
                btn.addEventListener('click', function() {
                    categoryFilters.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    currentCategory = this.dataset.category;
                    filterVideos();
                });
            });

            // Ordenação
            sortSelect.addEventListener('change', sortVideos);

            // Filtros de duração e nível
            document.querySelectorAll('.filter-checkbox').forEach(input => {
                input.addEventListener('change', updateFilters);
            });

            // Botão "Carregar mais"
            loadMoreBtn.addEventListener('click', loadMoreVideos);

            // Botão "Limpar filtros"
            clearFiltersBtn.addEventListener('click', clearFilters);

            // Toggle sidebar em mobile
            filterToggle.addEventListener('click', function() {
                sidebar.classList.toggle('hidden');
            });

            // Event listeners para botões "Ver detalhes"
            document.querySelectorAll('.view-details').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const videoCard = this.closest('.video-card');
                    const videoId = videoCard.dataset.id;
                    const title = videoCard.dataset.title;
                    const description = videoCard.dataset.description;
                    const duration = videoCard.dataset.duration;
                    const level = videoCard.dataset.level;
                    const category = videoCard.dataset.category;

                    // Aqui você poderia abrir um modal ou redirecionar para a página do vídeo
                    // Por enquanto, vamos mostrar um alerta
                    alert(
                        `Detalhes do vídeo:\n\nTítulo: ${title}\nDuração: ${duration} minutos\nNível: ${getLevelText(level)}\nCategoria: ${getCategoryText(category)}\n\n${description}`
                    );
                });
            });
        }

        // Atualizar filtros ativos
        function updateFilters() {
            currentFilters.duration = [];
            currentFilters.level = [];

            document.querySelectorAll('.filter-checkbox[data-filter="duration"]:checked').forEach(input => {
                currentFilters.duration.push(input.value);
            });

            document.querySelectorAll('.filter-checkbox[data-filter="level"]:checked').forEach(input => {
                currentFilters.level.push(input.value);
            });

            filterVideos();
        }

        // Filtrar vídeos
        function filterVideos() {
            const searchText = searchInput.value.toLowerCase();
            let visibleCount = 0;

            videoCards.forEach(card => {
                const title = card.dataset.title.toLowerCase();
                const category = card.dataset.category;
                const level = card.dataset.level;
                const duration = parseInt(card.dataset.duration);
                const description = card.dataset.description.toLowerCase();

                // Verificar filtro de categoria
                const categoryMatch = currentCategory === 'all' || category === currentCategory;

                // Verificar filtro de busca
                const searchMatch = !searchText ||
                    title.includes(searchText) ||
                    description.includes(searchText);

                // Verificar filtro de nível
                const levelMatch = currentFilters.level.length === 0 ||
                    currentFilters.level.includes(level);

                // Verificar filtro de duração
                let durationMatch = currentFilters.duration.length === 0;
                if (!durationMatch) {
                    if (currentFilters.duration.includes('short') && duration <= 10) durationMatch = true;
                    if (currentFilters.duration.includes('medium') && duration > 10 && duration <= 30)
                        durationMatch = true;
                    if (currentFilters.duration.includes('long') && duration > 30) durationMatch = true;
                }

                // Verificar todos os filtros
                if (categoryMatch && searchMatch && levelMatch && durationMatch) {
                    card.classList.remove('hidden-card');
                    visibleCount++;
                } else {
                    card.classList.add('hidden-card');
                }
            });

            // Atualizar contador
            videoCount.textContent = visibleCount;

            // Mostrar mensagem se não houver resultados
            if (visibleCount === 0) {
                showNoResultsMessage();
            } else {
                removeNoResultsMessage();
            }

            // Ordenar vídeos visíveis
            sortVideos();
        }



        // Remover mensagem de nenhum resultado
        function removeNoResultsMessage() {
            const message = document.getElementById('no-results-message');
            if (message) {
                message.remove();
            }
        }

        // Ordenar vídeos
        function sortVideos() {
            const sortValue = sortSelect.value;
            const visibleCards = Array.from(videoCards).filter(card => !card.classList.contains('hidden-card'));

            // Ordenar os vídeos visíveis
            visibleCards.sort((a, b) => {
                switch (sortValue) {
                    case 'title':
                        return a.dataset.title.localeCompare(b.dataset.title);
                    case 'duration':
                        return parseInt(a.dataset.duration) - parseInt(b.dataset.duration);
                    case 'recent':
                    default:
                        return parseInt(b.dataset.id) - parseInt(a.dataset.id);
                }
            });

            // Reorganizar no DOM
            visibleCards.forEach(card => {
                videoGrid.appendChild(card);
            });
        }

        // Limpar todos os filtros
        function clearFilters() {
            // Resetar categoria
            categoryFilters.forEach(btn => {
                btn.classList.remove('active');
                if (btn.dataset.category === 'all') {
                    btn.classList.add('active');
                }
            });
            currentCategory = 'all';

            // Resetar checkboxes
            document.querySelectorAll('.filter-checkbox').forEach(input => {
                input.checked = false;
            });

            // Resetar estado dos filtros
            currentFilters = {
                duration: [],
                level: []
            };
            searchInput.value = '';
            sortSelect.value = 'recent';

            // Mostrar todos os vídeos (até o limite de visíveis)
            videoCards.forEach((card, index) => {
                if (index < visibleVideos) {
                    card.classList.remove('hidden-card');
                } else {
                    card.classList.add('hidden-card');
                }
            });

            // Atualizar contador
            updateVideoCount();
            removeNoResultsMessage();

            // Ordenar vídeos
            sortVideos();
        }
    </script>
</body>

</html>
