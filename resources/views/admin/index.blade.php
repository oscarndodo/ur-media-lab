<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin - Biblioteca Digital</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .main-content-expanded {
            margin-left: 70px;
        }

        .main-content-full {
            margin-left: 250px;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-gray-50 text-gray-900">
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar fixed left-0 top-0 h-full bg-gray-900 text-white w-64 z-40 shadow-lg">
        <!-- Logo -->
        <div class="p-6 border-b border-gray-800">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-play text-white"></i>
                </div>
                <div class="sidebar-text">
                    <h1 class="text-xl font-bold">Admin</h1>
                    <p class="text-xs text-gray-400">Biblioteca Digital</p>
                </div>
            </div>
        </div>

        <!-- Menu -->
        <nav class="p-4 space-y-1">
            <a href="{{ route('admin.home') }}"
                class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg bg-blue-600 text-white">
                <i class="fas fa-tachometer-alt w-5 text-center"></i>
                <span class="sidebar-text">Dashboard</span>
            </a>


            <a href="{{ route('admin.teachers') }}"
                class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800 text-gray-300">
                <i class="fas fa-chalkboard-teacher w-5 text-center"></i>
                <span class="sidebar-text">Professores</span>
            </a>


            <a href="{{ route('admin.categories') }}"
                class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800 text-gray-300">
                <i class="fas fa-tags w-5 text-center"></i>
                <span class="sidebar-text">Categorias</span>
            </a>

            <a href="{{ route('admin.config') }}"
                class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800 text-gray-300">
                <i class="fas fa-cog w-5 text-center"></i>
                <span class="sidebar-text">Configurações</span>
            </a>
        </nav>

        <!-- Collapse Button -->
        <div class="absolute bottom-4 left-4 right-4">
            <button id="sidebar-toggle"
                class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-gray-800 rounded-lg hover:bg-gray-700">
                <i class="fas fa-chevron-left"></i>
                <span class="sidebar-text">Recolher Menu</span>
            </button>
        </div>
    </div>

    <!-- Main Content -->
    <div id="main-content" class="main-content-full min-h-screen transition-all duration-300">
        <!-- Top Bar -->
        {{-- <header class="bg-white border-b shadow-sm sticky top-0 z-30">
            <div class="px-6 py-4 flex justify-between items-center">
                <!-- Breadcrumb -->
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Dashboard Admin</h2>
                    <nav class="flex items-center gap-2 text-sm text-gray-600 mt-1">
                        <span>Admin</span>
                        <i class="fas fa-chevron-right text-xs"></i>
                        <span class="text-gray-800">Dashboard</span>
                    </nav>
                </div>

                <!-- User Menu -->
                <div class="flex items-center gap-4">
                    <!-- Notifications -->
                    <div class="relative">
                        <button id="notifications-btn"
                            class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-200 relative">
                            <i class="fas fa-bell text-gray-600"></i>
                            <span
                                class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
                        </button>

                        <!-- Notifications Dropdown -->
                        <div id="notifications-dropdown"
                            class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl border hidden z-50">
                            <div class="p-4 border-b">
                                <h3 class="font-semibold text-gray-800">Notificações</h3>
                            </div>
                            <div class="max-h-96 overflow-y-auto">
                                <div class="p-4 border-b hover:bg-gray-50">
                                    <div class="flex items-start gap-3">
                                        <div
                                            class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-video text-blue-600"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium">Novo vídeo enviado</p>
                                            <p class="text-xs text-gray-500">"JavaScript Avançado" aguarda aprovação</p>
                                            <p class="text-xs text-gray-400 mt-1">Há 2 minutos</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-4 border-b hover:bg-gray-50">
                                    <div class="flex items-start gap-3">
                                        <div
                                            class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-user text-green-600"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium">Novo professor registrado</p>
                                            <p class="text-xs text-gray-500">Carlos Silva se registrou como instrutor
                                            </p>
                                            <p class="text-xs text-gray-400 mt-1">Há 1 hora</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-4 hover:bg-gray-50">
                                    <div class="flex items-start gap-3">
                                        <div
                                            class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-comment text-yellow-600"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium">Novo comentário reportado</p>
                                            <p class="text-xs text-gray-500">Comentário #1234 foi reportado</p>
                                            <p class="text-xs text-gray-400 mt-1">Há 3 horas</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 border-t text-center">
                                <a href="#" class="text-sm text-blue-600 hover:text-blue-800">Ver todas</a>
                            </div>
                        </div>
                    </div>

                    <!-- User Dropdown -->
                    <div class="relative">
                        <button id="user-menu-btn" class="flex items-center gap-3 hover:bg-gray-100 p-2 rounded-lg">
                            <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div class="text-left hidden md:block">
                                <p class="font-medium text-gray-800">Admin</p>
                                <p class="text-xs text-gray-500">Administrador</p>
                            </div>
                            <i class="fas fa-chevron-down text-gray-500"></i>
                        </button>

                        <!-- User Dropdown Menu -->
                        <div id="user-dropdown"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border hidden z-50">
                            <div class="p-4 border-b">
                                <p class="font-medium text-gray-800">Administrador</p>
                                <p class="text-sm text-gray-500">admin@biblioteca.com</p>
                            </div>
                            <div class="p-2">
                                <a href="#"
                                    class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-100 text-gray-700">
                                    <i class="fas fa-user text-gray-400 w-5"></i>
                                    <span>Meu Perfil</span>
                                </a>
                                <a href="#"
                                    class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-100 text-gray-700">
                                    <i class="fas fa-cog text-gray-400 w-5"></i>
                                    <span>Configurações</span>
                                </a>
                                <a href="#"
                                    class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-100 text-gray-700">
                                    <i class="fas fa-question-circle text-gray-400 w-5"></i>
                                    <span>Ajuda</span>
                                </a>
                                <div class="border-t my-2"></div>
                                <a href="login.html"
                                    class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-100 text-red-600">
                                    <i class="fas fa-sign-out-alt text-red-400 w-5"></i>
                                    <span>Sair</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header> --}}

        <!-- Dashboard Content -->
        @yield('main')
    </div>


    <script src="{{ asset('assets/js/loader.js') }}"></script>
    @stack('scripts')
</body>

</html>
