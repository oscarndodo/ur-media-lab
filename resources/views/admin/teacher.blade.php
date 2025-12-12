@extends('admin.index')

@section('main')
    @push('styles')
        <style>
            .video-card {
                transition: all 0.3s ease;
            }

            .video-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            }

            .badge {
                display: inline-flex;
                align-items: center;
                padding: 0.25rem 0.75rem;
                border-radius: 9999px;
                font-size: 0.75rem;
                font-weight: 500;
            }

            /* Modal Styles */
            .modal-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 1000;
                align-items: center;
                justify-content: center;
            }

            .modal-overlay.active {
                display: flex;
            }

            .modal-content {
                background: white;
                border-radius: 12px;
                width: 90%;
                max-width: 500px;
                max-height: 90vh;
                overflow-y: auto;
                animation: modalSlideIn 0.3s ease;
            }

            @keyframes modalSlideIn {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .file-upload-area {
                border: 2px dashed #d1d5db;
                border-radius: 8px;
                padding: 2rem;
                text-align: center;
                transition: all 0.3s ease;
                cursor: pointer;
            }

            .file-upload-area:hover {
                border-color: #3b82f6;
                background-color: #f8fafc;
            }

            .file-upload-area.dragover {
                border-color: #3b82f6;
                background-color: #eff6ff;
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
    @endpush

    <!-- Main Layout Structure -->
    <div class="flex w-full bg-gray-50">
        <!-- Main Content -->
        <main class="flex-1">
            <!-- Top Navigation -->
            <header class="bg-white px-10 border-b border-gray-200 py-4">
                <div class="flex items-center justify-between">
                    <!-- Left Section -->
                    <div class="flex items-center gap-4">
                        <button onclick="toggleSidebar()" class="md:hidden text-gray-500 hover:text-gray-700">
                            <i class="fas fa-bars text-xl"></i>
                        </button>

                        <!-- Breadcrumb -->
                        <nav class="flex items-center space-x-2 text-sm">
                            <a href="/admin/teachers" class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-users"></i>
                                <span class="ml-1">Professores</span>
                            </a>
                            <i class="fas fa-chevron-right text-gray-300"></i>
                            <span class="font-medium text-gray-900">{{ $teacher->name }}</span>
                            <i class="fas fa-chevron-right text-gray-300"></i>
                        </nav>
                    </div>

                    <!-- Right Section -->
                    <div class="flex items-center gap-4">
                        <button onclick="openUploadModal()"
                            class="px-4 py-2 bg-blue-600 font-semibold text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center gap-2">
                            <i class="fas fa-cloud-arrow-up"></i>
                            <span class="hidden md:inline">Fazer Upload</span>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="p-6">
                <!-- Video Filters -->
                <div class="bg-white rounded-xl border p-4 mb-6">
                    <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                        <div class="flex gap-4">
                            <button class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg font-medium">
                                Todos ({{ $teacher->videos->count() }})
                            </button>
                            <button class="px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg font-medium">
                                Publicados ({{ $public }})
                            </button>
                            <button class="px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg font-medium">
                                Pendentes ({{ $private }})
                            </button>

                        </div>
                        <div class="flex gap-3">

                            <div class="relative">
                                <i
                                    class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input type="text" placeholder="Buscar vídeos..."
                                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none w-64">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- 
                @foreach ($errors->all() as $item)
                    <span class="bg-red-500">{{ $item }}</span>
                @endforeach --}}

                <!-- Videos Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                    @forelse ($videos as $item)
                        <div class="video-card bg-white rounded-xl border overflow-hidden">
                            <div class="relative">
                                <div class="h-48 bg-gradient-to-r from-gray-800 to-gray-900 relative">
                                    <div class="w-full h-full flex items-center justify-center">
                                        <video width="100%" controls class="h-full object-cover">
                                            <source src="{{ asset($item->url) }}" type="video/mp4">
                                            Seu navegador não suporta vídeo.
                                        </video>
                                    </div>
                                    <div class="absolute top-3 right-3">
                                        @if ($item->status == 'public')
                                            <span class="badge bg-green-100 text-green-800">
                                                Publicado
                                            </span>
                                        @else
                                            <span class="badge bg-orange-100 text-orange-800">
                                                Pendente
                                            </span>
                                        @endif
                                    </div>
                                    <div
                                        class="absolute bottom-3 left-3 bg-black bg-opacity-70 text-white px-2 py-1 rounded text-xs">
                                        25:42
                                    </div>
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-900 text-lg mb-2">{{ $item->title }}</h3>
                                <p class="text-gray-600 text-sm mb-4 truncate-3-lines">
                                    {{ $item->description }}
                                </p>
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center gap-4">
                                        <div class="flex items-center gap-1 text-sm text-gray-500">
                                            <i class="fas fa-eye"></i>
                                            <span>{{ $item->views }}</span>
                                        </div>
                                        <div class="flex items-center gap-1 text-sm text-gray-500">
                                            <i class="fas fa-heart"></i>
                                            <span>{{ rand(50, 300) }}</span>
                                        </div>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $item->created_at->format('d/m/Y') }}
                                    </div>
                                </div>

                                <div class="flex gap-2">
                                    <button
                                        class="flex-1 px-3 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors duration-200">
                                        <i class="fas fa-edit mr-2"></i>
                                        Editar
                                    </button>
                                    <button
                                        class="px-3 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                        <i class="fas fa-close"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        {{-- Estado vazio --}}
                        <div class="col-span-full">
                            <div class="empty-state text-center py-16 px-4 max-w-xl mx-auto">
                                <div class="empty-state-icon mb-6">
                                    <i class="fas fa-film text-gray-300 text-7xl"></i>
                                </div>

                                <h3 class="text-2xl font-bold text-gray-700 mb-3">Nenhum vídeo encontrado</h3>

                                <p class="text-gray-500 text-lg mb-8">
                                    Ainda não possui vídeos cadastrados. Comece adicionando o primeiro conteúdo!
                                </p>



                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if (($videos ?? []) && count($videos) > 0)
                    <div class="mt-8 w-full flex justify-center">
                        <div class="sm:w-2/4 container flex flex-col sm:flex-row items-center justify-between gap-4">
                            <!-- Info de resultados -->
                            <div class="text-sm text-gray-600">
                                Mostrando
                                <span class="font-medium">{{ $videos->firstItem() ?? 1 }}</span>
                                a
                                <span class="font-medium">{{ $videos->lastItem() ?? count($videos) }}</span>
                                de
                                <span class="font-medium">{{ $videos->total() ?? count($videos) }}</span>
                                resultados
                            </div>

                            <!-- Navegação -->
                            <nav class="flex items-center gap-1">
                                @php
                                    $currentPage = $videos->currentPage() ?? 1;
                                    $totalPages = $videos->lastPage() ?? 1;
                                    $startPage = max(1, $currentPage - 2);
                                    $endPage = min($totalPages, $currentPage + 2);
                                @endphp

                                <!-- Botão Anterior -->
                                @if ($currentPage > 1)
                                    <a href="{{ $videos->url($currentPage - 1) }}"
                                        class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                        <i class="fas fa-chevron-left text-sm"></i>
                                        <span class="hidden sm:inline">Anterior</span>
                                    </a>
                                @else
                                    <span
                                        class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg text-gray-300 cursor-not-allowed">
                                        <i class="fas fa-chevron-left text-sm"></i>
                                        <span class="hidden sm:inline">Anterior</span>
                                    </span>
                                @endif

                                <!-- Páginas -->
                                <div class="flex items-center gap-1 mx-2">
                                    <!-- Primeira página -->
                                    @if ($startPage > 1)
                                        <a href="{{ $videos->url(1) }}"
                                            class="px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                            1
                                        </a>
                                        @if ($startPage > 2)
                                            <span class="px-2 text-gray-400">...</span>
                                        @endif
                                    @endif

                                    <!-- Páginas ao redor da atual -->
                                    @for ($page = $startPage; $page <= $endPage; $page++)
                                        @if ($page == $currentPage)
                                            <span
                                                class="px-3 py-2 min-w-[2.5rem] border border-blue-600 rounded-lg font-medium bg-blue-600 text-white">
                                                {{ $page }}
                                            </span>
                                        @else
                                            <a href="{{ $videos->url($page) }}"
                                                class="px-3 py-2 min-w-[2.5rem] border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                                {{ $page }}
                                            </a>
                                        @endif
                                    @endfor

                                    <!-- Última página -->
                                    @if ($endPage < $totalPages)
                                        @if ($endPage < $totalPages - 1)
                                            <span class="px-2 text-gray-400">...</span>
                                        @endif
                                        <a href="{{ $videos->url($totalPages) }}"
                                            class="px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                            {{ $totalPages }}
                                        </a>
                                    @endif
                                </div>

                                <!-- Botão Próximo -->
                                @if ($currentPage < $totalPages)
                                    <a href="{{ $videos->url($currentPage + 1) }}"
                                        class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                        <span class="hidden sm:inline">Próximo</span>
                                        <i class="fas fa-chevron-right text-sm"></i>
                                    </a>
                                @else
                                    <span
                                        class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg text-gray-300 cursor-not-allowed">
                                        <span class="hidden sm:inline">Próximo</span>
                                        <i class="fas fa-chevron-right text-sm"></i>
                                    </span>
                                @endif
                            </nav>

                            <!-- Select de itens por página com formulário -->
                            <div class="flex items-center gap-2">
                                <span class="text-sm text-gray-600">Itens por página:</span>
                                <form method="GET" action="{{ url()->current() }}" class="inline">
                                    @foreach (request()->except('per_page', 'page') as $key => $value)
                                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                    @endforeach
                                    <select name="per_page" onchange="this.form.submit()"
                                        class="px-3 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                        <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10
                                        </option>
                                        <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25
                                        </option>
                                        <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50
                                        </option>
                                        <option value="100" {{ request('per_page', 10) == 100 ? 'selected' : '' }}>100
                                        </option>
                                    </select>
                                </form>
                            </div>
                        </div>

                        <!-- Paginação Mobile Simplificada -->
                        <div class="mt-4 sm:hidden flex items-center justify-between">
                            <!-- Anterior Mobile -->
                            @if ($currentPage > 1)
                                <a href="{{ $videos->url($currentPage - 1) }}"
                                    class="flex items-center gap-1 px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200 text-sm">
                                    <i class="fas fa-chevron-left text-xs"></i>
                                    Anterior
                                </a>
                            @else
                                <span
                                    class="flex items-center gap-1 px-3 py-2 border border-gray-300 rounded-lg text-gray-300 cursor-not-allowed text-sm">
                                    <i class="fas fa-chevron-left text-xs"></i>
                                    Anterior
                                </span>
                            @endif

                            <span class="text-sm text-gray-600">
                                Página <span class="font-medium">{{ $currentPage }}</span> de <span
                                    class="font-medium">{{ $totalPages }}</span>
                            </span>

                            <!-- Próximo Mobile -->
                            @if ($currentPage < $totalPages)
                                <a href="{{ $videos->url($currentPage + 1) }}"
                                    class="flex items-center gap-1 px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200 text-sm">
                                    Próximo
                                    <i class="fas fa-chevron-right text-xs"></i>
                                </a>
                            @else
                                <span
                                    class="flex items-center gap-1 px-3 py-2 border border-gray-300 rounded-lg text-gray-300 cursor-not-allowed text-sm">
                                    Próximo
                                    <i class="fas fa-chevron-right text-xs"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </main>
    </div>

    <!-- Upload Video Modal -->
    <div id="uploadModal" class="modal-overlay backdrop-blur">
        <div class="modal-content">
            <div class="p-6">
                <!-- Modal Header -->
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">Upload de vídeo</h2>
                    <button onclick="closeUploadModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <!-- Upload Form -->
                <form id="uploadForm" onsubmit="handleUpload(event)"
                    action="{{ route('admin.teacher.upload', $teacher->id) }}" method="POST"
                    enctype="multipart/form-data">
                    <!-- File Upload Area -->
                    @csrf
                    <div class="mb-6">
                        <div id="dropArea" class="file-upload-area"
                            onclick="document.getElementById('videoFile').click()">
                            <div class="mb-4">
                                <i class="fas fa-cloud-upload-alt text-4xl text-blue-500 mb-2"></i>
                                <p class="text-gray-700 font-medium">Arraste e solte seu vídeo aqui</p>
                                <p class="text-gray-500 text-sm mt-1">ou clique para selecionar</p>
                            </div>
                            <input type="file" id="videoFile" name="video" required accept="video/*"
                                class="hidden" onchange="handleFileSelect(event)">
                            <p class="text-gray-400 text-xs">Formatos suportados: mp4,webm,mkv,avi,mpeg,mpg (Max: 500MB)
                            </p>
                        </div>

                        <div id="fileInfo" class="mt-3 hidden">
                            <div class="flex items-center justify-between bg-blue-50 p-3 rounded-lg">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-video text-blue-600"></i>
                                    <div>
                                        <p id="fileName" class="font-medium text-gray-900"></p>
                                        <p id="fileSize" class="text-sm text-gray-500"></p>
                                    </div>
                                </div>
                                <button type="button" onclick="removeFile()" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>

                            {{-- Exibição da duração do vídeo --}}
                            <div id="durationInfo" class="mt-2 hidden text-sm text-gray-600">
                                Duração: <span id="durationValue"></span>
                            </div>
                        </div>

                        {{-- Campo oculto para enviar a duração em segundos --}}
                        <input type="hidden" id="videoDuration" name="duration">
                    </div>


                    <!-- Video Details -->
                    <div class="space-y-4 mb-6">
                        <div>
                            <label for="videoTitle" class="block text-sm font-medium text-gray-700 mb-1">
                                Título do Vídeo *
                            </label>
                            <input type="text" id="videoTitle" name="title" required
                                placeholder="Digite o título do vídeo"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>

                        <div>
                            <label for="videoDescription" class="block text-sm font-medium text-gray-700 mb-1">
                                Descrição *
                            </label>
                            <textarea id="videoDescription" required name="description" rows="3"
                                placeholder="Descreva o conteúdo do vídeo..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></textarea>
                        </div>

                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="videoCategory" class="block text-sm font-medium text-gray-700 mb-1">
                                    Disciplina *
                                </label>
                                <select id="videoCategory" name="category" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                                    <option value="">Selecione uma opção</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>

                    <!-- Progress Bar (Hidden by default) -->
                    <div id="uploadProgress" class="hidden mb-6">
                        <div class="flex justify-between text-sm text-gray-600 mb-2">
                            <span>Upload em progresso...</span>
                            <span id="progressPercent">0%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div id="progressBar" class="bg-blue-600 h-2 rounded-full" style="width: 0%"></div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeUploadModal()"
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                            Cancelar
                        </button>
                        <button type="submit" id="uploadButton"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center gap-2">
                            <i class="fas fa-upload"></i>
                            <span>Upload Vídeo</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Modal Functions
            function openUploadModal() {
                document.getElementById('uploadModal').classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeUploadModal() {
                document.getElementById('uploadModal').classList.remove('active');
                document.body.style.overflow = 'auto';
                resetForm();
            }

            // Fecha modal ao clicar fora do conteúdo
            document.getElementById('uploadModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeUploadModal();
                }
            });

            // File Upload Handling
            const dropArea = document.getElementById('dropArea');
            const fileInput = document.getElementById('videoFile');
            const fileInfo = document.getElementById('fileInfo');
            const fileName = document.getElementById('fileName');
            const fileSize = document.getElementById('fileSize');
            const durationInfo = document.getElementById('durationInfo');
            const durationValue = document.getElementById('durationValue');
            const durationInput = document.getElementById('videoDuration');
            let selectedFile = null;

            // Drag and drop events
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropArea.addEventListener(eventName, () => dropArea.classList.add('dragover'), false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, () => dropArea.classList.remove('dragover'), false);
            });

            dropArea.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                handleFiles(files);
            }

            function handleFileSelect(e) {
                const files = e.target.files;
                handleFiles(files);
            }

            function handleFiles(files) {
                if (files.length === 0) return;

                selectedFile = files[0];

                // Validação básica
                const validTypes = ['video/mp4', 'video/avi', 'video/mov', 'video/mkv', 'video/webm', 'video/mpeg',
                    'video/mpg'
                ];
                const maxSize = 500 * 1024 * 1024; // 500 MB

                if (!validTypes.includes(selectedFile.type)) {
                    alert('Tipo de arquivo não suportado. Por favor, selecione um arquivo de vídeo.');
                    removeFile();
                    return;
                }

                if (selectedFile.size > maxSize) {
                    alert('Arquivo muito grande. O tamanho máximo é 500 MB.');
                    removeFile();
                    return;
                }

                // Mostrar informações básicas
                fileName.textContent = selectedFile.name;
                fileSize.textContent = formatFileSize(selectedFile.size);
                fileInfo.classList.remove('hidden');

                // Obter duração do vídeo via metadata
                extractVideoDuration(selectedFile);
            }

            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }

            function formatDuration(seconds) {
                seconds = Math.floor(seconds);
                const h = Math.floor(seconds / 3600);
                const m = Math.floor((seconds % 3600) / 60);
                const s = seconds % 60;

                const pad = (n) => n.toString().padStart(2, '0');

                if (h > 0) {
                    return `${pad(h)}:${pad(m)}:${pad(s)}`;
                }
                return `${pad(m)}:${pad(s)}`;
            }

            // Lê a duração do vídeo em segundos e preenche o campo hidden
            function extractVideoDuration(file) {
                const tempVideo = document.createElement('video');
                tempVideo.preload = 'metadata';

                tempVideo.onloadedmetadata = function() {
                    // libertar o objectURL
                    window.URL.revokeObjectURL(tempVideo.src);

                    const durationSeconds = tempVideo.duration || 0;

                    // Guarda em segundos para o back-end
                    durationInput.value = Math.round(durationSeconds);

                    // Mostra formatado para o utilizador
                    durationValue.textContent = formatDuration(durationSeconds);
                    durationInfo.classList.remove('hidden');
                };

                tempVideo.onerror = function() {
                    console.warn('Não foi possível obter a duração do vídeo.');
                    durationInput.value = '';
                    durationInfo.classList.add('hidden');
                };

                tempVideo.src = URL.createObjectURL(file);
            }

            function removeFile() {
                selectedFile = null;
                fileInput.value = '';
                fileInfo.classList.add('hidden');
                durationInfo.classList.add('hidden');
                durationInput.value = '';
            }

            // Submissão do formulário (sem progress bar fictício)
            function handleUpload(e) {
                e.preventDefault();

                if (!selectedFile) {
                    alert('Por favor, selecione um arquivo de vídeo.');
                    return;
                }

                // Garante que a duração foi calculada antes de enviar
                if (!durationInput.value) {
                    alert('Aguarde um instante enquanto calculamos a duração do vídeo e tente novamente.');
                    return;
                }

                document.getElementById('uploadForm').submit();
            }

            function resetForm() {
                document.getElementById('uploadForm').reset();
                removeFile();
            }
        </script>
    @endpush

@endsection
