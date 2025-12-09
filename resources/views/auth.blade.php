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
                    <form id="loginForm" class="space-y-6">
                        <!-- Campo Email -->
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
                                    placeholder="seu@email.com">
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
                                        <span>Palavra-Passe</span>
                                    </div>
                                </label>
                                <a href="#" class="text-sm text-blue-600 hover:text-blue-800 hover:underline">
                                    Esqueceu a senha?
                                </a>
                            </div>
                            <div class="relative">
                                <input type="password" id="password" name="password" required
                                    class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg input-focus focus:outline-none focus:border-blue-500 transition-all"
                                    placeholder="••••••••">
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

                <!-- Mensagem de Sucesso (inicialmente oculta) -->
                <div id="success-message" class="hidden p-8">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-check text-green-600 text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">Login bem-sucedido!</h3>
                        <p class="text-gray-600 mb-8">
                            Redirecionando para a Biblioteca Digital...
                        </p>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div id="progress-bar" class="bg-green-600 h-2 rounded-full w-0"></div>
                        </div>
                    </div>
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

    <!-- Modal de Recuperação de Senha -->
    <div id="forgot-password-modal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 hidden z-50">
        <div class="bg-white rounded-2xl max-w-md w-full p-8 shadow-2xl">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-800">Recuperar Senha</h3>
                <button id="close-modal" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <p class="text-gray-600 mb-6">
                Digite seu email abaixo e enviaremos um link para redefinir sua senha.
            </p>

            <form id="forgot-password-form">
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Email
                    </label>
                    <input type="email"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                        placeholder="seu@email.com" required>
                </div>

                <div class="flex gap-3">
                    <button type="button" id="cancel-forgot"
                        class="flex-1 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                        Cancelar
                    </button>
                    <button type="submit" class="flex-1 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Enviar Link
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Elementos DOM
        const loginSkeleton = document.getElementById('login-skeleton');
        const loginForm = document.getElementById('login-form');
        const successMessage = document.getElementById('success-message');
        const loginFormElement = document.getElementById('loginForm');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const togglePasswordBtn = document.getElementById('toggle-password');
        const emailCheck = document.getElementById('email-check');
        const emailError = document.getElementById('email-error');
        const passwordError = document.getElementById('password-error');
        const loginButton = document.getElementById('login-button');
        const loginText = document.getElementById('login-text');
        const progressBar = document.getElementById('progress-bar');
        const forgotPasswordModal = document.getElementById('forgot-password-modal');
        const closeModalBtn = document.getElementById('close-modal');
        const cancelForgotBtn = document.getElementById('cancel-forgot');
        const forgotPasswordForm = document.getElementById('forgot-password-form');
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

            // Configurar event listeners
            setupEventListeners();

            // Verificar se há credenciais salvas
            checkSavedCredentials();
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
                e.preventDefault();
                handleLogin();
            });

            // Links "Esqueceu a senha?"
            document.querySelectorAll('a[href="#"]').forEach(link => {
                if (link.textContent.includes('Esqueceu')) {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        showForgotPasswordModal();
                    });
                }

                if (link.textContent.includes('Cadastre-se')) {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        showRegistrationMessage();
                    });
                }
            });

            // Modal de recuperação de senha
            closeModalBtn.addEventListener('click', hideForgotPasswordModal);
            cancelForgotBtn.addEventListener('click', hideForgotPasswordModal);

            forgotPasswordForm.addEventListener('submit', function(e) {
                e.preventDefault();
                handleForgotPassword();
            });

            // Fechar modal ao clicar fora
            forgotPasswordModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    hideForgotPasswordModal();
                }
            });

            // Toggle de tema
            themeToggle.addEventListener('click', toggleTheme);

            // Login com Google
            document.querySelector('button:has(.fa-google)').addEventListener('click', function() {
                handleSocialLogin('google');
            });

            // Login com GitHub
            document.querySelector('button:has(.fa-github)').addEventListener('click', function() {
                handleSocialLogin('github');
            });
        }

        // Verificar credenciais salvas
        function checkSavedCredentials() {
            const savedEmail = localStorage.getItem('rememberedEmail');
            const rememberChecked = localStorage.getItem('rememberMe') === 'true';

            if (savedEmail && rememberChecked) {
                emailInput.value = savedEmail;
                document.getElementById('remember').checked = true;
                validateEmail();
            }
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

            if (password.length >= 6) {
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

        // Manipular login
        function handleLogin() {
            const email = emailInput.value;
            const password = passwordInput.value;
            const rememberMe = document.getElementById('remember').checked;

            // Validar campos
            const isEmailValid = validateEmail();
            const isPasswordValid = validatePassword();

            if (!isEmailValid || !isPasswordValid) {
                // Efeito shake nos campos inválidos
                if (!isEmailValid) {
                    emailInput.parentElement.classList.add('shake');
                    setTimeout(() => {
                        emailInput.parentElement.classList.remove('shake');
                    }, 500);
                }

                if (!isPasswordValid) {
                    passwordInput.parentElement.classList.add('shake');
                    setTimeout(() => {
                        passwordInput.parentElement.classList.remove('shake');
                    }, 500);
                }

                return;
            }

            // Salvar credenciais se "Lembrar de mim" estiver marcado
            if (rememberMe) {
                localStorage.setItem('rememberedEmail', email);
                localStorage.setItem('rememberMe', 'true');
            } else {
                localStorage.removeItem('rememberedEmail');
                localStorage.removeItem('rememberMe');
            }

            // Simular processo de login
            showLoadingState();

            // Simular requisição ao servidor
            setTimeout(() => {
                // Simular login bem-sucedido
                showSuccessState();

                // Simular redirecionamento
                simulateRedirect();
            }, 1500);
        }

        // Mostrar estado de carregamento
        function showLoadingState() {
            loginButton.disabled = true;
            loginText.textContent = 'Entrando...';
            loginButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        }

        // Mostrar estado de sucesso
        function showSuccessState() {
            loginForm.classList.add('hidden');
            successMessage.classList.remove('hidden');
            successMessage.classList.add('fade-in');
        }

        // Simular redirecionamento
        function simulateRedirect() {
            let width = 0;
            const interval = setInterval(() => {
                if (width >= 100) {
                    clearInterval(interval);
                    // Aqui normalmente redirecionaria para a página principal
                    // window.location.href = 'index.html';
                    console.log('Redirecionando para a página principal...');

                    // Por enquanto, apenas mostra mensagem
                    setTimeout(() => {
                        document.querySelector('#success-message p').textContent =
                            'Redirecionamento simulado! Na prática, você seria redirecionado para a Biblioteca Digital.';
                    }, 500);
                } else {
                    width += 2;
                    progressBar.style.width = width + '%';
                }
            }, 30);
        }

        // Mostrar modal de recuperação de senha
        function showForgotPasswordModal() {
            forgotPasswordModal.classList.remove('hidden');
            forgotPasswordModal.classList.add('fade-in');
        }

        // Ocultar modal de recuperação de senha
        function hideForgotPasswordModal() {
            forgotPasswordModal.classList.add('hidden');
            forgotPasswordModal.classList.remove('fade-in');
        }

        // Manipular recuperação de senha
        function handleForgotPassword() {
            const emailInput = forgotPasswordForm.querySelector('input[type="email"]');
            const email = emailInput.value;

            if (!email) {
                emailInput.classList.add('shake');
                setTimeout(() => {
                    emailInput.classList.remove('shake');
                }, 500);
                return;
            }

            // Simular envio de email
            const submitBtn = forgotPasswordForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enviando...';

            setTimeout(() => {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Link Enviado!';
                submitBtn.classList.add('bg-green-600');

                // Reset após 2 segundos
                setTimeout(() => {
                    submitBtn.textContent = originalText;
                    submitBtn.classList.remove('bg-green-600');
                    hideForgotPasswordModal();

                    // Mostrar mensagem de sucesso
                    alert('Link de recuperação enviado para ' + email);
                }, 2000);
            }, 1500);
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

        // Manipular login social
        function handleSocialLogin(provider) {
            const button = document.querySelector(`button:has(.fa-${provider})`);
            const originalText = button.querySelector('span').textContent;
            const icon = button.querySelector('i');

            // Efeito visual
            button.disabled = true;
            button.querySelector('span').textContent = 'Conectando...';
            icon.classList.add('fa-spinner', 'fa-spin');
            icon.classList.remove(`fa-${provider}`);

            // Simular conexão
            setTimeout(() => {
                button.disabled = false;
                button.querySelector('span').textContent = originalText;
                icon.classList.remove('fa-spinner', 'fa-spin');
                icon.classList.add(`fa-${provider}`);

                // Mostrar mensagem
                alert(`Login com ${provider} simulado! Na prática, você seria redirecionado para autenticação.`);
            }, 1500);
        }

        // Mostrar mensagem de registro
        function showRegistrationMessage() {
            // Criar elemento de mensagem
            const message = document.createElement('div');
            message.className =
                'fixed top-4 right-4 bg-blue-600 text-white px-6 py-4 rounded-lg shadow-lg z-50 transform translate-x-full opacity-0';
            message.innerHTML = `
        <div class="flex items-center gap-3">
          <i class="fas fa-info-circle text-xl"></i>
          <div>
            <p class="font-medium">Página de cadastro em desenvolvimento!</p>
            <p class="text-sm opacity-90">Por enquanto, use o formulário de login com credenciais de teste.</p>
          </div>
          <button class="ml-4 text-white/80 hover:text-white">
            <i class="fas fa-times"></i>
          </button>
        </div>
      `;

            document.body.appendChild(message);

            // Animar entrada
            setTimeout(() => {
                message.classList.remove('translate-x-full', 'opacity-0');
                message.classList.add('translate-x-0', 'opacity-100');
            }, 10);

            // Botão de fechar
            const closeBtn = message.querySelector('button');
            closeBtn.addEventListener('click', () => {
                message.classList.remove('translate-x-0', 'opacity-100');
                message.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => {
                    message.remove();
                }, 300);
            });

            // Auto-fechar após 5 segundos
            setTimeout(() => {
                if (message.parentNode) {
                    message.classList.remove('translate-x-0', 'opacity-100');
                    message.classList.add('translate-x-full', 'opacity-0');
                    setTimeout(() => {
                        if (message.parentNode) message.remove();
                    }, 300);
                }
            }, 5000);
        }

        // Sugestão de credenciais de teste (apenas para demonstração)
        window.addEventListener('load', function() {
            // Adicionar dica visual após alguns segundos
            setTimeout(() => {
                if (!emailInput.value) {
                    const hint = document.createElement('div');
                    hint.className =
                        'mt-2 p-3 bg-blue-50 border border-blue-200 rounded-lg text-sm text-blue-800';
                    hint.innerHTML = `
            <div class="flex items-start gap-2">
              <i class="fas fa-lightbulb mt-0.5"></i>
              <div>
                <p class="font-medium">Dica para teste:</p>
                <p>Use "usuario@exemplo.com" e qualquer senha com 6+ caracteres</p>
              </div>
            </div>
          `;

                    emailInput.parentElement.parentElement.appendChild(hint);

                    // Auto-remover após 10 segundos
                    setTimeout(() => {
                        if (hint.parentNode) {
                            hint.classList.add('opacity-0', 'h-0', 'overflow-hidden');
                            setTimeout(() => {
                                if (hint.parentNode) hint.remove();
                            }, 300);
                        }
                    }, 10000);
                }
            }, 3000);
        });
    </script>
</body>

</html>
