@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 px-32 py-4 max-lg:px-16 max-md:px-8">
        <section>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <a href="{{ route('show.patient', $patient->id) }}"
                        class="flex items-center gap-2 py-1 px-4 font-semibold border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all">
                        <img class="h-4" src="{{ asset('assets/images/back-arrow.png') }}" alt="">
                        <h1>Back</h1>
                    </a>
                </div>
            </div>
        </section>

        <section class="max-lg:mt-12">
            <h1 class="text-3xl font-bold mb-6">HMO Information</h1>
            <form method="POST" action="{{ route('update.patient', $patient->id) }}">
                @method('PUT')
                @csrf
                <div class="flex flex-col items-center">
                    <div class="grid grid-cols-2 gap-4 w-full px-8 max-md:grid-cols-1">
                        <!-- HMO Company -->
                        <label class="flex flex-col flex-1 min-w-[45%] max-md:text-sm" for="hmo_company">
                            <h1>HMO Company</h1>
                            <select id="hmo_company" name="hmo_company" onchange="toggleOtherHmoField()"
                                class="border border-gray-400 py-2 px-4 rounded-md max-md:text-xs max-md:py-1 max-md:px-2">
                                <option value="">Select HMO</option>
                                <option value="Maxicare" {{ $patient->hmo_company == 'Maxicare' ? 'selected' : '' }}>Maxicare</option>
                                <option value="PhilHealth" {{ $patient->hmo_company == 'PhilHealth' ? 'selected' : '' }}>PhilHealth</option>
                                <option value="Medicard" {{ $patient->hmo_company == 'Medicard' ? 'selected' : '' }}>Medicard</option>
                                <option value="Intellicare" {{ $patient->hmo_company == 'Intellicare' ? 'selected' : '' }}>Intellicare</option>
                                <option value="other" {{ !in_array($patient->hmo_company, ['Maxicare', 'PhilHealth', 'Medicard', 'Intellicare']) ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('hmo_company')
                                <span class="validation-message text-red-600 text-xs p-1 rounded-md show">{{ $message }}</span>
                            @enderror
                        </label>

                        <!-- Other HMO Field -->
                        <div id="otherHmo" class="flex flex-col flex-1" style="{{ !in_array($patient->hmo_company, ['Maxicare', 'PhilHealth', 'Medicard', 'Intellicare']) ? '' : 'display:none;' }}">
                            <label for="other_hmo_name">
                                <h1 class="max-md:text-sm">Other HMO Company Name</h1>
                            </label>
                            <input type="text" id="other_hmo_name" name="other_hmo_name"
                                class="border border-gray-400 py-2 px-4 rounded-md max-md:text-xs max-md:py-1 max-md:px-2"
                                value="{{ !in_array($patient->hmo_company, ['Maxicare', 'PhilHealth', 'Medicard', 'Intellicare']) ? $patient->hmo_company : '' }}">
                        </div>

                        <!-- HMO Number -->
                        <label class="flex flex-col flex-1">
                            <h1 class="max-md:text-sm">HMO Number</h1>
                            <input type="text" name="hmo_number" value="{{ $patient->hmo_number }}"
                                class="border border-gray-400 py-2 px-4 rounded-md max-md:text-xs max-md:py-1 max-md:px-2">
                            @error('hmo_number')
                                <span class="validation-message text-red-600 text-xs p-1 rounded-md show">{{ $message }}</span>
                            @enderror
                        </label>

                        <!-- HMO Type -->
                        <label class="flex flex-col flex-1">
                            <h1 class="max-md:text-sm">HMO Type</h1>
                            <input type="text" name="hmo_type" value="{{ $patient->hmo_type }}"
                                class="border border-gray-400 py-2 px-4 rounded-md max-md:text-xs max-md:py-1 max-md:px-2">
                            @error('hmo_type')
                                <span class="validation-message text-red-600 text-xs p-1 rounded-md show">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>

                    <!-- Action Buttons -->
                    <div class="w-full flex gap-2 px-8 mb-3 mt-8">
                        <button type="submit"
                            class="flex-1 justify-center items-center py-2 px-8 text-center max-md:py-2 max-md:px-2 max-md:text-xs font-semibold rounded-md hover:bg-green-600 hover:border-green-600 hover:text-white text-gray-800 border-2 border-gray-600 transition-all">
                            Update
                        </button>
                        <button type="reset"
                            class="flex-1 justify-center items-center py-2 px-8 text-center max-md:py-2 max-md:px-2 max-md:text-xs font-semibold rounded-md hover:bg-gray-600 border-2 border-gray-600 hover:text-white text-gray-800 transition-all">
                            Reset
                        </button>
                        <a href="{{ route('show.patient', $patient->id) }}"
                            class="flex-1 justify-center items-center py-2 px-8 text-center max-md:py-2 max-md:px-2 max-md:text-xs font-semibold rounded-md hover:bg-red-600 hover:border-red-600 border-2 border-gray-600 text-gray-800 hover:text-white transition-all">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </section>
    </div>

    <script>
        function toggleOtherHmoField() {
            const hmoSelect = document.getElementById('hmo_company');
            const otherHmoDiv = document.getElementById('otherHmo');
            const otherHmoInput = document.getElementById('other_hmo_name');

            if (hmoSelect.value === 'other') {
                otherHmoDiv.style.display = 'block';
                otherHmoInput.focus();
            } else {
                otherHmoDiv.style.display = 'none';
                otherHmoInput.value = '';
            }
        }
    </script>
@endsection
