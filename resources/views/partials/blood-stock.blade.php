<!-- BLOOD STOCK SECTION -->
<section id="blood_stock" class="py-12 bg-gradient-to-l from-red-100 via-gray-50 to-white-100">
    <div class="container mx-auto px-4">
        <h2 class="section-title tracking-widest pb-6 font-Poppins text-center text-3xl sm:text-4xl" data-aos="fade-down"
            data-aos-duration="1000">
            BLOODSTOCK
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Left: List Data -->
            <div class="space-y-4" data-aos="fade-right" data-aos-duration="1000">
                <ul class="space-y-2 text-lg text-gray-700">
                    @foreach ($stok as $item)
                        <li class="flex items-center justify-between border-b pb-2 hover:bg-gray-50 transition duration-300 cursor-pointer"
                            data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <span class="font-medium">Blood type {{ $item->blood_type }}</span>
                            <span class="text-red-600">
                                {{ floor($item->total_darah / 450) }} Kantong
                            </span>

                            </span>

                        </li>
                    @endforeach
                </ul>

                @php
                    $totalDarah = $stok->sum('total_darah');
                @endphp

                <p class="text-xl font-semibold mt-4 pr-5" data-aos="fade-up"
                    data-aos-delay="{{ $stok->count() * 100 }}" Total Blood Stock: <span class="text-red-600">
                    {{ floor($totalDarah / 450) }} Kantong</>
                    <br>
                    Total Blood Stock: <span class="text-red-600">{{ $totalDarah }} ML</span>
                </p>
            </div>

            <!-- Right: Donut Chart -->
            <div class="shadow-lg rounded-lg bg-white p-4 flex justify-center items-center"
                style="width: 100%; height: 400px;" data-aos="zoom-in" data-aos-duration="1200">
                <canvas id="donutChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Donut Chart Script -->
    <script>
        const ctx = document.getElementById('donutChart').getContext('2d');

        const centerText = {
            id: 'centerText',
            beforeDraw(chart, args, options) {
                const {
                    width,
                    height,
                    ctx
                } = chart;
                ctx.restore();
                const fontSize = (height / 120).toFixed(2);
                ctx.font = `${fontSize}em sans-serif`;
                ctx.textBaseline = 'middle';
                ctx.fillStyle = '#ef4444';

                const text = '{{ $totalDarah }} ml';
                const textX = Math.round((width - ctx.measureText(text).width) / 2);
                const textY = height / 2;

                ctx.fillText(text, textX, textY);
                ctx.save();
            }
        };

        const data = {
            labels: [
                @foreach ($stok as $item)
                    '{{ $item->blood_type }}',
                @endforeach
            ],
            datasets: [{
                label: 'Jumlah Stok Darah',
                data: [
                    @foreach ($stok as $item)
                        {{ $item->total_darah }},
                    @endforeach
                ],
                backgroundColor: [
                    '#D81B60', // B
                    '#FF0000', // O
                    '#E53935', // A
                    '#8E24AA' // AB
                ],
                borderColor: '#fff',
                borderWidth: 2
            }]
        };

        const options = {
            responsive: true,
            cutout: '70%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#333',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            let value = context.raw || 0;
                            return `${label}: ${(value / 450).toFixed(2)} kantong`;
                        }
                    }
                }
            },
            animation: {
                animateRotate: true,
                animateScale: true,
                easing: 'easeInOutQuart',
                duration: 1500,
            },
            hover: {
                mode: 'nearest',
                intersect: true,
            }
        };

        const donutChart = new Chart(ctx, {
            type: 'doughnut',
            data: data,
            options: options,
            plugins: [centerText]
        });
    </script>

    <!-- AOS Animate on Scroll -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</section>
