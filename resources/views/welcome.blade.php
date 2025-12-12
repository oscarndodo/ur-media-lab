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

        /* Loading para botão carregar mais */
        .loading-spinner {
            display: none;
        }

        .loading-spinner.active {
            display: inline-block;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="dark-theme">
    <!-- Loading bar (hidden after load) -->
    <div id="loading-bar" class="loading-bar fixed top-0 left-0 right-0 z-50"></div>

    <!-- Header -->
    <header class="w-full border-b dark-bg sticky top-0 z-40 dark-border">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center gap-4">
            <a href="{{ route('index') }}" class="flex items-center gap-3">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-play text-white text-sm"></i>
                </div>
                <h1 class="hidden sm:block text-2xl font-bold dark-text">UR Media</h1>
            </a>

            <div class="flex items-center gap-4 w-full sm:w-auto">
                <form action="{{ route('guest.search') }}" method="GET" class="relative flex-1 sm:flex-none">
                    <input type="text" id="search-input" name="q" placeholder="Pesquisar vídeos..."
                        class="px-4 py-2 pl-10 border rounded-lg w-full sm:w-80 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark-input" />
                    <i class="fas fa-search absolute left-3 top-3 dark-text-secondary"></i>
                </form>

                <!-- Botão de alternância de tema -->
                <button id="theme-toggle" class="p-2 border rounded-lg theme-toggle">
                    <i class="fas fa-moon" id="theme-icon"></i>
                </button>

                <button id="filter-toggle" class="p-2 border rounded-lg dark-button sm:hidden">
                    <i class="fas fa-search"></i>
                </button>
                <a href="{{ route('login') }}" class="p-2 px-4 border rounded-lg dark-button">
                    <i class="fas fa-user"></i>
                </a>
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
            @foreach ($categorias as $categoria)
                <button
                    class="category-filter px-4 py-2 rounded-full border transition-all dark-border hover:bg-gray-800 dark:hover:bg-gray-100"
                    data-category="{{ $categoria->slug ?? strtolower(str_replace(' ', '-', $categoria->name)) }}">
                    {{ $categoria->name }}
                </button>
            @endforeach
        </div>
    </section>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 flex flex-col lg:flex-row gap-8 pb-20">
        <!-- Video Grid -->
        <section class="flex-1">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-sm font-semibold dark-text">
                    <span id="video-count">{{ $videos->total() }}</span> Vídeos Disponíveis
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

            <!-- Container para os vídeos -->
            <div id="video-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <!-- Skeleton Cards (serão substituídos após carregamento) -->
                @if ($videos->count() > 0)
                    <div class="video-card skeleton-card flex flex-col gap-3 p-4 rounded-xl border"
                        style="display: none;">
                        <div class="h-40 skeleton"></div>
                        <div class="h-4 w-3/4 skeleton"></div>
                        <div class="h-3 w-1/2 skeleton"></div>
                    </div>
                @endif

                <!-- Vídeos reais com dados embutidos em atributos data -->
                @forelse ($videos as $item)
                    <div class="video-card border shadow-md rounded-xl animate-in hover:scale-95 transition-transform"
                        data-id="{{ $item->id }}" data-title="{{ $item->title }}"
                        data-category="{{ $item->category }}" data-level="{{ $item->category }}"
                        data-duration="{{ $item->duration }}" data-thumb="{{ asset('assets/img/video.png') }}"
                        data-description="{{ $item->description }}">
                        <a href="{{ route('video', $item->id) }}" class="relative block">
                            <img src="{{ asset('assets/img/video.png') }}"
                                class="w-full h-40 object-cover rounded-t-xl" alt="{{ $item->title }}" />
                            <div
                                class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded">
                                {{ \Carbon\CarbonInterval::seconds((int) $item->duration)->cascade()->format('%H:%I:%S') }}
                            </div>
                            <div class="absolute top-2 right-2">
                                <span
                                    class="px-2 py-1 text-xs rounded badge-{{ $item->category }} bg-white text-gray-600">
                                    {{ $item->category }}
                                </span>
                            </div>
                        </a>
                        <div class="p-4 flex flex-col flex-1">
                            <h3 class="font-semibold dark-text mb-2">{{ $item->title }}</h3>
                            <p class="text-sm dark-text-secondary mb-3 line-clamp-2">
                                {{ Str::limit($item->description, 100) }}</p>
                            <div class="flex items-center justify-between mt-auto">
                                <span class="text-xs dark-text-secondary"><i
                                        class="fas fa-user-circle text-gray-400"></i>
                                    {{ $item->user->name }}</span>
                                <a href="{{ route('video', $item->id) }}"
                                    class="text-blue-500 hover:text-blue-300 text-sm font-medium view-details hover:opacity-85 ease-in-out active:scale-90">
                                    Ver detalhes
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-10 no-videos-message">
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
            @if ($videos->hasMorePages())
                <div class="mt-10 text-center">
                    <button id="load-more"
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium"
                        data-next-page="{{ $videos->currentPage() + 1 }}"
                        data-total-pages="{{ $videos->lastPage() }}">
                        <i class="fas fa-plus mr-2"></i>
                        <span class="load-more-text">Carregar Mais Vídeos</span>
                        <i class="fas fa-spinner loading-spinner ml-2"></i>
                    </button>
                </div>
            @endif
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
                    <h5 class="font-medium dark-text mb-2">Disciplinas</h5>
                    <div class="space-y-2">
                        @foreach ($categorias as $categoria)
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" class="mr-2 filter-checkbox"
                                    data-filter="{{ $categoria->name }}" value="{{ $categoria->name }}">
                                <span class="dark-text-secondary capitalize">{{ $categoria->name }}</span>
                            </label>
                        @endforeach

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
                            <h5 class="font-medium text-sm dark-text">Desenvolvimento</h5>
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
            <p class="dark-text-secondary">© {{ date('Y') }} Media Lab. Todos os direitos reservados.</p>
        </div>
    </footer>

    <script>
        // Elementos DOM
        const videoGrid = document.getElementById('video-grid');
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
        const resetFiltersBtn = document.getElementById('reset-filters-btn');

        // Estado da aplicação
        let currentCategory = 'all';
        let currentFilters = {
            duration: [],
            category: [],
            level: []
        };
        let currentSearch = '';
        let currentSort = 'recent';
        let currentPage = 1;
        let isLoading = false;
        let isDarkMode = true;
        let allVideos = [];

        // Inicialização
        document.addEventListener('DOMContentLoaded', function() {
            // Carregar preferência de tema
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'light') {
                enableLightMode();
            }

            // Coletar todos os vídeos da página inicial
            const videoCards = document.querySelectorAll('.video-card:not(.skeleton-card)');
            allVideos = Array.from(videoCards).map(card => ({
                element: card,
                id: card.dataset.id,
                title: card.dataset.title.toLowerCase(),
                category: card.dataset.category,
                level: card.dataset.level,
                duration: parseInt(card.dataset.duration),
                description: card.dataset.description.toLowerCase(),
                originalTitle: card.dataset.title
            }));

            // Mostrar loading
            loadingBar.style.display = 'block';

            // Simular carregamento dos vídeos
            setTimeout(() => {
                // Esconder loading
                loadingBar.style.display = 'none';

                // Adicionar event listeners
                setupEventListeners();

                // Aplicar filtros iniciais
                filterVideos();
            }, 500);
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

        // Atualizar contador de vídeos
        function updateVideoCount() {
            const visibleCards = document.querySelectorAll('.video-card:not(.hidden-card):not(.skeleton-card)');
            videoCount.textContent = visibleCards.length;

            // Mostrar/ocultar mensagem de nenhum vídeo
            const noVideosMessage = document.querySelector('.no-videos-message');
            if (visibleCards.length === 0 && !noVideosMessage) {
                showNoResultsMessage();
            } else if (visibleCards.length > 0 && noVideosMessage) {
                noVideosMessage.remove();
            }
        }

        // Mostrar mensagem de nenhum resultado
        function showNoResultsMessage() {
            if (!document.querySelector('.no-videos-message')) {
                const message = document.createElement('div');
                message.className = 'col-span-full text-center py-10 no-videos-message';
                message.innerHTML = `
                    <i class="fas fa-search text-4xl dark-text-secondary mb-4"></i>
                    <h3 class="text-xl font-semibold dark-text mb-2">Nenhum vídeo encontrado</h3>
                    <p class="dark-text-secondary mb-4">Tente ajustar seus filtros ou termos de busca.</p>
                    <button id="reset-filters-btn" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Limpar filtros
                    </button>
                `;
                videoGrid.appendChild(message);

                // Adicionar event listener ao botão
                message.querySelector('#reset-filters-btn').addEventListener('click', clearFilters);
            }
        }

        // Configurar event listeners
        function setupEventListeners() {
            // Alternância de tema
            themeToggle.addEventListener('click', toggleTheme);

            // Pesquisa com debounce
            let searchTimeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    currentSearch = this.value.toLowerCase();
                    filterVideos();
                }, 300);
            });

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
            sortSelect.addEventListener('change', function() {
                currentSort = this.value;
                sortVideos();
            });

            // Filtros de duração, categoria e nível
            document.querySelectorAll('.filter-checkbox').forEach(input => {
                input.addEventListener('change', updateFilters);
            });

            // Botão "Carregar mais"
            if (loadMoreBtn) {
                loadMoreBtn.addEventListener('click', loadMoreVideos);
            }

            // Botão "Limpar filtros"
            clearFiltersBtn.addEventListener('click', clearFilters);

            // Botão "Resetar filtros" na mensagem
            if (resetFiltersBtn) {
                resetFiltersBtn.addEventListener('click', clearFilters);
            }

            // Toggle sidebar em mobile
            filterToggle.addEventListener('click', function() {
                sidebar.classList.toggle('hidden');
            });
        }

        // Atualizar filtros ativos
        function updateFilters() {
            currentFilters.duration = [];
            currentFilters.category = [];
            currentFilters.level = [];

            document.querySelectorAll('.filter-checkbox[data-filter="duration"]:checked').forEach(input => {
                currentFilters.duration.push(input.value);
            });

            document.querySelectorAll('.filter-checkbox[data-filter="category"]:checked').forEach(input => {
                currentFilters.category.push(input.value);
            });

            document.querySelectorAll('.filter-checkbox[data-filter="level"]:checked').forEach(input => {
                currentFilters.level.push(input.value);
            });

            filterVideos();
        }

        // Filtrar vídeos
        function filterVideos() {
            // Resetar página atual
            currentPage = 1;

            // Se houver botão de carregar mais, resetar
            if (loadMoreBtn) {
                loadMoreBtn.style.display = 'block';
                loadMoreBtn.dataset.nextPage = '2';
                loadMoreBtn.querySelector('.load-more-text').textContent = 'Carregar Mais Vídeos';
            }

            allVideos.forEach(video => {
                const {
                    element,
                    title,
                    category,
                    level,
                    duration,
                    description
                } = video;

                // Verificar filtro de categoria (botões)
                const categoryMatch = currentCategory === 'all' || category === currentCategory;

                // Verificar filtro de busca
                const searchMatch = !currentSearch ||
                    title.includes(currentSearch) ||
                    description.includes(currentSearch) ||
                    video.originalTitle.toLowerCase().includes(currentSearch);

                // Verificar filtro de nível
                const levelMatch = currentFilters.level.length === 0 ||
                    currentFilters.level.includes(level);

                // Verificar filtro de categoria (checkboxes)
                const categoryCheckboxMatch = currentFilters.category.length === 0 ||
                    currentFilters.category.includes(category);

                // Verificar filtro de duração
                let durationMatch = currentFilters.duration.length === 0;
                if (!durationMatch) {
                    const durationInMinutes = Math.floor(duration / 60);
                    if (currentFilters.duration.includes('short') && durationInMinutes <= 10) durationMatch = true;
                    if (currentFilters.duration.includes('medium') && durationInMinutes > 10 && durationInMinutes <=
                        30)
                        durationMatch = true;
                    if (currentFilters.duration.includes('long') && durationInMinutes > 30) durationMatch = true;
                }

                // Verificar todos os filtros
                if (categoryMatch && searchMatch && levelMatch && categoryCheckboxMatch && durationMatch) {
                    element.classList.remove('hidden-card');
                } else {
                    element.classList.add('hidden-card');
                }
            });

            // Ordenar vídeos
            sortVideos();

            // Atualizar contador
            updateVideoCount();
        }

        // Ordenar vídeos
        function sortVideos() {
            const visibleVideos = allVideos.filter(video =>
                !video.element.classList.contains('hidden-card')
            );

            // Ordenar os vídeos visíveis
            visibleVideos.sort((a, b) => {
                switch (currentSort) {
                    case 'title':
                        return a.originalTitle.localeCompare(b.originalTitle);
                    case 'duration':
                        return a.duration - b.duration;
                    case 'recent':
                    default:
                        return b.id - a.id; // Assumindo que IDs mais altos são mais recentes
                }
            });

            // Reorganizar no DOM
            visibleVideos.forEach((video, index) => {
                videoGrid.appendChild(video.element);
                video.element.style.animationDelay = `${index * 0.05}s`;
                video.element.classList.add('animate-in');
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
                category: [],
                level: []
            };
            currentSearch = '';
            searchInput.value = '';
            currentSort = 'recent';
            sortSelect.value = 'recent';
            currentPage = 1;

            // Mostrar todos os vídeos
            allVideos.forEach(video => {
                video.element.classList.remove('hidden-card');
            });

            // Resetar botão de carregar mais
            if (loadMoreBtn) {
                loadMoreBtn.style.display = 'block';
                loadMoreBtn.dataset.nextPage = '2';
                loadMoreBtn.querySelector('.load-more-text').textContent = 'Carregar Mais Vídeos';
            }

            // Atualizar contador
            updateVideoCount();

            // Ordenar vídeos
            sortVideos();
        }

        // Carregar mais vídeos
        async function loadMoreVideos() {
            if (isLoading || !loadMoreBtn) return;

            const nextPage = parseInt(loadMoreBtn.dataset.nextPage);
            const totalPages = parseInt(loadMoreBtn.dataset.totalPages);

            if (nextPage > totalPages) {
                loadMoreBtn.style.display = 'none';
                return;
            }

            isLoading = true;
            loadMoreBtn.disabled = true;
            loadMoreBtn.querySelector('.loading-spinner').classList.add('active');
            loadMoreBtn.querySelector('.load-more-text').textContent = 'Carregando...';

            try {
                // Construir URL com filtros atuais
                const params = new URLSearchParams({
                    page: nextPage,
                    category: currentCategory !== 'all' ? currentCategory : '',
                    search: currentSearch,
                    sort: currentSort,
                    durations: currentFilters.duration.join(','),
                    categories: currentFilters.category.join(','),
                    levels: currentFilters.level.join(',')
                });

                const response = await fetch(`/videos/load-more?${params.toString()}`);
                const data = await response.json();

                if (data.success && data.videos.length > 0) {
                    // Adicionar novos vídeos ao grid
                    const fragment = document.createDocumentFragment();

                    data.videos.forEach(video => {
                        const videoCard = createVideoCard(video);
                        fragment.appendChild(videoCard);

                        // Adicionar aos vídeos disponíveis para filtragem
                        allVideos.push({
                            element: videoCard,
                            id: video.id,
                            title: video.title.toLowerCase(),
                            category: video.category_slug,
                            level: video.level,
                            duration: video.duration_seconds,
                            description: video.description.toLowerCase(),
                            originalTitle: video.title
                        });
                    });

                    videoGrid.appendChild(fragment);

                    // Atualizar página atual
                    currentPage = nextPage;
                    loadMoreBtn.dataset.nextPage = nextPage + 1;

                    // Se não há mais páginas, esconder botão
                    if (nextPage >= totalPages) {
                        loadMoreBtn.style.display = 'none';
                    }

                    // Aplicar filtros aos novos vídeos
                    filterVideos();
                } else {
                    loadMoreBtn.style.display = 'none';
                }
            } catch (error) {
                console.error('Erro ao carregar mais vídeos:', error);
                loadMoreBtn.querySelector('.load-more-text').textContent = 'Erro ao carregar';
                setTimeout(() => {
                    loadMoreBtn.querySelector('.load-more-text').textContent = 'Carregar Mais Vídeos';
                }, 2000);
            } finally {
                isLoading = false;
                loadMoreBtn.disabled = false;
                loadMoreBtn.querySelector('.loading-spinner').classList.remove('active');
                loadMoreBtn.querySelector('.load-more-text').textContent = 'Carregar Mais Vídeos';
            }
        }

        // Criar elemento de card de vídeo
        function createVideoCard(video) {
            const card = document.createElement('div');
            card.className = 'video-card border shadow-md rounded-xl animate-in hover:scale-95 transition-transform';
            card.dataset.id = video.id;
            card.dataset.title = video.title;
            card.dataset.category = video.category_slug;
            card.dataset.level = video.level;
            card.dataset.duration = video.duration_seconds;
            card.dataset.description = video.description;

            // Formatar duração
            const durationFormatted = formatDuration(video.duration_seconds);

            // Determinar classe do badge baseado no nível
            const badgeClass = `badge-${video.level}`;

            card.innerHTML = `
                <a href="/video/${video.id}" class="relative block">
                    <img src="${video.thumbnail || '/assets/img/video.png'}" class="w-full h-40 object-cover rounded-t-xl" alt="${video.title}" />
                    <div class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded">
                        ${durationFormatted}
                    </div>
                    <div class="absolute top-2 right-2">
                        <span class="px-2 py-1 text-xs rounded ${badgeClass}">
                            ${video.category_name}
                        </span>
                    </div>
                </a>
                <div class="p-4 flex flex-col flex-1">
                    <h3 class="font-semibold dark-text mb-2">${video.title}</h3>
                    <p class="text-sm dark-text-secondary mb-3 line-clamp-2">${video.description.substring(0, 100)}${video.description.length > 100 ? '...' : ''}</p>
                    <div class="flex items-center justify-between mt-auto">
                        <span class="text-xs dark-text-secondary">
                            <i class="fas fa-user-circle text-gray-400"></i> ${video.user_name}
                        </span>
                        <a href="/video/${video.id}" class="text-blue-400 hover:text-blue-300 text-sm font-medium view-details hover:opacity-85 ease-in-out active:scale-90">
                            Ver detalhes
                        </a>
                    </div>
                </div>
            `;

            return card;
        }

        // Formatar duração
        function formatDuration(seconds) {
            const hours = Math.floor(seconds / 3600);
            const minutes = Math.floor((seconds % 3600) / 60);
            const secs = seconds % 60;

            if (hours > 0) {
                return `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
            }
            return `${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
        }
    </script>
</body>

</html>
