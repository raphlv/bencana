@extends('layouts.app')

@section('content')
<div class="fade-in">
    <!-- Hero / Header Title -->
    <div class="card" style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(22, 30, 46, 0.7) 100%);">
        <h1 style="font-size: 2.2rem; font-weight: 800; margin-bottom: 0.75rem; letter-spacing: -0.025em; line-height: 1.2;">
            Analisis Perbandingan Algoritma Random Forest dan SVM untuk Klasifikasi Curah Hujan Ekstrem dalam Mitigasi Bencana
        </h1>
        <p style="color: var(--text-secondary); font-size: 1.1rem; max-width: 900px; line-height: 1.6;">
            Sistem dashboard riset skripsi untuk memetakan, melatih, dan membandingkan performa model klasifikasi 
            <strong>Random Forest</strong> dan <strong>Support Vector Machine (SVM)</strong> berdasarkan parameter iklim 
            suhu rata-rata (TAVG), kelembapan rata-rata (RH_AVG), dan curah hujan (RR).
        </p>
    </div>

    <!-- Stats Grid -->
    <div class="grid-4">
        <div class="stat-widget primary">
            <span class="stat-label">Total Data Historis</span>
            <span class="stat-value">{{ $totalDays }} Hari</span>
        </div>
        <div class="stat-widget rf">
            <span class="stat-label">Rata-rata Suhu (TAVG)</span>
            <span class="stat-value">{{ number_format($avgTemp, 1) }} °C</span>
        </div>
        <div class="stat-widget svm">
            <span class="stat-label">Rata-rata Kelembapan (RH)</span>
            <span class="stat-value">{{ number_format($avgHumid, 1) }} %</span>
        </div>
        <div class="stat-widget danger">
            <span class="stat-label">Kejadian Ekstrem</span>
            <span class="stat-value">
                {{ $extremeDays }} Hari ({{ number_format($extremePercentage, 1) }}%)
            </span>
        </div>
    </div>

    <!-- Charts and Context Grid -->
    <div class="grid-2" style="margin-top: 2rem;">
        <!-- Research Context Card -->
        <div class="card">
            <h3 class="card-title">
                <i class="fa-solid fa-circle-info" style="color: var(--color-accent);"></i> Latar Belakang & Metodologi
            </h3>
            <p style="color: var(--text-secondary); line-height: 1.7; font-size: 0.95rem; margin-bottom: 1rem;">
                Bencana hidrometeorologi seperti banjir dan tanah longsor sangat dipengaruhi oleh intensitas curah hujan ekstrem. 
                Melalui pengklasifikasian curah hujan ekstrem secara dini, mitigasi bencana dapat dijalankan lebih efektif.
            </p>
            <p style="color: var(--text-secondary); line-height: 1.7; font-size: 0.95rem; margin-bottom: 1.5rem;">
                Penelitian ini membandingkan dua algoritma machine learning populer:
            </p>
            
            <div style="display: flex; flex-direction: column; gap: 1rem; margin-bottom: 1.5rem;">
                <div style="display: flex; gap: 0.75rem; align-items: flex-start;">
                    <span class="badge badge-normal" style="background: rgba(16, 185, 129, 0.1); color: var(--color-rf); border-color: rgba(16, 185, 129, 0.3); font-size: 0.7rem; margin-top: 0.2rem;">Random Forest</span>
                    <div>
                        <h4 style="font-size: 0.95rem; font-weight: 600; margin-bottom: 0.25rem;">Random Forest Classifier</h4>
                        <p style="font-size: 0.85rem; color: var(--text-muted); line-height: 1.5;">
                            Algoritma ensemble berbasis decision trees yang bekerja dengan teknik bagging dan random feature selection. Sangat stabil dan handal menangani data iklim non-linear.
                        </p>
                    </div>
                </div>
                
                <div style="display: flex; gap: 0.75rem; align-items: flex-start;">
                    <span class="badge badge-normal" style="background: rgba(6, 182, 212, 0.1); color: var(--color-svm); border-color: rgba(6, 182, 212, 0.3); font-size: 0.7rem; margin-top: 0.2rem;">SVM</span>
                    <div>
                        <h4 style="font-size: 0.95rem; font-weight: 600; margin-bottom: 0.25rem;">Support Vector Machine (SVM)</h4>
                        <p style="font-size: 0.85rem; color: var(--text-muted); line-height: 1.5;">
                            Algoritma yang mencari hyperplane pemisah optimal dengan margin maksimum. Menggunakan kernel trick (Linear/RBF) untuk memetakan fitur ke dimensi lebih tinggi.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Trends Chart Card -->
        <div class="card">
            <h3 class="card-title">
                <i class="fa-solid fa-chart-line" style="color: var(--color-rf);"></i> Tren Curah Hujan Bulanan (Simulasi/Riil)
            </h3>
            
            @if(count($monthlyStats) > 0)
                <div style="position: relative; height: 300px; width: 100%;">
                    <canvas id="monthlyRainfallChart"></canvas>
                </div>
            @else
                <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 300px; color: var(--text-muted); gap: 0.75rem;">
                    <i class="fa-solid fa-folder-open" style="font-size: 3rem;"></i>
                    <p>Database kosong. Silakan masuk ke menu <strong>Kelola Data</strong> untuk mengisi data.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- BMKG Rainfall Classification & ML Decision Boundaries -->
    <div class="grid-2" style="margin-top: 2rem; margin-bottom: 2rem;">
        <!-- Distribution Chart Card -->
        <div class="card" style="display: flex; flex-direction: column; justify-content: space-between;">
            <div>
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1.5rem;">
                    <div>
                        <h3 class="card-title" style="margin-bottom: 0.25rem;">
                            <i class="fa-solid fa-chart-column" style="color: var(--color-rf);"></i> Distribusi Kejadian Hujan
                        </h3>
                        <p style="color: var(--text-muted); font-size: 0.85rem;">Berdasarkan Klasifikasi Intensitas BMKG (2024-2026)</p>
                    </div>
                    <!-- Logos container -->
                    <div style="display: flex; gap: 0.5rem; align-items: center; background: rgba(255, 255, 255, 0.03); padding: 0.25rem 0.5rem; border-radius: 8px; border: 1px solid var(--border-color);">
                        <!-- University Logo SVG -->
                        <svg width="28" height="28" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" title="Universitas">
                            <circle cx="50" cy="50" r="45" fill="#fbc02d" opacity="0.2"/>
                            <circle cx="50" cy="50" r="43" fill="none" stroke="#0071bc" stroke-width="3"/>
                            <circle cx="50" cy="50" r="38" fill="none" stroke="#fbc02d" stroke-width="2"/>
                            <path d="M 50,25 L 35,45 L 45,45 L 42,65 L 58,65 L 55,45 L 65,45 Z" fill="#0071bc"/>
                            <circle cx="50" cy="35" r="4" fill="#fbc02d"/>
                            <text x="50" y="82" font-family="Arial, sans-serif" font-weight="bold" font-size="10" fill="#0071bc" text-anchor="middle">UNJ</text>
                        </svg>
                        <!-- BMKG Logo SVG -->
                        <svg width="28" height="28" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" title="BMKG">
                            <circle cx="50" cy="50" r="45" fill="none" stroke="#0071bc" stroke-width="2"/>
                            <path d="M 15,35 Q 35,25 50,35 Q 65,45 85,35" fill="none" stroke="#0071bc" stroke-width="3"/>
                            <path d="M 15,50 Q 35,40 50,50 Q 65,60 85,50" fill="none" stroke="#00a79d" stroke-width="3"/>
                            <path d="M 15,65 Q 35,55 50,65 Q 65,75 85,65" fill="none" stroke="#8dc63f" stroke-width="3"/>
                            <text x="50" y="88" font-family="Arial, sans-serif" font-weight="bold" font-size="14" fill="#1b365d" text-anchor="middle">BMKG</text>
                        </svg>
                    </div>
                </div>

                @if($totalDays > 0)
                    <div style="position: relative; height: 320px; width: 100%;">
                        <canvas id="bmkgDistributionChart"></canvas>
                    </div>
                @else
                    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 320px; color: var(--text-muted); gap: 0.75rem;">
                        <i class="fa-solid fa-folder-open" style="font-size: 3rem;"></i>
                        <p>Database kosong. Silakan masuk ke menu <strong>Kelola Data</strong> untuk mengisi data.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Scatter Plot Card -->
        <div class="card" style="display: flex; flex-direction: column; justify-content: space-between;">
            <div>
                <h3 class="card-title" style="margin-bottom: 0.25rem;">
                    <i class="fa-solid fa-chart-line" style="color: var(--color-svm);"></i> Ilustrasi Klasifikasi Machine Learning
                </h3>
                <p style="color: var(--text-muted); font-size: 0.85rem; margin-bottom: 1.5rem;">Pola Pemisahan Kategori Hujan di Stamet Kemayoran (Suhu vs. Kelembapan)</p>

                @if($totalDays > 0)
                    <div style="position: relative; height: 320px; width: 100%;">
                        <canvas id="mlClassificationChart"></canvas>
                    </div>
                @else
                    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 320px; color: var(--text-muted); gap: 0.75rem;">
                        <i class="fa-solid fa-folder-open" style="font-size: 3rem;"></i>
                        <p>Database kosong. Silakan masuk ke menu <strong>Kelola Data</strong> untuk mengisi data.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Workflow Steps Card -->
    <div class="card">
        <h3 class="card-title">
            <i class="fa-solid fa-list-check" style="color: var(--color-svm);"></i> Alur Tahapan Penelitian Sistem
        </h3>
        
        <div class="grid-3" style="margin-top: 1rem; gap: 1.5rem;">
            <div style="background: rgba(255, 255, 255, 0.01); border: 1px solid var(--border-color); border-radius: 12px; padding: 1.25rem; position: relative;">
                <span style="position: absolute; top: 1rem; right: 1rem; font-size: 1.5rem; font-weight: 800; color: rgba(255,255,255,0.05);">01</span>
                <h4 style="font-size: 1rem; font-weight: 600; margin-bottom: 0.5rem; color: var(--color-accent);"><i class="fa-solid fa-cloud-arrow-down"></i> Input & Sanitasi Data</h4>
                <p style="font-size: 0.85rem; color: var(--text-secondary); line-height: 1.6;">
                    Mengunggah file CSV dari portal BMKG atau generate data simulasi. Melakukan imputasi mean jika terdapat data temperatur atau kelembapan yang kosong.
                </p>
            </div>
            
            <div style="background: rgba(255, 255, 255, 0.01); border: 1px solid var(--border-color); border-radius: 12px; padding: 1.25rem; position: relative;">
                <span style="position: absolute; top: 1rem; right: 1rem; font-size: 1.5rem; font-weight: 800; color: rgba(255,255,255,0.05);">02</span>
                <h4 style="font-size: 1rem; font-weight: 600; margin-bottom: 0.5rem; color: var(--color-rf);"><i class="fa-solid fa-arrows-spin"></i> Preprocessing & Training</h4>
                <p style="font-size: 0.85rem; color: var(--text-secondary); line-height: 1.6;">
                    Melakukan pembagian data latih/uji (80:20) dan standardisasi fitur Z-score. Model Random Forest dan SVM dilatih secara parallel pada data latih.
                </p>
            </div>
            
            <div style="background: rgba(255, 255, 255, 0.01); border: 1px solid var(--border-color); border-radius: 12px; padding: 1.25rem; position: relative;">
                <span style="position: absolute; top: 1rem; right: 1rem; font-size: 1.5rem; font-weight: 800; color: rgba(255,255,255,0.05);">03</span>
                <h4 style="font-size: 1rem; font-weight: 600; margin-bottom: 0.5rem; color: var(--color-svm);"><i class="fa-solid fa-shield-halved"></i> Perbandingan & Prediksi</h4>
                <p style="font-size: 0.85rem; color: var(--text-secondary); line-height: 1.6;">
                    Mengevaluasi akurasi, confusion matrix, dan kurva ROC dari kedua model pada data uji. Model kemudian digunakan untuk memprediksi curah hujan dan mitigasinya.
                </p>
            </div>
        </div>
    </div>
</div>

@if(count($monthlyStats) > 0)
<script>
    // Custom Chart.js plugins and callbacks
    const barLabelsPlugin = {
        id: 'barLabels',
        afterDatasetsDraw(chart) {
            const { ctx, data } = chart;
            ctx.save();
            ctx.font = 'bold 11px Outfit, sans-serif';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'bottom';
            
            chart.getDatasetMeta(0).data.forEach((bar, index) => {
                const value = data.datasets[0].data[index];
                ctx.fillStyle = '#f8fafc'; // White text
                ctx.fillText(value + ' HARI', bar.x, bar.y - 6);
            });
            ctx.restore();
        }
    };

    const diagonalBoundaryPlugin = {
        id: 'diagonalBoundary',
        beforeDraw(chart) {
            const { ctx, chartArea, scales } = chart;
            if (!chartArea) return;
            
            const x = scales.x;
            const y = scales.y;
            
            ctx.save();
            ctx.beginPath();
            ctx.rect(chartArea.left, chartArea.top, chartArea.width, chartArea.height);
            ctx.clip();
            
            // Boundary line equations: Y = m*X + c
            // Line 1 (Green/Blue): Y = -10*X + 355
            // Line 2 (Blue/Yellow): Y = -9*X + 338
            // Line 3 (Yellow/Red): Y = -9.3*X + 358.4
            const getY1 = (temp) => -10 * temp + 355;
            const getY2 = (temp) => -9 * temp + 338;
            const getY3 = (temp) => -9.3 * temp + 358.4;
            
            const minTemp = 25;
            const maxTemp = 32;
            const minHum = 65;
            const maxHum = 100;
            
            const getXPixel = (val) => x.getPixelForValue(val);
            const getYPixel = (val) => y.getPixelForValue(val);
            
            // 1. Green Region (Tidak Hujan)
            ctx.fillStyle = 'rgba(16, 185, 129, 0.12)';
            ctx.beginPath();
            ctx.moveTo(getXPixel(minTemp), getYPixel(minHum));
            for (let t = minTemp; t <= maxTemp; t += 0.1) {
                let humVal = Math.min(maxHum, Math.max(minHum, getY1(t)));
                ctx.lineTo(getXPixel(t), getYPixel(humVal));
            }
            ctx.lineTo(getXPixel(maxTemp), getYPixel(minHum));
            ctx.closePath();
            ctx.fill();
            
            // 2. Blue Region (Hujan Ringan)
            ctx.fillStyle = 'rgba(59, 130, 246, 0.12)';
            ctx.beginPath();
            for (let t = minTemp; t <= maxTemp; t += 0.1) {
                let humVal = Math.min(maxHum, Math.max(minHum, getY2(t)));
                ctx.lineTo(getXPixel(t), getYPixel(humVal));
            }
            for (let t = maxTemp; t >= minTemp; t -= 0.1) {
                let humVal = Math.min(maxHum, Math.max(minHum, getY1(t)));
                ctx.lineTo(getXPixel(t), getYPixel(humVal));
            }
            ctx.closePath();
            ctx.fill();
            
            // 3. Yellow Region (Hujan Sedang)
            ctx.fillStyle = 'rgba(245, 158, 11, 0.12)';
            ctx.beginPath();
            for (let t = minTemp; t <= maxTemp; t += 0.1) {
                let humVal = Math.min(maxHum, Math.max(minHum, getY3(t)));
                ctx.lineTo(getXPixel(t), getYPixel(humVal));
            }
            for (let t = maxTemp; t >= minTemp; t -= 0.1) {
                let humVal = Math.min(maxHum, Math.max(minHum, getY2(t)));
                ctx.lineTo(getXPixel(t), getYPixel(humVal));
            }
            ctx.closePath();
            ctx.fill();
            
            // 4. Red Region (Hujan Lebat)
            ctx.fillStyle = 'rgba(239, 68, 68, 0.12)';
            ctx.beginPath();
            ctx.moveTo(getXPixel(minTemp), getYPixel(maxHum));
            ctx.lineTo(getXPixel(maxTemp), getYPixel(maxHum));
            for (let t = maxTemp; t >= minTemp; t -= 0.1) {
                let humVal = Math.min(maxHum, Math.max(minHum, getY3(t)));
                ctx.lineTo(getXPixel(t), getYPixel(humVal));
            }
            ctx.closePath();
            ctx.fill();
            
            ctx.restore();
        }
    };

    document.addEventListener('DOMContentLoaded', function() {
        // --- 1. Monthly Trends Chart ---
        const ctx = document.getElementById('monthlyRainfallChart').getContext('2d');
        const months = @json($monthlyStats->pluck('month'));
        const rainfall = @json($monthlyStats->pluck('total_rain'));
        const extremes = @json($monthlyStats->pluck('extreme_count'));

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [
                    {
                        label: 'Total Curah Hujan (mm)',
                        data: rainfall,
                        backgroundColor: 'rgba(99, 102, 241, 0.3)',
                        borderColor: '#6366f1',
                        borderWidth: 2,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Frekuensi Hari Ekstrem',
                        data: extremes,
                        type: 'line',
                        borderColor: '#ef4444',
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        borderWidth: 3,
                        pointRadius: 4,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: { color: '#f8fafc', font: { family: 'Outfit' } }
                    }
                },
                scales: {
                    x: {
                        ticks: { color: '#94a3b8' },
                        grid: { color: 'rgba(255,255,255,0.03)' }
                    },
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        ticks: { color: '#94a3b8' },
                        title: { display: true, text: 'Curah Hujan (mm)', color: '#94a3b8' },
                        grid: { color: 'rgba(255,255,255,0.05)' }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        ticks: { color: '#94a3b8', stepSize: 1 },
                        title: { display: true, text: 'Frekuensi Hari Ekstrem', color: '#94a3b8' },
                        grid: { drawOnChartArea: false } // Only keep grid lines of the left axis
                    }
                }
            }
        });

        // --- 2. BMKG Distribution Chart ---
        const distCtx = document.getElementById('bmkgDistributionChart').getContext('2d');
        const distData = [
            {{ $tidakHujanCount }},
            {{ $ringanCount }},
            {{ $sedangCount }},
            {{ $lebatCount }}
        ];

        new Chart(distCtx, {
            type: 'bar',
            data: {
                labels: ['TIDAK HUJAN', 'HUJAN RINGAN', 'HUJAN SEDANG', 'HUJAN LEBAT'],
                datasets: [{
                    data: distData,
                    backgroundColor: [
                        '#10b981', // Green
                        '#3b82f6', // Blue
                        '#f59e0b', // Yellow
                        '#ef4444'  // Red
                    ],
                    borderColor: [
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(239, 68, 68, 0.8)'
                    ],
                    borderWidth: 1.5,
                    borderRadius: 6
                }]
            },
            plugins: [barLabelsPlugin],
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.raw + ' Hari';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: { color: '#94a3b8', font: { family: 'Outfit', weight: 'bold' } },
                        grid: { display: false }
                    },
                    y: {
                        ticks: { color: '#94a3b8' },
                        grid: { color: 'rgba(255,255,255,0.05)' },
                        title: { display: true, text: 'Jumlah Hari', color: '#94a3b8' }
                    }
                }
            }
        });

        // --- 3. ML Classification Scatter Chart ---
        const mlCtx = document.getElementById('mlClassificationChart').getContext('2d');
        const scatterPoints = @json($scatterPoints);

        const tidakHujanPoints = scatterPoints.filter(p => p.category === 'Tidak Hujan');
        const ringanPoints = scatterPoints.filter(p => p.category === 'Hujan Ringan');
        const sedangPoints = scatterPoints.filter(p => p.category === 'Hujan Sedang');
        const lebatPoints = scatterPoints.filter(p => p.category === 'Hujan Lebat');

        new Chart(mlCtx, {
            type: 'scatter',
            data: {
                datasets: [
                    {
                        label: 'Tidak Hujan',
                        data: tidakHujanPoints,
                        backgroundColor: '#10b981',
                        borderColor: '#064e3b',
                        borderWidth: 1,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    },
                    {
                        label: 'Hujan Ringan',
                        data: ringanPoints,
                        backgroundColor: '#3b82f6',
                        borderColor: '#1e3a8a',
                        borderWidth: 1,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    },
                    {
                        label: 'Hujan Sedang',
                        data: sedangPoints,
                        backgroundColor: '#f59e0b',
                        borderColor: '#78350f',
                        borderWidth: 1,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    },
                    {
                        label: 'Hujan Lebat',
                        data: lebatPoints,
                        backgroundColor: '#ef4444',
                        borderColor: '#7f1d1d',
                        borderWidth: 1,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }
                ]
            },
            plugins: [diagonalBoundaryPlugin],
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: { color: '#f8fafc', font: { family: 'Outfit' } }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `Suhu: ${context.parsed.x} °C, RH: ${context.parsed.y} % (${context.dataset.label})`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        type: 'linear',
                        position: 'bottom',
                        min: 25,
                        max: 32,
                        title: { display: true, text: 'Suhu Rata-rata (TAVG) [°C]', color: '#94a3b8', font: { family: 'Outfit' } },
                        ticks: { color: '#94a3b8' },
                        grid: { color: 'rgba(255,255,255,0.05)' }
                    },
                    y: {
                        type: 'linear',
                        min: 65,
                        max: 100,
                        title: { display: true, text: 'Kelembapan Rata-rata (RH_AVG) [%]', color: '#94a3b8', font: { family: 'Outfit' } },
                        ticks: { color: '#94a3b8' },
                        grid: { color: 'rgba(255,255,255,0.05)' }
                    }
                }
            }
        });
    });
</script>
@endif
@endsection
