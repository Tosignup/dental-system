@extends('dentist.dashboard')
@section('content')
    <section class="bg-white shadow-lg rounded-md p-6 my-4 mx-2  max-lg:mt-14">
        <h1 class="font-bold text-3xl p-4">Payments</h1>

        <div class="container">
            @if ($payments->isEmpty())
                <p>No payments found for your appointments.</p>
            @else
                <table class="min-w-full bg-white border text-center">

                    <thead>
                        <tr class="w-full bg-gray-100">

                            <th class="py-1 px-4 border-b text-gray-600 max-lg:text-xs">Date</th>
                            <th class="py-1 px-4 border-b text-gray-600 max-lg:text-xs">Amount</th>
                            <th class="py-1 px-4 border-b text-gray-600 max-lg:text-xs">Balance Remaining</th>
                            <th class="py-1 px-4 border-b text-gray-600 max-lg:text-xs">Status</th>
                            <th class="py-1 px-4 border-b text-gray-600 max-lg:text-xs">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td class="py-1 px-4 border-b max-lg:text-xs">{{ $payment->created_at->format('Y-m-d') }}
                                </td>
                                <td class="py-1 px-4 border-b max-lg:text-xs">
                                    &#8369;{{ number_format($payment->amount_due, 2) }}
                                </td>
                                <td class="py-1 px-4 border-b max-lg:text-xs">{{ ucfirst($payment->balance_remaining) }}
                                </td>
                                <td class="py-1 px-4 border-b max-lg:text-xs">{{ $payment->status }}</td>
                                <td class="py-1 px-4 border-b max-lg:text-xs">
                                    @if ($payment->status === 'Paid')
                                        <a href=" {{ route('dentist.paymentHistory', $payment->appointment->id) }} "
                                            class=" flex items-center justify-center py-1 gap-2 px-4 my-2 border border-gray-500 rounded-md hover:border-gray-700 hover:bg-slate-500 hover:text-slate-200 hover:shadow-sm transition-all max-sm:justify-center"
                                            type="reset">
                                            <img class="h-3" src="{{ asset('assets/images/payment.png') }}"
                                                alt="">
                                            <h1 class="text-xs">
                                                Payment history</h1>
                                        </a>
                                    @else
                                        <a href="{{ route('dentist.paymentForm', $payment->appointment_id) }}"
                                            class=" flex items-center justify-center py-1 gap-2 px-4 my-2 border border-gray-500 rounded-md hover:border-gray-700 hover:bg-green-200 hover:text-green-800 hover:shadow-sm transition-all max-sm:justify-center">
                                            <img class="h-3" src="{{ asset('assets/images/payment.png') }}"
                                                alt="">
                                            <h1 class="text-xs">
                                                Add payment</h1>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination Links -->
            @endif
        </div>



    </section>
@endsection
<script>
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('hidden');
        }
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('hidden');
        }
    }
</script>
