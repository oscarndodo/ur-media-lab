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
                            <span class="font-medium text-gray-900">Carlos Silva</span>
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
                                Todos (24)
                            </button>
                            <button class="px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg font-medium">
                                Publicados (18)
                            </button>
                            <button class="px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg font-medium">
                                Pendentes (5)
                            </button>
                            <button class="px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg font-medium">
                                Rascunhos (1)
                            </button>
                        </div>
                        <div class="flex gap-3">
                            <select
                                class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                                <option value="">Ordenar por</option>
                                <option value="date">Data</option>
                                <option value="views">Visualizações</option>
                                <option value="title">Título</option>
                            </select>
                            <div class="relative">
                                <i
                                    class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input type="text" placeholder="Buscar vídeos..."
                                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none w-64">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Videos Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                    @for ($i = 1; $i <= 6; $i++)
                        <div class="video-card bg-white rounded-xl border overflow-hidden">
                            <div class="relative">
                                <div class="h-48 bg-gradient-to-r from-gray-800 to-gray-900 relative">
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fas fa-play-circle text-white text-4xl opacity-80"></i>
                                    </div>
                                    <div class="absolute top-3 right-3">
                                        <span class="badge bg-green-100 text-green-800">
                                            Publicado
                                        </span>
                                    </div>
                                    <div
                                        class="absolute bottom-3 left-3 bg-black bg-opacity-70 text-white px-2 py-1 rounded text-xs">
                                        25:42
                                    </div>
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-900 text-lg mb-2">React Hooks Avançados - Parte
                                    {{ $i }}</h3>
                                <p class="text-gray-600 text-sm mb-4">Aprenda hooks avançados como useMemo,
                                    useCallback, useReducer...</p>

                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center gap-4">
                                        <div class="flex items-center gap-1 text-sm text-gray-500">
                                            <i class="fas fa-eye"></i>
                                            <span>{{ rand(500, 5000) }}</span>
                                        </div>
                                        <div class="flex items-center gap-1 text-sm text-gray-500">
                                            <i class="fas fa-heart"></i>
                                            <span>{{ rand(50, 300) }}</span>
                                        </div>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ rand(1, 30) }}/01/2024
                                    </div>
                                </div>

                                <div class="flex gap-2">
                                    <button onclick="editVideo({{ $i }})"
                                        class="flex-1 px-3 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors duration-200">
                                        <i class="fas fa-edit mr-2"></i>
                                        Editar
                                    </button>
                                    <button onclick="showVideoActions({{ $i }})"
                                        class="px-3 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>

                <!-- Pagination -->
                <div class="mt-8 flex justify-center">
                    <nav class="flex items-center gap-2">
                        <button
                            class="px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed"
                            disabled>
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="px-3 py-2 bg-blue-600 text-white rounded-lg font-medium">
                            1
                        </button>
                        <button class="px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                            2
                        </button>
                        <button class="px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                            3
                        </button>
                        <button class="px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </nav>
                </div>
            </div>
        </main>
    </div>

    <!-- Upload Video Modal -->
    <div id="uploadModal" class="modal-overlay backdrop-blur">
        <div class="modal-content">
            <div class="p-6">
                <!-- Modal Header -->
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">Upload de Vídeo</h2>
                    <button onclick="closeUploadModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <!-- Upload Form -->
                <form id="uploadForm" onsubmit="handleUpload(event)">
                    <!-- File Upload Area -->
                    <div class="mb-6">
                        <div id="dropArea" class="file-upload-area" onclick="document.getElementById('videoFile').click()">
                            <div class="mb-4">
                                <i class="fas fa-cloud-upload-alt text-4xl text-blue-500 mb-2"></i>
                                <p class="text-gray-700 font-medium">Arraste e solte seu vídeo aqui</p>
                                <p class="text-gray-500 text-sm mt-1">ou clique para selecionar</p>
                            </div>
                            <input type="file" id="videoFile" name="video" accept="video/*" class="hidden"
                                onchange="handleFileSelect(event)">
                            <p class="text-gray-400 text-xs">Formatos suportados: MP4, AVI, MOV, MKV (Max: 2GB)</p>
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
                        </div>
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
                                Descrição
                            </label>
                            <textarea id="videoDescription" name="description" rows="3" placeholder="Descreva o conteúdo do vídeo..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="videoCategory" class="block text-sm font-medium text-gray-700 mb-1">
                                    Categoria
                                </label>
                                <select id="videoCategory" name="category"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                                    <option value="">Selecione uma categoria</option>
                                    <option value="programming">Programação</option>
                                    <option value="design">Design</option>
                                    <option value="business">Negócios</option>
                                    <option value="marketing">Marketing</option>
                                </select>
                            </div>

                            <div>
                                <label for="videoVisibility" class="block text-sm font-medium text-gray-700 mb-1">
                                    Visibilidade
                                </label>
                                <select id="videoVisibility" name="visibility"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                                    <option value="public">Público</option>
                                    <option value="private">Privado</option>
                                    <option value="draft">Rascunho</option>
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

            // Close modal when clicking outside
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
                dropArea.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                dropArea.classList.add('dragover');
            }

            function unhighlight() {
                dropArea.classList.remove('dragover');
            }

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
                if (files.length > 0) {
                    selectedFile = files[0];

                    // Validate file type and size
                    const validTypes = ['video/mp4', 'video/avi', 'video/mov', 'video/mkv', 'video/quicktime'];
                    const maxSize = 2 * 1024 * 1024 * 1024; // 2GB in bytes

                    if (!validTypes.includes(selectedFile.type)) {
                        alert('Tipo de arquivo não suportado. Por favor, selecione um arquivo de vídeo.');
                        return;
                    }

                    if (selectedFile.size > maxSize) {
                        alert('Arquivo muito grande. O tamanho máximo é 2GB.');
                        return;
                    }

                    // Display file info
                    fileName.textContent = selectedFile.name;
                    fileSize.textContent = formatFileSize(selectedFile.size);
                    fileInfo.classList.remove('hidden');
                }
            }

            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }

            function removeFile() {
                selectedFile = null;
                fileInput.value = '';
                fileInfo.classList.add('hidden');
            }

            // Form Submission
            function handleUpload(e) {
                e.preventDefault();

                if (!selectedFile) {
                    alert('Por favor, selecione um arquivo de vídeo.');
                    return;
                }

                // Show progress bar
                const progressDiv = document.getElementById('uploadProgress');
                const progressBar = document.getElementById('progressBar');
                const progressPercent = document.getElementById('progressPercent');
                const uploadButton = document.getElementById('uploadButton');

                progressDiv.classList.remove('hidden');
                uploadButton.disabled = true;
                uploadButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Enviando...</span>';

                // Simulate upload progress (replace with actual AJAX upload)
                let progress = 0;
                const interval = setInterval(() => {
                    progress += 10;
                    progressBar.style.width = progress + '%';
                    progressPercent.textContent = progress + '%';

                    if (progress >= 100) {
                        clearInterval(interval);
                        setTimeout(() => {
                            alert('Vídeo enviado com sucesso!');
                            closeUploadModal();
                            // Here you would typically refresh the videos list or add the new video
                        }, 500);
                    }
                }, 200);
            }

            function resetForm() {
                document.getElementById('uploadForm').reset();
                removeFile();

                const progressDiv = document.getElementById('uploadProgress');
                const progressBar = document.getElementById('progressBar');
                const progressPercent = document.getElementById('progressPercent');
                const uploadButton = document.getElementById('uploadButton');

                progressDiv.classList.add('hidden');
                progressBar.style.width = '0%';
                progressPercent.textContent = '0%';
                uploadButton.disabled = false;
                uploadButton.innerHTML = '<i class="fas fa-upload"></i><span>Upload Vídeo</span>';
            }

            // Original functions (keep these)
            function toggleSidebar() {
                // Your existing sidebar toggle function
                console.log('Toggle sidebar');
            }

            function quickAction() {
                openUploadModal(); // Changed from original to open modal
            }

            function editVideo(id) {
                console.log('Edit video:', id);
            }

            function showVideoActions(id) {
                console.log('Show actions for video:', id);
            }
        </script>
    @endpush
@endsection
