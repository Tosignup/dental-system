<!-- resources/views/admin/content/add-payment.blade.php -->

@extends('admin.dashboard')

@section('content')
    <div class="m-8 bg-white rounded-md p-4 shadow-lg max-w-4xl">
        <h1 class="font-bold text-3xl mb-4 max-md:text-2xl">Add Payment for {{ $patient->first_name }}
            {{ $patient->last_name }}</h1>
        <form method="POST" action="{{ route('store.payment', $patient->id) }}">
            @method('POST')
            @csrf
            <div class="flex flex-wrap gap-4">
                <label for="tooth_number" class="flex flex-col max-md:text-sm">
                    <span>Tooth Number</span>
                    <input type="text" name="tooth_number" id="tooth_number"
                        class="border border-gray-400 py-2 px-4 max-md:py-2 max-md:px-2 rounded-md" required>
                </label>
                <label for="dentist" class="flex flex-col max-md:text-sm">
                    <span>Dentist</span>
                    <input type="text" name="dentist" id="dentist"
                        class="border border-gray-400 py-2 px-4 max-md:py-2 max-md:px-2 rounded-md" required>
                </label>
                <label for="procedure" class="flex flex-col max-md:text-sm">
                    <span>Procedure</span>
                    <input type="text" name="procedure" id="procedure"
                        class="border border-gray-400 py-2 px-4 max-md:py-2 max-md:px-2 rounded-md" required>
                </label>
                <label for="charge" class="flex flex-col max-md:text-sm">
                    <span>Charge</span>
                    <input type="number" name="charge" id="charge"
                        class="border border-gray-400 py-2 px-4 max-md:py-2 max-md:px-2 rounded-md" required>
                </label>
                <label for="paid" class="flex flex-col max-md:text-sm">
                    <span>Paid</span>
                    <input type="number" name="paid" id="paid"
                        class="border border-gray-400 py-2 px-4 max-md:py-2 max-md:px-2 rounded-md" required>
                </label>
                <label for="balance_remaining" class="flex flex-col max-md:text-sm">
                    <span>Balance Remaining</span>
                    <input type="number" name="balance_remaining" id="balance_remaining"
                        class="border border-gray-400 py-2 px-4 max-md:py-2 max-md:px-2 rounded-md" required>
                </label>
                <label for="remarks" class="flex flex-col w-full max-md:text-sm">
                    <span>Remarks</span>
                    <textarea name="remarks" id="remarks" class="border border-gray-400 py-2 px-4 max-md:py-2 max-md:px-2 rounded-md"></textarea>
                </label>
                <label for="signature" class="flex flex-col max-md:text-sm">
                    <span>Signature</span>
                    <select name="signature" id="signature"
                        class="border border-gray-400 py-2 px-4 max-md:py-2 max-md:px-2 rounded-md max-md:text-sm">
                        <option value="1">Signed</option>
                        <option value="0">Not Signed</option>
                    </select>
                </label>
                <label for="payment_date" class="flex flex-col max-md:text-sm">
                    <span>Payment Date</span>
                    <input type="date" name="payment_date" id="payment_date"
                        class="border border-gray-400 py-2 px-4 max-md:py-2 max-md:px-2 rounded-md max-md:text-sm" required>
                </label>
            </div>
            <button type="submit"
                class="mt-4 py-2 px-4 max-md:py-2 max-md:px-2 max-md:text-sm hover:bg-green-600 border-2 border-green-600 hover:text-white rounded-md transition-all">Add
                Payment</button>
            <a href="{{ route('show.patient', $patient->id) }}" type="submit"
                class="mt-4 py-2 px-4 max-md:py-2 max-md:px-2 max-md:text-sm hover:bg-red-600 border-2 border-red-600 hover:text-white rounded-md transition-all">
                Cancel</a>
        </form>
    </div>
@endsection
