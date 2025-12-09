<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Introdução ao HTML - Biblioteca Digital</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Tema escuro padrão */
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
            --skeleton-light: #334155;
            --skeleton-dark: #475569;
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
            --skeleton-light: #f0f0f0;
            --skeleton-dark: #e0e0e0;
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

        .menu-hidden {
            transform: translateY(-100%);
            opacity: 0;
            pointer-events: none;
        }

        .menu-visible {
            transform: translateY(0);
            opacity: 1;
            transition: all 0.3s ease;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
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

        .progress-bar {
            width: 100%;
            height: 4px;
            background: #374151;
            border-radius: 2px;
            overflow: hidden;
        }

        .light-theme .progress-bar {
            background: #e5e7eb;
        }

        .progress-fill {
            height: 100%;
            background: var(--accent-color);
            width: 35%;
            transition: width 0.3s ease;
        }

        .playlist-item.active {
            background-color: rgba(59, 130, 246, 0.1);
            border-left: 3px solid var(--accent-color);
        }

        .light-theme .playlist-item.active {
            background-color: #eff6ff;
        }

        .video-container {
            aspect-ratio: 16/9;
        }

        @media (max-width: 768px) {
            .video-container {
                aspect-ratio: 4/3;
            }
        }

        .player-controls {
            transition: opacity 0.3s ease;
        }

        .video-wrapper:hover .player-controls {
            opacity: 1;
        }

        /* Classes para tema escuro */
        .dark-bg {
            background-color: var(--bg-secondary);
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

        /* Botão de toggle do tema */
        .theme-toggle {
            background: var(--bg-tertiary);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            transition: all 0.3s ease;
        }

        .theme-toggle:hover {
            background: var(--bg-secondary);
        }

        /* Override para elementos específicos no modo escuro */
        .dark-card {
            background-color: var(--bg-secondary);
            border-color: var(--border-color);
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
    </style>
</head>

<body class="dark-theme">
    <!-- Loading bar -->
    <div id="loading-bar" class="fixed top-0 left-0 right-0 z-50 h-1">
        <div class="h-full w-0 bg-blue-600 transition-all duration-500"></div>
    </div>

    <!-- Header -->
    <header class="w-full border-b dark-bg sticky top-0 z-40 shadow-sm dark-border">
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
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>

                <!-- Botão para alternar tema -->
                <button id="theme-toggle" class="p-2 border rounded-lg theme-toggle">
                    <i class="fas fa-moon" id="theme-icon"></i>
                </button>

                <button id="filter-toggle" class="p-2 border rounded-lg dark-button sm:hidden">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Conteúdo Principal -->
    <main class="max-w-6xl mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Player e Informações do Vídeo -->
            <section class="lg:w-2/3">
                <!-- Player de Vídeo -->
                <div class="video-wrapper relative bg-black rounded-xl overflow-hidden mb-6">
                    <div class="video-container">
                        <!-- Skeleton do player -->
                        <div id="player-skeleton" class="w-full h-full skeleton"></div>

                        <!-- Player real (inicialmente oculto) -->
                        <div id="video-player" class="hidden w-full h-full flex items-center justify-center relative">
                            <div class="text-center text-white">
                                <i class="fas fa-play text-5xl mb-4"></i>
                                <p class="text-xl font-medium">Player de Vídeo</p>
                                <p class="text-gray-300 mt-2">Introdução ao HTML</p>
                            </div>

                            <!-- Controles do player -->
                            <div
                                class="player-controls absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-4 opacity-0">
                                <div class="progress-bar mb-3">
                                    <div class="progress-fill"></div>
                                </div>
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center gap-4">
                                        <button class="text-white hover:text-gray-300">
                                            <i class="fas fa-play text-lg"></i>
                                        </button>
                                        <span class="text-white text-sm">12:00 / 35:00</span>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <button class="text-white hover:text-gray-300">
                                            <i class="fas fa-volume-up"></i>
                                        </button>
                                        <button class="text-white hover:text-gray-300">
                                            <i class="fas fa-expand"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informações do Vídeo -->
                <div class="dark-card rounded-xl p-6 shadow-sm mb-6 dark-border">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
                        <h1 class="text-2xl font-bold dark-text">Introdução ao HTML</h1>
                        <div class="flex items-center gap-3">
                            <button
                                class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                <i class="far fa-heart"></i>
                                Favoritar
                            </button>
                            <button class="flex items-center gap-2 px-4 py-2 border rounded-lg dark-button dark-border">
                                <i class="fas fa-share"></i>
                                Compartilhar
                            </button>
                        </div>
                    </div>

                    <!-- Metadados -->
                    <div class="flex flex-wrap gap-4 mb-6 text-sm dark-text-secondary">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-eye"></i>
                            <span>2.5K visualizações</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-calendar"></i>
                            <span>Publicado em 15 Mar 2023</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-clock"></i>
                            <span>12 minutos</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-tag"></i>
                            <span
                                class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded dark:bg-blue-900 dark:text-blue-200">Programação</span>
                        </div>
                    </div>

                    <!-- Descrição -->
                    <div class="mb-6">
                        <h3 class="font-semibold dark-text mb-3">Descrição</h3>
                        <p class="dark-text-secondary leading-relaxed">
                            Aprenda os fundamentos do HTML para criação de páginas web. Este vídeo cobre tags básicas,
                            estrutura de documentos e boas práticas.
                            Ideal para quem está começando no desenvolvimento web. Vamos explorar desde os conceitos
                            mais básicos até a criação de sua primeira página HTML.
                        </p>
                    </div>

                    <!-- Instrutor -->
                    <div class="border-t pt-6 dark-border">
                        <h3 class="font-semibold dark-text mb-4">Sobre o Instrutor</h3>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-gray-700 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <div>
                                <h4 class="font-medium dark-text">Carlos Silva</h4>
                                <p class="text-sm dark-text-secondary mb-2">Desenvolvedor Frontend com 8 anos de
                                    experiência</p>
                                <p class="text-sm dark-text-secondary">
                                    Especialista em HTML, CSS e JavaScript. Já ministrou mais de 50 cursos online e
                                    ajudou milhares de estudantes a iniciarem sua jornada no desenvolvimento web.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Comentários -->
                <div class="dark-card rounded-xl p-6 shadow-sm dark-border">
                    <h3 class="font-semibold dark-text mb-6">Comentários (24)</h3>

                    <!-- Formulário de comentário -->
                    <div class="mb-8">
                        <textarea placeholder="Adicione um comentário..."
                            class="w-full p-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mb-3 dark-input dark-border"
                            rows="3"></textarea>
                        <div class="flex justify-end">
                            <button class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                Comentar
                            </button>
                        </div>
                    </div>

                    <!-- Lista de comentários -->
                    <div class="space-y-6">
                        <!-- Comentário 1 -->
                        <div class="border-b pb-6 dark-border">
                            <div class="flex items-start gap-3 mb-3">
                                <div class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium dark-text">Ana Santos</h4>
                                    <p class="text-xs dark-text-secondary">Há 2 dias</p>
                                </div>
                            </div>
                            <p class="dark-text-secondary">
                                Excelente explicação! Consegui entender conceitos que antes pareciam complicados.
                                Obrigada!
                            </p>
                            <div class="flex items-center gap-4 mt-3">
                                <button
                                    class="dark-text-secondary hover:text-blue-600 text-sm flex items-center gap-1">
                                    <i class="far fa-thumbs-up"></i> 12
                                </button>
                                <button class="dark-text-secondary hover:text-blue-600 text-sm">
                                    Responder
                                </button>
                            </div>
                        </div>

                        <!-- Comentário 2 -->
                        <div class="border-b pb-6 dark-border">
                            <div class="flex items-start gap-3 mb-3">
                                <div class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium dark-text">Pedro Almeida</h4>
                                    <p class="text-xs dark-text-secondary">Há 1 semana</p>
                                </div>
                            </div>
                            <p class="dark-text-secondary">
                                Material muito bem estruturado. Gostaria de ver mais vídeos sobre CSS e JavaScript do
                                mesmo instrutor.
                            </p>
                            <div class="flex items-center gap-4 mt-3">
                                <button
                                    class="dark-text-secondary hover:text-blue-600 text-sm flex items-center gap-1">
                                    <i class="far fa-thumbs-up"></i> 8
                                </button>
                                <button class="dark-text-secondary hover:text-blue-600 text-sm">
                                    Responder
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Ver mais comentários -->
                    <div class="text-center mt-6">
                        <button class="px-6 py-2 border rounded-lg dark-button dark-border">
                            Ver mais comentários
                        </button>
                    </div>
                </div>
            </section>

            <!-- Playlist de Vídeos Relacionados -->
            <aside class="lg:w-1/3">
                <div class="sticky top-24">
                    <!-- Playlist atual -->
                    <div class="dark-card rounded-xl p-5 shadow-sm mb-6 dark-border">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-semibold text-lg dark-text">Do mesmo autor</h3>
                            <span class="text-sm dark-text-secondary">1/8</span>
                        </div>

                        <div class="space-y-3 max-h-[500px] overflow-y-auto pr-2">
                            <!-- Item atual -->
                            <div class="playlist-item active p-3 rounded-lg border cursor-pointer dark-border">
                                <div class="flex items-center gap-3">
                                    <div class="w-16 h-12 bg-blue-900 rounded flex items-center justify-center">
                                        <i class="fas fa-play text-blue-400"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-medium dark-text text-sm">Introdução ao HTML</h4>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="text-xs dark-text-secondary">12 min</span>
                                            <span
                                                class="text-xs px-2 py-0.5 bg-green-900 text-green-300 rounded">Atual</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Item da playlist -->
                            <div class="playlist-item p-3 rounded-lg border dark-border hover:bg-gray-800 cursor-pointer"
                                data-video-id="2">
                                <div class="flex items-center gap-3">
                                    <div class="w-16 h-12 skeleton"></div>
                                    <div class="flex-1">
                                        <div class="h-3 skeleton w-3/4 mb-2"></div>
                                        <div class="h-2 skeleton w-1/3"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Vídeos relacionados -->
                            <div class="playlist-video hidden p-3 rounded-lg border dark-border hover:bg-gray-800 cursor-pointer"
                                data-video-id="2">
                                <div class="flex items-center gap-3">
                                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80"
                                        alt="Fundamentos de CSS" class="w-16 h-12 object-cover rounded">
                                    <div class="flex-1">
                                        <h4 class="font-medium dark-text text-sm">Fundamentos de CSS</h4>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="text-xs dark-text-secondary">25 min</span>
                                            <span
                                                class="text-xs px-2 py-0.5 bg-green-900 text-green-300 rounded">Iniciante</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="playlist-video hidden p-3 rounded-lg border dark-border hover:bg-gray-800 cursor-pointer"
                                data-video-id="3">
                                <div class="flex items-center gap-3">
                                    <img src="https://images.unsplash.com/photo-1579468118864-1b9ea3c0db4a?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80"
                                        alt="JavaScript para Iniciantes" class="w-16 h-12 object-cover rounded">
                                    <div class="flex-1">
                                        <h4 class="font-medium dark-text text-sm">JavaScript para Iniciantes</h4>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="text-xs dark-text-secondary">42 min</span>
                                            <span
                                                class="text-xs px-2 py-0.5 bg-green-900 text-green-300 rounded">Iniciante</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="playlist-video hidden p-3 rounded-lg border dark-border hover:bg-gray-800 cursor-pointer"
                                data-video-id="7">
                                <div class="flex items-center gap-3">
                                    <img src="https://images.unsplash.com/photo-1633356122544-f134324a6cee?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80"
                                        alt="Introdução ao React" class="w-16 h-12 object-cover rounded">
                                    <div class="flex-1">
                                        <h4 class="font-medium dark-text text-sm">Introdução ao React</h4>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="text-xs dark-text-secondary">45 min</span>
                                            <span
                                                class="text-xs px-2 py-0.5 bg-yellow-900 text-yellow-300 rounded">Intermediário</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="playlist-video hidden p-3 rounded-lg border dark-border hover:bg-gray-800 cursor-pointer"
                                data-video-id="11">
                                <div class="flex items-center gap-3">
                                    <img src="https://images.unsplash.com/photo-1633356122544-f134324a6cee?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80"
                                        alt="Vue.js do Zero" class="w-16 h-12 object-cover rounded">
                                    <div class="flex-1">
                                        <h4 class="font-medium dark-text text-sm">Vue.js do Zero</h4>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="text-xs dark-text-secondary">40 min</span>
                                            <span
                                                class="text-xs px-2 py-0.5 bg-yellow-900 text-yellow-300 rounded">Intermediário</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Vídeos Relacionados -->
                    <div class="dark-card rounded-xl p-5 shadow-sm dark-border">
                        <h3 class="font-semibold text-lg dark-text mb-4">Vídeos Relacionados</h3>

                        <div class="space-y-4">
                            <!-- Skeleton cards -->
                            <div class="skeleton-card">
                                <div class="h-32 skeleton rounded-lg mb-3"></div>
                                <div class="h-3 skeleton w-3/4 mb-2"></div>
                                <div class="h-2 skeleton w-1/2"></div>
                            </div>

                            <div class="skeleton-card">
                                <div class="h-32 skeleton rounded-lg mb-3"></div>
                                <div class="h-3 skeleton w-3/4 mb-2"></div>
                                <div class="h-2 skeleton w-1/2"></div>
                            </div>

                            <!-- Vídeos relacionados reais -->
                            <div class="related-video hidden">
                                <a href="#" class="group">
                                    <div class="relative overflow-hidden rounded-lg mb-3">
                                        <img src="https://images.unsplash.com/photo-1558655146-364adaf1fcc9?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                                            alt="Design Responsivo"
                                            class="w-full h-32 object-cover group-hover:scale-105 transition-transform duration-300">
                                        <div
                                            class="absolute bottom-2 right-2 bg-black/70 text-white text-xs px-2 py-1 rounded">
                                            28 min
                                        </div>
                                    </div>
                                    <h4 class="font-medium dark-text group-hover:text-blue-400">Design Responsivo
                                        com CSS</h4>
                                    <p class="text-sm dark-text-secondary mt-1">Crie sites que se adaptam a qualquer
                                        dispositivo</p>
                                    <div class="flex items-center gap-2 mt-2">
                                        <span class="text-xs dark-text-secondary">Design</span>
                                        <span
                                            class="text-xs px-2 py-0.5 bg-yellow-900 text-yellow-300 rounded">Intermediário</span>
                                    </div>
                                </a>
                            </div>

                        </div>

                        <!-- Ver mais vídeos -->
                        <div class="mt-6 pt-4 border-t dark-border">
                            <a href="/"
                                class="flex items-center justify-center gap-2 text-blue-400 hover:text-blue-300 font-medium">
                                <span>Ver todos os vídeos</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </aside>
        </div>
    </main>

    <!-- Footer -->
    <footer class="dark-bg py-10 mt-12"></footer>

    <script>
        // Elementos DOM
        const loadingBar = document.getElementById('loading-bar');
        const playerSkeleton = document.getElementById('player-skeleton');
        const videoPlayer = document.getElementById('video-player');
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const playlistSkeletons = document.querySelectorAll('.playlist-item .skeleton');
        const playlistVideos = document.querySelectorAll('.playlist-video');
        const relatedSkeletons = document.querySelectorAll('.skeleton-card');
        const relatedVideos = document.querySelectorAll('.related-video');
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');

        // Estado do vídeo atual
        let currentVideoId = 1;
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
            loadingBar.querySelector('div').style.width = '30%';

            // Simular carregamento do player
            setTimeout(() => {
                loadingBar.querySelector('div').style.width = '70%';

                // Carregar player
                setTimeout(() => {
                    playerSkeleton.style.display = 'none';
                    videoPlayer.classList.remove('hidden');
                    loadingBar.querySelector('div').style.width = '100%';

                    // Esconder loading bar
                    setTimeout(() => {
                        loadingBar.style.display = 'none';
                    }, 300);

                    // Carregar playlist e vídeos relacionados
                    loadPlaylist();
                }, 1000);
            }, 500);

            // Event listener para alternar tema
            themeToggle.addEventListener('click', toggleTheme);

            // Event listeners para itens da playlist
            document.querySelectorAll('.playlist-item, .playlist-video').forEach(item => {
                item.addEventListener('click', function(e) {
                    // Evitar clique no item atual
                    if (this.classList.contains('active')) return;

                    const videoId = this.dataset.videoId;
                    if (videoId) {
                        loadVideo(videoId);
                    }
                });
            });

            // Event listeners para vídeos relacionados
            document.querySelectorAll('.related-video a').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    // Aqui normalmente carregaria outro vídeo
                    // Simulando com alert
                    alert('Carregando vídeo relacionado...');
                });
            });

            // Simular interação com controles do player
            const playButton = document.querySelector('.player-controls .fa-play');
            if (playButton) {
                playButton.addEventListener('click', function() {
                    if (this.classList.contains('fa-play')) {
                        this.classList.remove('fa-play');
                        this.classList.add('fa-pause');
                    } else {
                        this.classList.remove('fa-pause');
                        this.classList.add('fa-play');
                    }
                });
            }

            // Mostrar/ocultar controles ao passar o mouse
            const videoWrapper = document.querySelector('.video-wrapper');
            const controls = document.querySelector('.player-controls');

            if (videoWrapper && controls) {
                videoWrapper.addEventListener('mouseenter', function() {
                    controls.style.opacity = '1';
                });

                videoWrapper.addEventListener('mouseleave', function() {
                    controls.style.opacity = '0';
                });

                // Manter controles visíveis em mobile
                if (window.innerWidth <= 768) {
                    controls.style.opacity = '1';
                }
            }
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

        // Carregar playlist
        function loadPlaylist() {
            // Simular carregamento da playlist
            setTimeout(() => {
                // Remover skeletons da playlist
                document.querySelectorAll('.playlist-item .skeleton').forEach(skeleton => {
                    skeleton.closest('.playlist-item').remove();
                });

                // Mostrar vídeos da playlist
                playlistVideos.forEach((video, index) => {
                    setTimeout(() => {
                        video.classList.remove('hidden');
                        video.classList.add('fade-in');
                    }, index * 200);
                });

                // Remover skeletons dos relacionados
                relatedSkeletons.forEach(skeleton => {
                    skeleton.closest('.skeleton-card').remove();
                });

                // Mostrar vídeos relacionados
                relatedVideos.forEach((video, index) => {
                    setTimeout(() => {
                        video.classList.remove('hidden');
                        video.classList.add('fade-in');
                    }, index * 200);
                });
            }, 800);
        }

        // Carregar vídeo (simulação)
        function loadVideo(videoId) {
            // Mostrar loading
            loadingBar.style.display = 'block';
            loadingBar.querySelector('div').style.width = '30%';

            // Remover classe active de todos os itens
            document.querySelectorAll('.playlist-item, .playlist-video').forEach(item => {
                item.classList.remove('active');
            });

            // Adicionar active ao item clicado
            const clickedItem = document.querySelector(`[data-video-id="${videoId}"]`);
            if (clickedItem) {
                clickedItem.classList.add('active');
            }

            // Simular carregamento do vídeo
            setTimeout(() => {
                loadingBar.querySelector('div').style.width = '70%';

                // Atualizar informações do vídeo
                updateVideoInfo(videoId);

                setTimeout(() => {
                    loadingBar.querySelector('div').style.width = '100%';

                    // Esconder loading
                    setTimeout(() => {
                        loadingBar.style.display = 'none';
                    }, 300);
                }, 500);
            }, 300);
        }

        // Atualizar informações do vídeo (simulação)
        function updateVideoInfo(videoId) {
            const videoData = {
                '2': {
                    title: 'Fundamentos de CSS',
                    description: 'Domine os conceitos básicos do CSS para estilizar páginas web. Inclui seletores, box model e propriedades fundamentais.',
                    duration: '25',
                    views: '3.1K',
                    level: 'Iniciante',
                    category: 'Frontend'
                },
                '3': {
                    title: 'JavaScript para Iniciantes',
                    description: 'Introdução à linguagem JavaScript. Aprenda variáveis, funções, estruturas de controle e manipulação do DOM.',
                    duration: '42',
                    views: '4.2K',
                    level: 'Iniciante',
                    category: 'Frontend'
                },
                '7': {
                    title: 'Introdução ao React',
                    description: 'Aprenda os fundamentos do React, uma das bibliotecas JavaScript mais populares para criação de interfaces.',
                    duration: '45',
                    views: '3.8K',
                    level: 'Intermediário',
                    category: 'Frontend'
                }
            };

            if (videoData[videoId]) {
                const data = videoData[videoId];

                // Atualizar título
                document.querySelector('h1.text-2xl').textContent = data.title;

                // Atualizar metadados
                document.querySelector('[data-duration]').textContent = `${data.duration} minutos`;
                document.querySelector('[data-views]').textContent = `${data.views} visualizações`;
                document.querySelector('[data-category]').textContent = data.category;

                // Atualizar descrição
                document.querySelector('p.dark-text-secondary.leading-relaxed').textContent = data.description;

                // Atualizar player
                const playerText = videoPlayer.querySelector('.text-center p:last-child');
                playerText.textContent = data.title;

                currentVideoId = videoId;
            }
        }
    </script>
</body>

</html>
