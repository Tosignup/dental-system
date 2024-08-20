@extends('admin.dashboard')
@section('content')
<section class="m-4 p-4 bg-white shadow-lg rounded-md">
    <h1 class="font-bold text-3xl mr-4">Payment History of {{$payment->procedure}}</h1>
    <div class="flex flex-row my-4">
        <a class=" flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all"
                    href=" {{ route('show.patient', $patient->id) }} ">
                    <img class="h-5" src="{{ asset('assets/images/arrow-back.png') }}" alt="">
                    <h1>Return</h1>
                </a>
    </div>
    <div class="bg-gray-300 border rounded-md p-4 my-4">
            <h1 class="text-xl font-bold my-2">Payment Summary</h1>
            <table class="w-full table-auto text-center ">
                <thead>
                    <tr>
                        <th class="border-2 border-black px-4 py-2">Tooth Number</th>
                        <th class="border-2 border-black px-4 py-2">Dentist</th>
                        <th class="border-2 border-black px-4 py-2">Procedure</th>
                        <th class="border-2 border-black px-4 py-2">Charge</th>
                        <th class="border-2 border-black px-4 py-2">Paid</th>
                        <th class="border-2 border-black px-4 py-2">Balance Remaining</th>
                        <th class="border-2 border-black px-4 py-2 max-w-sm">Remarks</th>
                        <th class="border-2 border-black px-4 py-2">Signature</th>
                        <th class="border-2 border-black px-4 py-2">Payment Date</th>
                        <th class="border-2 border-black px-4 py-2">Actions</th>
                        <th class="border-2 border-black px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-black px-4 py-2">{{ $payment->tooth_number }}</td>
                        <td class="border border-black px-4 py-2">{{ $payment->dentist }}</td>
                        <td class="border border-black px-4 py-2">{{ $payment->procedure }}</td>
                        <td class="border border-black px-4 py-2">{{ $payment->charge }}</td>
                        <td class="border border-black px-4 py-2">{{ $payment->paid }}</td>
                        <td class="border border-black px-4 py-2">{{ $payment->balance_remaining }}</td>
                        <td class="border border-black px-4 py-2 max-w-sm">{{ $payment->remarks }}</td>
                        <td class="border border-black px-4 py-2">{{ $payment->signature ? 'Signed' : 'Not Signed' }}</td>
                        <td class="border border-black px-4 py-2">{{ $payment->payment_date }}</td>
                        <td class="border border-black px-4 py-2">
                            @if ($payment->balance_remaining > 0)
                                <a class="flex gap-2 items-center justify-center"
                                    href="{{ route('edit.payment', [$patient->id, $payment->id]) }}">
                                    <img class="h-8" src="{{ asset('assets/images/update-payment.png') }}"
                                        alt="">
                                    <h1 class="text-md">Update</h1>
                                </a>
                            
                            @else
                                <button disabled
                                    class="flex gap-2 items-center justify-center opacity-35"
                                    href="{{ route('update.payment', [$patient->id, $payment->id]) }}">
                                    <img class="h-8" src="{{ asset('assets/images/update-payment.png') }}"
                                        alt="">
                                    <h1 class="text-md">Update</h1>
                                </button>
                                
                            @endif
                        </td>
                        <td class="border border-black px-4 py-2 min-w-max">
                            @if ($payment->balance_remaining > 0)
                                <h1 class="text-md ">On going</h1>
                            @else
                                <h1 class="text-md text-green-600 font-semibold">Done</h1>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
    </div>
    <div class="bg-white border rounded-md p-4">
        <h1 class="text-xl font-bold my-2">Current Payment</h1>
        
            @if ($payment->histories->isEmpty())
                <p>No payments history yet.</p>
            @else
                <table class="w-full table-auto text-center">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">Paid</th>
                            <th class="border px-4 py-2">Balance Remaining</th>
                            <th class="border px-4 py-2 max-w-sm">Remarks</th>
                            <th class="border px-4 py-2">Signature</th>
                            <th class="border px-4 py-2">Update Payment</th>
                        </tr>
                    </thead>
                    <tbody>                        
                        @foreach($payment->histories as $history)
                            <tr>
                                <td class="border px-4 py-2">{{ $history->paid }}</td>
                                <td class="border px-4 py-2">{{ $history->balance_remaining }}</td>
                                <td class="border px-4 py-2">{{ $history->remarks }}</td>
                                <td class="border px-4 py-2">{{ $payment->signature ? 'Signed' : 'Not Signed' }}</td>
                                <td class="border px-4 py-2">{{ $history->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
    </div>
</section>
@endsection