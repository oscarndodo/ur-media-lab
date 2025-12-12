<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Painel do Docente - Biblioteca Digital</title>
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

        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-published {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-weight: 500;
        }

        .modal {
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .tab-active {
            border-bottom: 3px solid #3b82f6;
            color: #3b82f6;
            font-weight: 600;
        }

        .truncate-3-lines {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.5em;
            /* altura da linha */
            max-height: 4.5em;
            /* 3 linhas × 1.5em */
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-play text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">Painel do Docente</h1>
                        <p class="text-sm text-gray-600">Biblioteca Digital</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <div class="relative">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                            <span class="font-semibold text-blue-600">{{ auth()->user()->name[0] }}</span>
                        </div>
                        <span
                            class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">{{ count($pending) }}</span>
                    </div>
                    <div class="hidden sm:block">
                        <p class="font-medium text-gray-800">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500">
                            {{ $user->bio->formation }}
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-6">
        <!-- Welcome Card -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-6 text-white mb-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <div>
                    <h2 class="text-xl font-bold mb-2">Olá, {{ auth()->user()->name }}!</h2>
                    <p class="text-blue-100">Você tem <span class="font-bold">{{ count($pending) }} vídeos</span>
                        aguardando confirmação.
                    </p>
                </div>
                <div class="mt-4 md:mt-0 flex items-center gap-4">
                    <div class="text-center">
                        <div class="text-2xl font-bold">{{ count($published) }}</div>
                        <div class="text-sm text-blue-200">Vídeos Publicados</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold">{{ $views }}</div>
                        <div class="text-sm text-blue-200">Visualizações</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs Navigation -->
        <div class="flex border-b mb-6">
            <button class="tab-btn px-6 py-3 text-gray-600 hover:text-gray-800 tab-active" data-tab="pendentes">
                Pendentes <span class="badge status-pending ml-2">{{ count($pending) }}</span>
            </button>
            <button class="tab-btn px-6 py-3 text-gray-600 hover:text-gray-800" data-tab="publicados">
                Publicados
            </button>
            <button class="tab-btn px-6 py-3 text-gray-600 hover:text-gray-800" data-tab="comentarios">
                Comentários <span class="badge bg-red-100 text-red-800 ml-2">5</span>
            </button>
            <button class="tab-btn px-6 py-3 text-gray-600 hover:text-gray-800" data-tab="estatisticas">
                Estatísticas
            </button>
        </div>

        <!-- Tab Content -->
        <div id="tab-content">
            <!-- Pendentes Tab -->
            <div id="tab-pendentes" class="tab-panel">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Vídeos Aguardando Confirmação</h3>
                    <p class="text-gray-600 mb-4">Confirme a publicação dos vídeos enviados pela administração.</p>

                    <!-- Vídeos Pendentes List -->
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">

                        @forelse ($pending as $item)
                            <!-- Aqui vai o layout dos itens quando existirem -->

                            <div class="bg-white rounded-xl border overflow-hidden card-hover">
                                <div class="relative h-48 bg-gray-200">
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <i class="fas fa-video text-gray-400 text-3xl"></i>
                                    </div>
                                    <div class="absolute top-3 right-3">
                                        <span class="badge status-pending">Aguardando</span>
                                    </div>
                                </div>

                                <div class="p-5">
                                    <h4 class="font-semibold text-gray-800 mb-2">{{ $item->title }}</h4>
                                    <p class="text-sm text-gray-600 mb-4 truncate-3-lines">
                                        {!! $item->description !!}
                                    </p>

                                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                        <span>
                                            <i class="far fa-clock mr-1"></i>
                                            {{ \Carbon\CarbonInterval::seconds((int) $item->duration)->cascade()->format('%H:%I:%S') }}
                                            sec
                                        </span>
                                        <span>Enviado: {{ $item->created_at->diffForHumans() }}</span>
                                    </div>

                                    <div class="flex gap-2">
                                        <a href="{{ route('home.publish', $item->id) }}"
                                            class="flex items-center justify-center w-full py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                            Publicar
                                        </a>

                                        <a href="{{ route('video', $item->id) }}" target="_blank"
                                            class="flex items-center justify-center px-5 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                                            <i class="far fa-eye mr-1"></i> Ver
                                        </a>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <!-- LAYOUT QUANDO NÃO EXISTEM ITENS -->
                            <div
                                class="flex flex-col items-center w-full justify-center p-10 px-0 bg-gray-50 rounded-xl">
                                <i class="fas fa-video-slash text-gray-400 text-5xl mb-3"></i>
                                <h3 class="text-gray-700 font-semibold text-lg w-full text-center">Nenhum vídeo
                                    disponível</h3>
                                <p class="text-gray-500 text-sm w-full text-center">Os vídeos que você enviar aparecerão
                                    aqui.</p>
                            </div>
                        @endforelse




                    </div>
                </div>
            </div>

            <!-- Publicados Tab -->
            <div id="tab-publicados" class="tab-panel hidden">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Vídeos Publicados</h3>

                    <!-- Filtro Simples -->
                    {{-- <div class="mb-4">
                        <select class="px-4 py-2 border rounded-lg">
                            <option>Todos os vídeos</option>
                            <option>Última semana</option>
                            <option>Último mês</option>
                            <option>Mais populares</option>
                        </select>
                    </div> --}}

                    <!-- Vídeos Publicados List -->
                    <div class="bg-white rounded-xl border overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Vídeo</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Visualizações</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Likes</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Publicado em</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse ($published as $item)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center">
                                                    <div
                                                        class="w-12 h-9 bg-gray-200 relative flex items-center justify-center rounded mr-3">
                                                        <i class="fas fa-video"></i>
                                                    </div>
                                                    <div>
                                                        <div class="font-medium text-gray-800">{{ $item->title }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            {{ \Carbon\CarbonInterval::seconds((int) $item->duration)->cascade()->format('%H:%I:%S') }}
                                                            sec • {{ $item->category }}</div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="px-6 py-4">
                                                <div class="text-gray-800 font-medium">{{ $item->views }}</div>
                                            </td>

                                            <td class="px-6 py-4">
                                                <div class="text-gray-800 font-medium">N/A</div>
                                            </td>

                                            <td class="px-6 py-4 text-sm text-gray-500">
                                                {{ $item->created_at->format('d/m/Y') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-10 text-center">
                                                <div class="flex flex-col items-center justify-center text-gray-500">
                                                    <i class="fas fa-folder-open text-4xl mb-3"></i>
                                                    <p class="font-medium text-gray-700">Nenhum vídeo publicado</p>
                                                    <p class="text-sm">Quando você publicar vídeos, eles aparecerão
                                                        aqui.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comentários Tab -->
            <div id="tab-comentarios" class="tab-panel hidden">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Comentários Recentes</h3>
                    <p class="text-gray-600 mb-4">Responda aos comentários dos seus alunos.</p>

                    <!-- Comentários List -->
                    <div class="space-y-4">
                        <!-- Comentário 1 -->
                        <div class="bg-white rounded-xl border p-5">
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-user text-gray-600"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <h4 class="font-medium text-gray-800">Ana Santos</h4>
                                            <p class="text-sm text-gray-500">no vídeo "Introdução ao HTML"</p>
                                        </div>
                                        <span class="text-xs text-gray-400">Há 2 dias</span>
                                    </div>
                                    <p class="text-gray-700 mb-4">
                                        Excelente explicação! Consegui entender conceitos que antes pareciam
                                        complicados. Obrigada!
                                    </p>
                                    <div class="flex gap-2">
                                        <button
                                            class="reply-btn px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
                                            <i class="fas fa-reply mr-1"></i> Responder
                                        </button>
                                        <button
                                            class="px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 text-sm">
                                            <i class="far fa-thumbs-up"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <!-- Estatísticas Tab -->
            <div id="tab-estatisticas" class="tab-panel hidden">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Estatísticas dos seus vídeos</h3>

                    <!-- Cards de Estatísticas -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-white rounded-xl p-6 border">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-gray-800 mb-2">{{ $views }}</div>
                                <div class="text-gray-600">Total Visualizações </div>
                                <div class="text-sm text-green-600 mt-2">
                                    <i class="fas fa-arrow-up mr-1"></i> 15% este mês
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl p-6 border">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-gray-800 mb-2">{{ $user->videos()->count() }}
                                </div>
                                <div class="text-gray-600">Total Videos</div>
                                <div class="text-sm text-green-600 mt-2">
                                    <i class="fas fa-arrow-up mr-1"></i> 8% este mês
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl p-6 border">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-gray-800 mb-2">4.8</div>
                                <div class="text-gray-600">Avaliação Média</div>
                                <div class="text-sm text-gray-600 mt-2">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <i class="fas fa-star-half-alt text-yellow-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Gráfico Simples -->
                    <div class="bg-white rounded-xl p-6 border">
                        <h4 class="font-semibold text-gray-800 mb-4">Visualizações nos últimos 7 dias</h4>
                        <div class="flex items-end h-40 gap-2">
                            <div class="flex-1 flex flex-col items-center">
                                <div class="w-full bg-blue-200 rounded-t-lg" style="height: 60%"></div>
                                <span class="text-xs text-gray-500 mt-2">Seg</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center">
                                <div class="w-full bg-blue-300 rounded-t-lg" style="height: 70%"></div>
                                <span class="text-xs text-gray-500 mt-2">Ter</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center">
                                <div class="w-full bg-blue-400 rounded-t-lg" style="height: 85%"></div>
                                <span class="text-xs text-gray-500 mt-2">Qua</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center">
                                <div class="w-full bg-blue-500 rounded-t-lg" style="height: 95%"></div>
                                <span class="text-xs text-gray-500 mt-2">Qui</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center">
                                <div class="w-full bg-blue-600 rounded-t-lg" style="height: 100%"></div>
                                <span class="text-xs text-gray-500 mt-2">Sex</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center">
                                <div class="w-full bg-blue-500 rounded-t-lg" style="height: 80%"></div>
                                <span class="text-xs text-gray-500 mt-2">Sáb</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center">
                                <div class="w-full bg-blue-400 rounded-t-lg" style="height: 65%"></div>
                                <span class="text-xs text-gray-500 mt-2">Dom</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>



    <!-- Modal de Resposta -->
    <div id="reply-modal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 hidden z-50">
        <div class="bg-white rounded-xl max-w-md w-full p-6 modal">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-800">Responder Comentário</h3>
                <button id="close-reply-modal" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="mb-6">
                <div class="bg-gray-50 p-4 rounded-lg mb-4">
                    <p class="text-gray-700" id="modal-comment-text">Comentário original do aluno...</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sua resposta</label>
                    <textarea id="reply-text" class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:border-blue-500"
                        rows="4" placeholder="Digite sua resposta aqui..."></textarea>
                </div>
            </div>

            <div class="flex gap-3">
                <button id="cancel-reply"
                    class="flex-1 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                    Cancelar
                </button>
                <button id="send-reply" class="flex-1 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Enviar Resposta
                </button>
            </div>
        </div>
    </div>


    @error('error')
        <div role="alert"
            class="fixed top-5 sm:right-28 right-5 alert rounded-md border border-red-500 bg-red-50 p-4 shadow-sm">
            <div class="flex items-start gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="-mt-0.5 size-6 text-red-700">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"></path>
                </svg>

                <div class="flex-1">
                    <strong class="block leading-tight font-medium text-red-800"> ERRO </strong>

                    <p class="mt-0.5 text-sm text-red-700">
                        {{ $message }}
                    </p>
                </div>
            </div>
        </div>
    @enderror

    @error('success')
        <div role="alert"
            class="fixed top-5 sm:right-28 right-5 rounded-md border border-green-500 bg-green-50 p-4 shadow-sm">
            <div class="flex items-start gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="-mt-0.5 size-6 text-green-700">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>

                <div class="flex-1">
                    <strong class="block leading-tight font-medium text-green-800"> SUCESSO </strong>

                    <p class="mt-0.5 text-sm text-green-700">
                        {{ $message }}
                    </p>
                </div>
            </div>
        </div>
    @enderror

    <script>
        // Elementos DOM
        const tabBtns = document.querySelectorAll('.tab-btn');
        const tabPanels = document.querySelectorAll('.tab-panel');
        const replyModal = document.getElementById('reply-modal');
        const closeReplyModalBtn = document.getElementById('close-reply-modal');
        const cancelReplyBtn = document.getElementById('cancel-reply');
        const sendReplyBtn = document.getElementById('send-reply');
        const modalVideoTitle = document.getElementById('modal-video-title');
        const modalVideoDesc = document.getElementById('modal-video-desc');
        const modalCommentText = document.getElementById('modal-comment-text');
        const replyText = document.getElementById('reply-text');

        // Estado
        let currentVideoId = null;
        let currentComment = null;



        // Inicialização
        document.addEventListener('DOMContentLoaded', function() {
            setupEventListeners();

            // Simular notificações
            updateNotificationCount();
        });

        // Configurar event listeners
        function setupEventListeners() {
            // Tabs
            tabBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const tabId = this.dataset.tab;
                    switchTab(tabId);
                });
            });



            // Botões de resposta
            document.querySelectorAll('.reply-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const commentCard = this.closest('.bg-white.rounded-xl');
                    const commentText = commentCard.querySelector('.text-gray-700').textContent;
                    const userName = commentCard.querySelector('.font-medium').textContent;
                    showReplyModal(commentText, userName);
                });
            });

            // Modal de resposta
            closeReplyModalBtn.addEventListener('click', () => replyModal.classList.add('hidden'));
            cancelReplyBtn.addEventListener('click', () => replyModal.classList.add('hidden'));
            sendReplyBtn.addEventListener('click', sendReply);

            // Fechar modais ao clicar fora
            [confirmationModal, replyModal].forEach(modal => {
                modal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        this.classList.add('hidden');
                    }
                });
            });
        }

        // Trocar de tab
        function switchTab(tabId) {
            // Atualizar botões ativos
            tabBtns.forEach(btn => {
                btn.classList.remove('tab-active');
                if (btn.dataset.tab === tabId) {
                    btn.classList.add('tab-active');
                }
            });

            // Mostrar conteúdo da tab
            tabPanels.forEach(panel => {
                panel.classList.add('hidden');
                if (panel.id === `tab-${tabId}`) {
                    panel.classList.remove('hidden');
                }
            });

            // Atualizar título da página se necessário
            updatePageTitle(tabId);
        }

        // Atualizar título da página
        function updatePageTitle(tabId) {
            const titles = {
                'pendentes': 'Vídeos Pendentes',
                'publicados': 'Vídeos Publicados',
                'comentarios': 'Comentários',
                'estatisticas': 'Estatísticas'
            };

            if (titles[tabId]) {
                document.title = `${titles[tabId]} - Painel do Docente`;
            }
        }



        // Mostrar modal de resposta
        function showReplyModal(commentText, userName) {
            modalCommentText.textContent = commentText;
            replyModal.classList.remove('hidden');
            replyText.focus();
        }

        // Enviar resposta
        function sendReply() {
            const reply = replyText.value.trim();

            if (!reply) {
                showMessage('Por favor, digite uma resposta.', 'error');
                return;
            }

            // Simular envio
            sendReplyBtn.disabled = true;
            sendReplyBtn.textContent = 'Enviando...';

            setTimeout(() => {
                // Fechar modal e limpar campo
                replyModal.classList.add('hidden');
                replyText.value = '';
                sendReplyBtn.disabled = false;
                sendReplyBtn.textContent = 'Enviar Resposta';

                // Mostrar mensagem de sucesso
                showMessage('Resposta enviada com sucesso!', 'success');

                // Atualizar contador de comentários
                updateCommentCount();
            }, 1000);
        }

        // Atualizar contadores
        function updateCounters() {
            // Atualizar contador de vídeos pendentes
            const pendingCount = document.querySelectorAll('.status-pending').length;
            const pendingBadge = document.querySelector('[data-tab="pendentes"] .badge');

            if (pendingBadge) {
                pendingBadge.textContent = pendingCount;
                if (pendingCount === 0) {
                    pendingBadge.classList.remove('status-pending');
                    pendingBadge.classList.add('bg-gray-100', 'text-gray-800');
                }
            }

            // Atualizar vídeos publicados no welcome card
            const publishedCount = 12 + (3 - pendingCount); // 12 já publicados + novos
            const welcomeCount = document.querySelector('.bg-gradient-to-r .font-bold:nth-child(1)');
            if (welcomeCount) {
                welcomeCount.textContent = publishedCount;
            }
        }

        // Atualizar contador de comentários
        function updateCommentCount() {
            const commentCount = document.querySelector('[data-tab="comentarios"] .badge');
            if (commentCount) {
                let current = parseInt(commentCount.textContent);
                if (current > 0) {
                    commentCount.textContent = current - 1;
                }
            }
        }


        // Mostrar mensagem
        function showMessage(text, type = 'info') {
            // Remover mensagens anteriores
            const existingMsg = document.getElementById('flash-message');
            if (existingMsg) existingMsg.remove();

            // Criar nova mensagem
            const message = document.createElement('div');
            message.id = 'flash-message';
            message.className =
                `fixed top-4 right-4 px-6 py-4 rounded-lg shadow-lg z-50 animate-fade-in ${type === 'success' ? 'bg-green-100 border border-green-200 text-green-800' : 'bg-red-100 border border-red-200 text-red-800'}`;
            message.innerHTML = `
        <div class="flex items-center gap-3">
          <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
          <span>${text}</span>
          <button class="ml-4 opacity-70 hover:opacity-100" onclick="this.parentElement.parentElement.remove()">
            <i class="fas fa-times"></i>
          </button>
        </div>
      `;

            document.body.appendChild(message);

            // Auto-remover após 5 segundos
            setTimeout(() => {
                if (message.parentNode) message.remove();
            }, 5000);

            // Adicionar estilos para animação
            if (!document.querySelector('#flash-animation')) {
                const style = document.createElement('style');
                style.id = 'flash-animation';
                style.textContent = `
          @keyframes fade-in {
            from { opacity: 0; transform: translateX(100%); }
            to { opacity: 1; transform: translateX(0); }
          }
          .animate-fade-in { animation: fade-in 0.3s ease-out; }
        `;
                document.head.appendChild(style);
            }
        }

        // Adicionar funcionalidade de like aos comentários
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('fa-thumbs-up')) {
                const button = e.target.closest('button');
                const icon = button.querySelector('i');

                if (icon.classList.contains('far')) {
                    icon.classList.remove('far');
                    icon.classList.add('fas', 'text-blue-600');

                    // Simular incremento
                    setTimeout(() => {
                        showMessage('Like adicionado!', 'success');
                    }, 300);
                }
            }
        });


        // Atualizar estatísticas periodicamente
        setInterval(updateStats, 10000);



        document.querySelector("form").forEach(el => {
            el.addEventListener("submit", () => {
                const button = el.querySelector("button[type=submit]")
                button.disabled = true;
                button.innerHTML = 'Processando...';
                button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            })
        })
    </script>
</body>

</html>
