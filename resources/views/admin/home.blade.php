@extends('admin.index')

@section('main')
    @push('styles')
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

            .sidebar {
                transition: all 0.3s ease;
            }

            .sidebar-collapsed {
                width: 70px;
            }

            .sidebar-collapsed .sidebar-text {
                display: none;
            }

            .stat-card {
                transition: all 0.3s ease;
            }

            .stat-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            }

            .table-row-hover:hover {
                background-color: #f9fafb;
            }

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

            .tab-active {
                border-bottom: 3px solid #3b82f6;
                color: #3b82f6;
            }

            .chart-container {
                height: 300px;
            }

            .avatar-upload {
                border: 2px dashed #d1d5db;
                transition: all 0.3s ease;
            }

            .avatar-upload:hover {
                border-color: #3b82f6;
                background-color: #f0f9ff;
            }

            .status-active {
                background-color: #d1fae5;
                color: #065f46;
            }

            .status-inactive {
                background-color: #fee2e2;
                color: #991b1b;
            }

            .status-pending {
                background-color: #fef3c7;
                color: #92400e;
            }

            .drag-over {
                border-color: #3b82f6;
                background-color: #eff6ff;
            }
        </style>
    @endpush

    @php
        // Mapa rápido de Disciplinas por nome (para aplicar cor do badge quando existir)
        $categoryMap = isset($categories) ? $categories->keyBy('name') : collect();
        $videoGrowthIsUp = ($videoGrowthPct ?? 0) >= 0;
        $teacherGrowthIsUp = ($teacherGrowthPct ?? 0) >= 0;
    @endphp

    <main class="p-6">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Vídeos -->
            <div class="stat-card bg-white rounded-xl p-6 shadow-sm fade-in">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total de Vídeos</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($totalVideos ?? 0, 0, ',', '.') }}
                        </h3>

                        <p class="text-sm mt-2 {{ $videoGrowthIsUp ? 'text-green-600' : 'text-red-600' }}">
                            <i class="fas {{ $videoGrowthIsUp ? 'fa-arrow-up' : 'fa-arrow-down' }} mr-1"></i>
                            {{ abs((int) ($videoGrowthPct ?? 0)) }}% este mês
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-video text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Docentes -->
            <div class="stat-card bg-white rounded-xl p-6 shadow-sm fade-in" style="animation-delay: 0.1s">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Docentes</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">
                            {{ number_format($totalTeachers ?? 0, 0, ',', '.') }}</h3>

                        <p class="text-sm mt-2 {{ $teacherGrowthIsUp ? 'text-green-600' : 'text-red-600' }}">
                            <i class="fas {{ $teacherGrowthIsUp ? 'fa-arrow-up' : 'fa-arrow-down' }} mr-1"></i>
                            {{ abs((int) ($teacherGrowthPct ?? 0)) }}% este mês
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-chalkboard-teacher text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Usuários -->
            <div class="stat-card bg-white rounded-xl p-6 shadow-sm fade-in" style="animation-delay: 0.2s">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Usuários Ativos</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">
                            {{ number_format($activeUsers ?? 0, 0, ',', '.') }}</h3>
                        <p class="text-sm text-gray-500 mt-2">
                            <i class="fas fa-users mr-1"></i>
                            Registos activos
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-users text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Vídeos Pendentes -->
            <div class="stat-card bg-white rounded-xl p-6 shadow-sm fade-in" style="animation-delay: 0.3s">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Vídeos Pendentes</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">
                            {{ number_format($pendingVideos ?? 0, 0, ',', '.') }}</h3>
                        <p class="text-sm text-yellow-600 mt-2">
                            <i class="fas fa-clock mr-1"></i>
                            Necessitam revisão
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-clock text-yellow-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Tabs -->
        <div class=" mb-6">
            <!-- Tab Content -->
            <div class="p-6">
                <!-- Dashboard Tab -->
                <div id="tab-dashboard" class="tab-content">
                    <!-- Charts Row -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                        <!-- Visitas Chart -->
                        <div class="bg-white p-6 rounded-xl border">
                            <div id="chartBox"></div>
                        </div>

                        <!-- Últimos Vídeos -->
                        <div class="">
                            <h3 class="font-semibold text-gray-800 mb-4">Últimos Vídeos Adicionados</h3>
                            <div class="bg-white rounded-xl border overflow-hidden">
                                <div class="overflow-x-auto">
                                    <table class="w-full">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Título</th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Disciplina</th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Data</th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            @forelse(($latestVideos ?? []) as $video)
                                                @php
                                                    $teacherName = optional($video->user)->name ?? '—';
                                                    $cat = $video->category ?? '—';
                                                    $catObj = $categoryMap->get($cat);
                                                    $catColor = $catObj->color ?? '#E5E7EB';

                                                    $status = $video->status ?? 'private';
                                                    $statusLabel =
                                                        $status === 'public'
                                                            ? 'Publicado'
                                                            : ($status === 'private'
                                                                ? 'Pendente'
                                                                : ucfirst($status));
                                                    $statusClass =
                                                        $status === 'public'
                                                            ? 'status-active'
                                                            : ($status === 'private'
                                                                ? 'status-pending'
                                                                : 'status-inactive');
                                                @endphp

                                                <tr class="table-row-hover">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div
                                                                class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded flex items-center justify-center">
                                                                <i class="fas fa-video text-gray-600"></i>
                                                            </div>
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    {{ $video->title ?? '—' }}
                                                                </div>
                                                                <div class="text-sm text-gray-500">
                                                                    por {{ $teacherName }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <span class="px-2 py-1 text-xs rounded {{ $catColor }}"
                                                            style="background-color: {{ $catColor }}; color: #ffffff;">
                                                            {{ $cat }}
                                                        </span>
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ optional($video->created_at)->format('d/m/Y') }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <span class="px-2 py-1 text-xs rounded {{ $statusClass }}">
                                                            {{ $statusLabel }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">
                                                        Sem vídeos para mostrar.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            // Dados vindos do Controller (últimos 12 meses)
            const chartSeries = @json($chartSeries ?? []);
            const chartLabels = @json($chartLabels ?? []);
            const chartIsViews = @json($chartIsViews ?? false);

            var options = {
                series: [{
                    name: chartIsViews ? "Visualizações" : "Uploads",
                    data: chartSeries
                }],
                chart: {
                    type: 'area',
                    height: 360,
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    },
                    animations: {
                        enabled: true
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                colors: ['#2563eb'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        type: "vertical",
                        opacityFrom: 0.6,
                        opacityTo: 0.05,
                        stops: [0, 50, 100]
                    }
                },
                title: {
                    text: (chartIsViews ? 'Visualizações' : 'Uploads') + ' por mês',
                    align: 'left',
                    style: {
                        fontSize: '16px',
                        fontWeight: 600
                    }
                },
                grid: {
                    borderColor: '#e5e7eb',
                    strokeDashArray: 4,
                    row: {
                        colors: ['#f9fafb', 'transparent'],
                        opacity: 1
                    },
                    padding: {
                        left: 12,
                        right: 12
                    }
                },
                xaxis: {
                    categories: chartLabels,
                    axisBorder: {
                        show: true,
                        color: '#e5e7eb'
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            fontSize: '11px'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        formatter: function(val) {
                            return Number(val).toFixed(0);
                        },
                        style: {
                            fontSize: '11px'
                        }
                    }
                },
                legend: {
                    show: true
                },
                tooltip: {
                    enabled: false
                }
            };

            var chart = new ApexCharts(document.querySelector("#chartBox"), options);
            chart.render();
        </script>
    @endpush
@endsection
