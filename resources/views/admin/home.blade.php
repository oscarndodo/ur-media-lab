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


    <main class="p-6">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Vídeos -->
            <div class="stat-card bg-white rounded-xl p-6 shadow-sm fade-in">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total de Vídeos</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">156</h3>
                        <p class="text-sm text-green-600 mt-2">
                            <i class="fas fa-arrow-up mr-1"></i>
                            12% este mês
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-video text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Professores -->
            <div class="stat-card bg-white rounded-xl p-6 shadow-sm fade-in" style="animation-delay: 0.1s">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Professores</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">24</h3>
                        <p class="text-sm text-green-600 mt-2">
                            <i class="fas fa-arrow-up mr-1"></i>
                            8% este mês
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
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">1,842</h3>
                        <p class="text-sm text-green-600 mt-2">
                            <i class="fas fa-arrow-up mr-1"></i>
                            5% esta semana
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
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">12</h3>
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
                                                    Categoria</th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Data</th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            <tr class="table-row-hover">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div
                                                            class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded flex items-center justify-center">
                                                            <i class="fas fa-video text-gray-600"></i>
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                JavaScript Avançado</div>
                                                            <div class="text-sm text-gray-500">por Carlos Silva
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span
                                                        class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-800">Programação</span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    15/06/2023</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 py-1 text-xs rounded status-active">Publicado</span>
                                                </td>
                                            </tr>
                                            <tr class="table-row-hover">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div
                                                            class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded flex items-center justify-center">
                                                            <i class="fas fa-video text-gray-600"></i>
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">UI
                                                                Design Moderno</div>
                                                            <div class="text-sm text-gray-500">por Ana Santos</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span
                                                        class="px-2 py-1 text-xs rounded bg-green-100 text-green-800">Design</span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    14/06/2023</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 py-1 text-xs rounded status-pending">Pendente</span>
                                                </td>
                                            </tr>
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
            var options = {
                series: [{
                    name: "Visualizações",
                    data: [10, 41, 35, 51, 49, 62, 69, 91, 148, 432, 212, 34]
                }],
                chart: {
                    type: 'area',
                    height: 360,
                    toolbar: {
                        show: false // remove toolbar (download, zoom, etc.)
                    },
                    zoom: {
                        enabled: false // sem zoom
                    },
                    animations: {
                        enabled: true // sem animações de interação
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                colors: ['#2563eb'], // azul profissional
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
                    text: 'Visualizações por mês',
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
                    categories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
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
                            return val.toFixed(0);
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
                    enabled: false // sem interação de tooltip
                }
            };


            var chart = new ApexCharts(document.querySelector("#chartBox"), options);
            chart.render();
        </script>
    @endpush
@endsection
