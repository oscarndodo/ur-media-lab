<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Biblioteca Digital</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        .fade-in {
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slide-in {
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(-20px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .btn-hover {
            transition: all 0.3s ease;
        }

        .shake {
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            20%,
            60% {
                transform: translateX(-5px);
            }

            40%,
            80% {
                transform: translateX(5px);
            }
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }



        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center gradient-bg p-4">
    <!-- Conteúdo Principal -->
    <div class="max-w-6xl w-full flex flex-col lg:flex-row items-center justify-center gap-8 lg:gap-12">



        <!-- Formulário de Login/Lado Direito -->
        <div class="w-full max-w-md slide-in">
            <div class="bg-white rounded-2xl shadsow-2xl border overflow-hidden">

                <!-- Skeleton Loading (inicial) -->
                <div id="login-skeleton" class="p-8">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-10 skeleton rounded-lg"></div>
                        <div class="h-6 skeleton w-40"></div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <div class="h-4 skeleton w-24 mb-2"></div>
                            <div class="h-12 skeleton rounded-lg"></div>
                        </div>

                        <div>
                            <div class="h-4 skeleton w-24 mb-2"></div>
                            <div class="h-12 skeleton rounded-lg"></div>
                        </div>

                        <div class="h-12 skeleton rounded-lg mt-6"></div>

                        <div class="flex justify-center">
                            <div class="h-4 skeleton w-48"></div>
                        </div>
                    </div>
                </div>

                <!-- Formulário Real (inicialmente oculto) -->
                <div id="login-form" class="hidden p-8">
                    <!-- Cabeçalho do Formulário -->
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                <i class="fas fa-play text-white"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800">Entrar</h2>
                        </div>

                        <div class="relative group">
                            <button id="theme-toggle"
                                class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition-colors">
                                <i class="fas fa-moon text-gray-600"></i>
                            </button>
                            <div
                                class="absolute right-0 top-full mt-2 px-3 py-2 bg-gray-800 text-white text-sm rounded-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 whitespace-nowrap">
                                Alterar tema
                            </div>
                        </div>
                    </div>

                    <!-- Mensagem de Boas-vindas -->
                    <div class="mb-8">
                        <p class="text-gray-600">Use suas credenciais para aceder sua conta</p>
                    </div>

                    <!-- Formulário -->
                    <form id="loginForm" class="space-y-6" action="{{ route('login.auth') }}" method="POST">
                        <!-- Campo Email -->

                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                    <span>Endereço de Email</span>
                                </div>
                            </label>
                            <div class="relative">
                                <input type="email" id="email" name="email" required
                                    class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg input-focus focus:outline-none focus:border-blue-500 transition-all"
                                    placeholder="seu@email.com" />
                                <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                                <div id="email-check"
                                    class="absolute right-4 top-1/2 transform -translate-y-1/2 hidden">
                                    <i class="fas fa-check-circle text-green-500"></i>
                                </div>
                            </div>
                            <div id="email-error" class="text-red-500 text-sm mt-2 hidden">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                <span>Por favor, insira um email válido</span>
                            </div>
                        </div>

                        <!-- Campo Senha -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label for="password" class="block text-sm font-medium text-gray-700">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-lock text-gray-400"></i>
                                        <span>Palavra-Passe </span>
                                    </div>
                                </label>
                                <a href="#" class="text-sm text-blue-600 hover:text-blue-800 hover:underline">
                                    Esqueceu a senha?
                                </a>
                            </div>
                            <div class="relative">
                                <input type="password" id="password" name="password" required
                                    class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg input-focus focus:outline-none focus:border-blue-500 transition-all"
                                    placeholder="***************" />
                                <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                                    <i class="fas fa-key text-gray-400"></i>
                                </div>
                                <button type="button" id="toggle-password"
                                    class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div id="password-error" class="text-red-500 text-sm mt-2 hidden">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                <span>A senha deve ter pelo menos 6 caracteres</span>
                            </div>
                        </div>

                        <!-- Lembrar de Mim -->
                        <div class="flex items-center">
                            <input type="checkbox" id="remember" name="remember"
                                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="remember" class="ml-3 text-sm text-gray-700">
                                Lembrar de mim
                            </label>
                        </div>

                        <!-- Botão de Login -->
                        <button type="submit" id="login-button"
                            class="w-full py-3 bg-blue-600 text-white rounded-lg font-medium btn-hover hover:bg-blue-700 flex items-center justify-center gap-2">
                            <span id="login-text">Entrar na Conta</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>



                        <!-- Link para Registro -->
                        <div class="text-center pt-6 border-t border-gray-200">
                            <p class="text-gray-600">
                                Não tem uma conta?
                                <a href="#"
                                    class="text-blue-600 font-medium hover:text-blue-800 hover:underline ml-1">
                                    Contacte o Suporte
                                </a>
                            </p>
                        </div>
                    </form>
                </div>

            </div>

            <!-- Rodapé -->
            <div class="mt-6 text-center text-white/80">
                <p class="text-sm">
                    © 2023 Biblioteca Digital. Todos os direitos reservados.
                    <a href="#" class="hover:text-white underline ml-1">Termos de uso</a> •
                    <a href="#" class="hover:text-white underline ml-1">Privacidade</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        // Elementos DOM
        const loginSkeleton = document.getElementById('login-skeleton');
        const loginForm = document.getElementById('login-form');
        const loginFormElement = document.getElementById('loginForm');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const togglePasswordBtn = document.getElementById('toggle-password');
        const emailCheck = document.getElementById('email-check');
        const emailError = document.getElementById('email-error');
        const passwordError = document.getElementById('password-error');
        const loginButton = document.getElementById('login-button');
        const loginText = document.getElementById('login-text');
        const themeToggle = document.getElementById('theme-toggle');

        // Estado
        let isPasswordVisible = false;
        let isDarkTheme = false;

        // Inicialização
        document.addEventListener('DOMContentLoaded', function() {
            // Simular carregamento
            setTimeout(() => {
                loginSkeleton.style.display = 'none';
                loginForm.classList.remove('hidden');
                loginForm.classList.add('fade-in');
            }, 1000);



        });

        // Configurar event listeners
        function setupEventListeners() {
            // Validação de email em tempo real
            emailInput.addEventListener('input', function() {
                validateEmail();
            });

            // Validação de senha em tempo real
            passwordInput.addEventListener('input', function() {
                validatePassword();
            });

            // Toggle visibilidade da senha
            togglePasswordBtn.addEventListener('click', function() {
                togglePasswordVisibility();
            });

            // Submissão do formulário
            loginFormElement.addEventListener('submit', function(e) {
                showLoadingState();
            });


            // Toggle de tema
            themeToggle.addEventListener('click', toggleTheme);

        }

        // Validar email
        function validateEmail() {
            const email = emailInput.value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (email === '') {
                emailCheck.classList.add('hidden');
                emailError.classList.add('hidden');
                return false;
            }

            if (emailRegex.test(email)) {
                emailCheck.classList.remove('hidden');
                emailError.classList.add('hidden');
                return true;
            } else {
                emailCheck.classList.add('hidden');
                emailError.classList.remove('hidden');
                return false;
            }
        }

        // Validar senha
        function validatePassword() {
            const password = passwordInput.value;

            if (password === '') {
                passwordError.classList.add('hidden');
                return false;
            }

            if (password.length > 5) {
                passwordError.classList.add('hidden');
                return true;
            } else {
                passwordError.classList.remove('hidden');
                return false;
            }
        }

        // Alternar visibilidade da senha
        function togglePasswordVisibility() {
            isPasswordVisible = !isPasswordVisible;

            if (isPasswordVisible) {
                passwordInput.type = 'text';
                togglePasswordBtn.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                passwordInput.type = 'password';
                togglePasswordBtn.innerHTML = '<i class="fas fa-eye"></i>';
            }
        }

        // Mostrar estado de carregamento
        function showLoadingState() {
            loginButton.disabled = true;
            loginText.textContent = 'Entrando...';
            loginButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        }



        // Alternar tema claro/escuro
        function toggleTheme() {
            isDarkTheme = !isDarkTheme;
            const icon = themeToggle.querySelector('i');

            if (isDarkTheme) {
                document.body.classList.add('bg-gray-900');
                document.body.classList.remove('gradient-bg');
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
                icon.classList.add('text-yellow-400');
            } else {
                document.body.classList.remove('bg-gray-900');
                document.body.classList.add('gradient-bg');
                icon.classList.remove('fa-sun');
                icon.classList.remove('text-yellow-400');
                icon.classList.add('fa-moon');
                icon.classList.add('text-gray-600');
            }
        }
    </script>
</body>

</html>
