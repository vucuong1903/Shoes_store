<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .highlighted-chart-container {
        background-color: #f5f5f5; /* Màu nền nhẹ */
        padding: 20px;             /* Khoảng cách xung quanh biểu đồ */
        margin: 20px 0;            /* Khoảng cách giữa các biểu đồ */
        border-radius: 8px;        /* Góc bo tròn */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.6); /* Hiệu ứng bóng đổ */
    }
</style>


</head>

<body>
    @extends('layouts.admin')

    @section('title', 'Báo cáo')

    @section('content')
    <div class="container">
        <h1 class="text-center mb-4">Báo cáo doanh thu</h1>
        <div class="mt-4">
            <h4 class="font-weight-bold">Tổng số đơn hàng: <span class="text-success">{{ $totalOrders }}</span></h4>
            <h4 class="font-weight-bold">Tổng số khách hàng: <span class="text-success">{{ $totalCustomers }}</span></h4>
        </div>

        <h3 class="mt-5 font-weight-bold text-center">Doanh thu theo từng danh mục</h3>
        <div class="chart-container highlighted-chart-container" style=" position: relative; height:100vh; width:100%; margin: auto;">
            <canvas id="categoryRevenueChart"></canvas>
        </div>

        <h3 class="mt-5 font-weight-bold text-center">Doanh thu theo ngày</h3>
        <div class="chart-container highlighted-chart-container" style=" position: relative; height:100vh; width:100%; margin: auto;">
            <canvas id="revenueByDateChart"></canvas>
        </div>

        <h3 class="mt-5 font-weight-bold text-center">Doanh thu theo tháng</h3>
        <div class="chart-container highlighted-chart-container" style=" position: relative; height:100vh; width:100%; margin: auto;">
            <canvas id="revenueByMonthChart"></canvas>
        </div>

        <h3 class="mt-5 font-weight-bold text-center">Doanh thu theo năm</h3>
        <div class="chart-container highlighted-chart-container" style=" position: relative; height:100vh; width:100%; margin: auto;">
            <canvas id="revenueByYearChart"></canvas>
        </div>

        <h3 class="mt-5 font-weight-bold text-center">Doanh thu theo phương thức thanh toán</h3>
        <div class="chart-container highlighted-chart-container" style=" position: relative; height:80vh; width:100%; margin: auto;">
            <canvas id="revenueByPaymentMethodChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Biểu đồ doanh thu theo từng danh mục (Bar chart)
            var categoryLabels = @json($categoryRevenue->pluck('category_id'));
            var categoryData = @json($categoryRevenue->pluck('total_revenue'));

            var ctx1 = document.getElementById('categoryRevenueChart').getContext('2d');
            var categoryRevenueChart = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: categoryLabels,
                    datasets: [{
                        label: 'Doanh thu',
                        data: categoryData,
                        backgroundColor: 'rgba(54, 162, 235, 0.9)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: 'black', // Màu chữ trên trục y
                                font: {
                                    size: 16, // Kích thước chữ trên trục y
                                    weight: 'bold', // Đặt chữ thành đậm
                                    family: 'Roboto', // Sử dụng font chữ mới

                                }
                            }
                        }
                    }
                }
            });

            // 2. Biểu đồ doanh thu theo ngày (Line chart)
            var dateLabels = @json($revenueByDate->pluck('date'));
            var dateData = @json($revenueByDate->pluck('total_revenue'));

            var ctx2 = document.getElementById('revenueByDateChart').getContext('2d');
            var revenueByDateChart = new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: dateLabels,
                    datasets: [{
                        label: 'Doanh thu theo ngày',
                        data: dateData,
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        fill: true
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: 'black', // Màu chữ trên trục y
                                font: {
                                    size: 16, // Kích thước chữ trên trục y
                                    weight: 'bold', // Đặt chữ thành đậm
                                    family: 'Roboto', // Sử dụng font chữ mới

                                }
                            }
                        }
                    }
                }
            });

            // 3. Biểu đồ doanh thu theo tháng (Bar chart)
            var monthLabels = @json($revenueByMonth->pluck('month'));
            var monthData = @json($revenueByMonth->pluck('total_revenue'));

            var ctx3 = document.getElementById('revenueByMonthChart').getContext('2d');
            var revenueByMonthChart = new Chart(ctx3, {
                type: 'bar',
                data: {
                    labels: monthLabels,
                    datasets: [{
                        label: 'Doanh thu theo tháng',
                        data: monthData,
                        backgroundColor: 'rgba(153, 102, 255, 0.9)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: 'black', // Màu chữ trên trục y
                                font: {
                                    size: 16, // Kích thước chữ trên trục y
                                    weight: 'bold', // Đặt chữ thành đậm
                                    family: 'Roboto', // Sử dụng font chữ mới

                                }
                            }
                        }
                    }
                }
            });

            // 4. Biểu đồ doanh thu theo năm (Bar chart)
            var yearLabels = @json($revenueByYear->pluck('year'));
            var yearData = @json($revenueByYear->pluck('total_revenue'));

            var ctx4 = document.getElementById('revenueByYearChart').getContext('2d');
            var revenueByYearChart = new Chart(ctx4, {
                type: 'bar',
                data: {
                    labels: yearLabels,
                    datasets: [{
                        label: 'Doanh thu theo năm',
                        data: yearData,
                        backgroundColor: 'rgba(255, 159, 64, 0.9)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: 'black', // Màu chữ trên trục y
                                font: {
                                    size: 16, // Kích thước chữ trên trục y
                                    weight: 'bold', // Đặt chữ thành đậm
                                    family: 'Roboto', // Sử dụng font chữ mới

                                }
                            }
                        }
                    }
                }
            });

            // 5. Biểu đồ doanh thu theo phương thức thanh toán (Pie chart)
            var paymentMethodLabels = @json($revenueByPaymentMethod->pluck('payment_method'));
            var paymentMethodData = @json($revenueByPaymentMethod->pluck('total_revenue'));

            var ctx5 = document.getElementById('revenueByPaymentMethodChart').getContext('2d');
            var revenueByPaymentMethodChart = new Chart(ctx5, {
                type: 'pie',
                data: {
                    labels: paymentMethodLabels,
                    datasets: [{
                        label: 'Doanh thu theo phương thức thanh toán',
                        data: paymentMethodData,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 206, 86, 0.8)',
                            'rgba(75, 192, 192, 0.8)',
                            'rgba(153, 102, 255, 0.8)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.label + ': ' + new Intl.NumberFormat().format(context.raw) + ' VND';
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
    @endsection

</body>

</html>