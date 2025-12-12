<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Biblioteca Digital</title>

    @vite('resources/css/app.css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Skeleton */
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

        /* Fade-in */
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

        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

        .btn-hover {
            transition: all 0.3s ease;
        }

        .btn-hover:hover {
            transform: translateY(-2px);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-gray-100 p-4">

    <div class="max-w-md w-full">
        <div class="bg-white rounded-2xl shadow-lg border overflow-hidden">

            <!-- Skeleton -->
            <div id="login-skeleton" class="p-8">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 skeleton"></div>
                    <div class="h-6 skeleton w-40"></div>
                </div>

                <div class="space-y-6">
                    <div>
                        <div class="h-4 skeleton w-24 mb-2"></div>
                        <div class="h-12 skeleton"></div>
                    </div>

                    <div>
                        <div class="h-4 skeleton w-24 mb-2"></div>
                        <div class="h-12 skeleton"></div>
                    </div>

                    <div class="h-12 skeleton mt-6"></div>
                </div>
            </div>

            <!-- Formulário -->
            <div id="login-form" class="hidden p-8">

                <div class="flex items-center justify-between mb-8">
                    <a href="{{ route('index') }}" class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-play text-white"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Entrar</h2>
                    </a>

                    <button id="theme-toggle"
                        class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-200">
                        <i class="fas fa-moon text-gray-600"></i>
                    </button>
                </div>

                <p class="text-gray-600 mb-6">
                    Use suas credenciais para aceder à sua conta.
                </p>

                <form id="loginForm" method="POST" action="{{ route('login.auth') }}" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label class="text-sm font-medium text-gray-700 mb-2 block">
                            Email
                        </label>

                        <div class="relative">
                            <input type="email" id="email" name="email" required
                                class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg input-focus focus:outline-none"
                                placeholder="exemplo@email.com">

                            <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        </div>

                        <p id="email-error" class="text-red-500 text-sm mt-2 hidden">
                            Email inválido.
                        </p>
                    </div>

                    <!-- Senha -->
                    <div>
                        <div class="flex justify-between mb-2">
                            <label class="text-sm font-medium text-gray-700">Palavra-passe</label>
                            <a href="#" class="text-sm text-blue-600 hover:underline">
                                Esqueceu a senha?
                            </a>
                        </div>

                        <div class="relative">
                            <input type="password" id="password" name="password" required
                                class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg input-focus focus:outline-none"
                                placeholder="********">

                            <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                            <button type="button" id="toggle-password"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>

                        <p id="password-error" class="text-red-500 text-sm mt-2 hidden">
                            A senha deve ter pelo menos 6 caracteres.
                        </p>
                    </div>

                    <!-- Remember -->
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember"
                            class="w-4 h-4 text-blue-600 border-gray-300 rounded">
                        <label for="remember" class="ml-2 text-sm text-gray-700">
                            Lembrar de mim
                        </label>
                    </div>

                    <!-- Botão -->
                    <button type="submit" id="login-button"
                        class="w-full py-3 bg-blue-600 text-white rounded-lg font-medium btn-hover hover:bg-blue-700 flex justify-center items-center gap-2">
                        <span id="login-text">Entrar</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>

                    <p class="text-center pt-6 border-t text-gray-600 text-sm">
                        Não tem uma conta?
                        <a href="#" class="text-blue-600 font-medium hover:underline">
                            Contacte o suporte
                        </a>
                    </p>
                </form>
            </div>
        </div>

        <p class="mt-6 text-center text-gray-500 text-sm">
            © 2023 Biblioteca Digital. Todos os direitos reservados.
        </p>
    </div>

    <script>
        const skeleton = document.getElementById('login-skeleton');
        const form = document.getElementById('login-form');
        const email = document.getElementById('email');
        const pass = document.getElementById('password');
        const togglePass = document.getElementById('toggle-password');
        const emailError = document.getElementById('email-error');
        const passError = document.getElementById('password-error');
        const themeBtn = document.getElementById('theme-toggle');

        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                skeleton.style.display = 'none';
                form.classList.remove('hidden');
                form.classList.add('fade-in');
            }, 800);

            document.querySelector("form").addEventListener("submit", () => {
                const button = el.querySelector("button[type=submit]")
                button.disabled = true;
                button.innerHTML = 'Processando...';
                button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            })
        });

        email.addEventListener('input', () => {
            const ok = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value);
            emailError.classList.toggle('hidden', ok || email.value === '');
        });

        pass.addEventListener('input', () => {
            passError.classList.toggle('hidden', pass.value.length >= 6 || pass.value === '');
        });

        togglePass.addEventListener('click', () => {
            const visible = pass.type === 'text';
            pass.type = visible ? 'password' : 'text';
            togglePass.innerHTML = visible ?
                '<i class="fas fa-eye"></i>' :
                '<i class="fas fa-eye-slash"></i>';
        });

        themeBtn.addEventListener('click', () => {
            document.body.classList.toggle('bg-gray-900');
            document.body.classList.toggle('bg-gray-100');
        });
    </script>
</body>

</html>
