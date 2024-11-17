@extends('admin.dashboard')
@section('content')
    <div class="m-4">
        @include('components.search')
    </div>
    <section class=" m-4 max-lg:mt-14 px-4 pb-4 bg-white shadow-lg rounded-md">
        <h1 class="font-bold text-3xl max-md:text-xl py-4">Sales Report</h1>
        <div class="mb-4">
            <div class="flex-1 min-w-[200px]">
                <label for="branch" class="block text-sm font-medium text-gray-700 mb-1">Select Branch</label>
                <select id="branch" name="branch" class="form-select w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
                    <option value="">All Branches</option>
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}" {{ request('branch') == $branch->id ? 'selected' : '' }}>
                            {{ $branch->branch_loc }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div>
            <div class="w-full flex flex-wrap gap-3 justify-around p-4 ">
                <div
                    class="w-[30%] flex flex-1 flex-col gap-5 justify-center items-start px-4 py-4 bg-green-200 rounded-2xl max-md:w-full">
                    <h2 class="font-semibold">Weekly Revenue</h2>
                    <div class="w-full h-32">
                        <canvas id="weeklyRevenueChart"></canvas>
                    </div>
                </div>
                <div
                    class="w-[30%] flex flex-1 flex-col gap-5 justify-center items-start px-4 py-4 bg-green-200 rounded-2xl max-md:w-full">
                    <h2 class="font-semibold">Monthly Revenue</h2>
                    <div class="w-full h-32">
                        <canvas id="monthlyRevenueChart"></canvas>
                    </div>
                </div>
                <div
                    class="w-[30%] flex flex-1 flex-col gap-5 justify-center items-start px-4 py-4 bg-green-200 rounded-2xl max-md:w-full">
                    <h2 class="font-semibold">Total Revenue</h2>
                    <div class="w-full h-32">
                        <canvas id="totalRevenueChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full max-h-96 flex max-lg:flex-wrap gap-5 py-3 px-5 max-lg:max-h-full">

            <div class="w-[70%] flex-1 max-lg:w-full max-xl:w-[50%]">
                <h2 class="font-bold text-lg max-md:text-md py-2 pl-1">Recent Payments</h2>
                <div class="overflow-auto max-h-72">
                    <table class="min-w-full table-auto text-center">
                        <thead class="bg-green-200 text-green-700">
                            <tr class="border-b">
                                <th class="px-4 py-2 border max-xl:text-sm">Patient</th>
                                <th class="px-4 py-2 border max-xl:text-sm">Paid Amount</th>
                                <th class="px-4 py-2 border max-xl:hidden">Payment Method</th>
                                <th class="px-4 py-2 border max-xl:hidden">Branch</th>
                                <th class="px-4 py-2 border max-xl:text-sm">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paymentHistories as $history)
                                <tr class="hover:bg-gray-100 border-b-2">
                                    <td class="px-4 py-2 max-xl:text-xs ">
                                        {{ $history->payment->appointment->patient->first_name }}
                                        {{ $history->payment->appointment->patient->last_name }}</td>
                                    <td class="px-4 py-2 max-xl:text-xs ">&#8369;
                                        {{ number_format($history->paid_amount, 2) }}</td>
                                        <td class="px-4 py-2  max-xl:hidden">{{ $history->payment_method }}</td>
                                        <td class="px-4 py-2  max-xl:hidden">{{ $history->payment->appointment->branch->branch_loc }}</td>
                                    <td class="px-4 py-2 max-xl:text-xs ">{{ $history->created_at->format('Y-m-d H:i') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div
                class="w-[25%] flex-2 max-lg:w-full max-xl:w-[50%]  max-md:border-blue-600 max-lg:border-green-500 max-xl:border-violet-500">
                <h2 class="font-bold text-center text-lg max-md:text-md py-2 pl-1">Top Procedures</h2>
                <table class="min-w-full table-auto text-center">
                    <thead>
                        <tr class="bg-green-200 text-green-700">
                            <th class="px-4 py-2 max-md:text-xs">Procedure</th>
                            <th class="px-4 py-2 max-md:text-xs">Count</th>
                            <th class="px-4 py-2 max-md:text-xs max-lg:hidden">Total Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($frequentlyPerformedProcedures as $procedure)
                            <tr class=" border-b-2 last:border-b-0">
                                <td class="px-3 py-2 text-sm max-md:text-sm">{{ $procedure['procedure'] }}</td>
                                <td class="px-3 py-2 text-sm max-md:text-sm">{{ $procedure['count'] }}</td>
                                <td class="px-3 py-2 text-sm max-md:text-sm max-lg:hidden">&#8369;
                                    {{ number_format($procedure['total_amount'], 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="w-full flex justify-end p-4 border-t">
            <div class="text-right">
                <span class="text-gray-600">Total Revenue:</span>
                <span class="font-bold text-xl ml-2">₱{{ number_format($totalRevenue, 2) }}</span>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const branchSelect = document.getElementById('branch');

            branchSelect.addEventListener('change', function() {
                const branch = this.value;
                window.location.href = `{{ route('sales') }}?branch=${branch}`;
            });

            // Weekly Revenue Chart
            const weeklyCtx = document.getElementById('weeklyRevenueChart').getContext('2d');
            new Chart(weeklyCtx, {
                type: 'bar',
                data: {
                    labels: ['This Week', 'Last Week'],
                    datasets: [{
                        label: 'Revenue',
                        data: [{{ $weeklyComparisonData['This Week'] }}, {{ $weeklyComparisonData['Last Week'] }}],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value, index, values) {
                                    return '₱' + value.toLocaleString();
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return '₱' + context.raw.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });

            const monthly = document.getElementById('monthlyRevenueChart').getContext('2d');
            const monthlyRevenueData = @json($monthlyRevenueData);

            const monthlyLabels = Object.keys(monthlyRevenueData);
            const monthlyData = Object.values(monthlyRevenueData);

            const monthlyRevenueChart = new Chart(monthly, {
                type: 'bar',
                data: {
                    labels: monthlyLabels,
                    datasets: [{
                        label: 'Monthly Revenue',
                        data: monthlyData,
                        backgroundColor: monthlyLabels.map(() => 'rgba(75, 192, 192, 0.2)'),
                        borderColor: monthlyLabels.map(() => 'rgba(75, 192, 192, 1)'),
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value, index, values) {
                                    return '₱' + value.toLocaleString();
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return '₱' + context.raw.toLocaleString();
                                }
                            }
                        },
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    }
                }
            });

            const totalRevenue = document.getElementById('totalRevenueChart').getContext('2d');
            const comparisonData = @json($comparisonData);

            const totalLabel = Object.keys(comparisonData);
            const totalData = Object.values(comparisonData);

            const totalRevenueChart = new Chart(totalRevenue, {
                type: 'bar',
                data: {
                    labels: totalLabel,
                    datasets: [{
                        label: 'Revenue by Branch',
                        data: totalData,
                        backgroundColor: totalLabel.map(() => 'rgba(75, 192, 192, 0.2)'),
                        borderColor: totalLabel.map(() => 'rgba(75, 192, 192, 1)'),
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value, index, values) {
                                    return '₱' + value.toLocaleString();
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return '₱' + context.raw.toLocaleString();
                                }
                            }
                        },
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    }
                }
            });
        });
    </script>
@endsection
