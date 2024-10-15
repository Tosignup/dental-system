@extends('admin.dashboard')
@section('content')
    <style>
        /* Fade-in and Fade-out CSS */
        .validation-message {
            display: none;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .validation-message.show {
            display: block;
            opacity: 1;
        }

        .validation-message.hide {
            opacity: 0;
        }
    </style>
    <div class="m-4">
        @include('components.search')
    </div>
    <section class="bg-white shadow-lg rounded-md max-w-max p-6 my-4 mx-auto max-lg:p-3 max-lg:m-3  max-lg:mt-14">
        <h1 class="font-bold text-5xl px-4 max-md:text-3xl w-max">Add new item</h1>
        <form method="POST" action="{{ route('item.store') }}">
            @method('POST')
            @csrf
            <div class="flex flex-wrap items-start justify-start gap-4 max-md:gap-2 max-w-4xl p-8 max-md:p-2">
                <label class="flex flex-col flex-1 min-w-[45%]" for="item_name">
                    <h1 class="pb-2 max-md:text-sm">Item name</h1>
                    <input
                        class="max-md:text-sm max-md:py-1 max-md:px-2 border flex-grow min-w-max border-gray-400 py-2 px-4 rounded-md"
                        name="item_name" type="text" id="item_name" autocomplete="off" placeholder="Item name"
                        value="{{ old('item_name') }}" oninput="validateInput('item_name')">
                    @error('item_name')
                        <span id="item_name_error"
                            class="validation-message text-red-600 text-xs p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>

                <label class="flex flex-col flex-1 min-w-[45%]" for="quantity">
                    <h1 class="pb-2 max-md:text-sm">Quantity</h1>
                    <input class="max-md:text-sm max-md:py-1 max-md:px-2 border border-gray-400 py-2 px-4 rounded-md"
                        name="quantity" type="number" autocomplete="off" id="quantity" placeholder="Dela Cruz"
                        value="{{ old('quantity') }}" oninput="validateInput('quantity')">
                    @error('quantity')
                        <span id="quantity_error"
                            class="validation-message text-red-600 text-xs p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>

                <label class="flex flex-col flex-1 min-w-[45%]" for="minimum_stock">
                    <h1 class="pb-2 max-md:text-sm">Minimum stock</h1>
                    <input class="max-md:text-sm max-md:py-1 max-md:px-2 border border-gray-400 py-2 px-4 rounded-md"
                        name="minimum_stock" type="number" id="minimum_stock" autocomplete="off"
                        value="{{ old('minimum_stock') }}" oninput="validateInput('minimum_stock')">
                    @error('minimum_stock')
                        <span id="minimum_stock_error"
                            class="validation-message text-red-600 text-xs p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>
                <label class="flex flex-col flex-1 min-w-[45%]" for="maximum_stock">
                    <h1 class="pb-2 max-md:text-sm">Maximum stock</h1>
                    <input class="max-md:text-sm max-md:py-1 max-md:px-2 border border-gray-400 py-2 px-4 rounded-md"
                        name="maximum_stock" type="number" id="maximum_stock" autocomplete="off""
                        oninput="validateInput('maximum_stock')">
                    @error('maximum_stock')
                        <span id="maximum_stock_error"
                            class="validation-message text-red-600 text-xs p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>
                <label class="flex flex-col flex-1 min-w-[45%]" for="purchase_price">
                    <h1 class="pb-2 max-md:text-sm">Purchase price</h1>
                    <input class="max-md:text-sm max-md:py-1 max-md:px-2 border border-gray-400 py-2 px-4 rounded-md"
                        type="number" name="purchase_price" id="purchase_price" oninput="validateInput('purchase_price')">
                    @error('purchase_price')
                        <span id="purchase_price_error"
                            class="validation-message text-red-600 text-xs p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>
                <label class="flex flex-col flex-1 min-w-[45%]" for="selling_price">
                    <h1 class="pb-2 max-md:text-sm">Selling price</h1>
                    <input class="max-md:text-sm max-md:py-1 max-md:px-2 border border-gray-400 py-2 px-4 rounded-md"
                        type="number" name="selling_price" id="selling_price" oninput="validateInput('selling_price')">
                    @error('selling_price')
                        <span id="purchase_price_error"
                            class="validation-message text-red-600 text-xs p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>
                <label class="flex flex-col flex-1 min-w-[45%]" for="discount">
                    <h1 class="pb-2 max-md:text-sm">Discount</h1>
                    <input class="max-md:text-sm max-md:py-1 max-md:px-2 border border-gray-400 py-2 px-4 rounded-md"
                        name="discount" type="number" id="discount" autocomplete="off" value="{{ old('discount') }}"
                        oninput="validateInput('discount')">
                    @error('discount')
                        <span id="discount_error"
                            class="validation-message text-red-600 text-xs p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>
                <label class="flex flex-col flex-1 min-w-[45%]" for="category">
                    <h1 class="pb-2 max-md:text-sm">Category</h1>
                    <input class="max-md:text-sm max-md:py-1 max-md:px-2 border border-gray-400 py-2 px-4 rounded-md"
                        name="category" type="text" id="category" autocomplete="off" value="{{ old('category') }}"
                        oninput="validateInput('category')">
                    @error('category')
                        <span id="category_error"
                            class="validation-message text-red-600 text-xs p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>

                <label class="flex flex-col flex-1 min-w-[45%]" for="availability">
                    <h1 class="pb-2 max-md:text-sm">Availability</h1>
                    <input class="max-md:text-sm max-md:py-1 max-md:px-2 border border-gray-400 py-2 px-4 rounded-md"
                        name="availability" type="text" id="availability" value="{{ old('availability') }}"
                        oninput="validateInput('availability')">
                    @error('availability')
                        <span id="availability_error"
                            class="validation-message text-red-600 text-xs p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>

                <label class="flex flex-col flex-1 min-w-[45%]" for="condition">
                    <h1 class="pb-2 max-md:text-sm">Condition</h1>
                    <input class="max-md:text-sm max-md:py-1 max-md:px-2 border border-gray-400 py-2 px-4 rounded-md"
                        name="condition" type="text" autocomplete="off" id="condition"
                        value="{{ old('condition') }}" oninput="validateInput('condition')">
                    @error('condition')
                        <span id="condition_error"
                            class="validation-message text-red-600 text-xs p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>
                <label class="flex flex-col flex-1 min-w-[45%] " for="branch_id">
                    <h1 class="max-md:text-xs">Select Branch</h1>
                    <select class="border border-gray-400 py-2 px-4 rounded-md max-md:text-xs max-md:py-1 max-md:px-2"
                        id="branch_id" name="branch_id" required>
                        <option class="max-md:text-xs" value="">Select your branch</option>
                        @foreach ($branches as $branch)
                            <option class="max-md:text-xs" value="{{ $branch->id }}">
                                {{ $branch->branch_loc }}
                            </option>
                        @endforeach
                    </select>
                </label>
                <label class="flex flex-col flex-1 min-w-[45%] pb-3" for="notes">
                    <h1>Notes</h1>
                    <textarea class="border max-md:text-xs flex-grow min-w-max border-gray-400 py-2 px-4 rounded-md" id="notes"
                        name="notes" required></textarea>
                </label>
            </div>
            <div class="w-full flex gap-2 px-8 mb-3">
                <button
                    class="flex-1 justify-center items-center py-2 px-8 text-center max-md:py-2 max-md:px-2 max-md:text-xs font-semibold rounded-md hover:bg-green-600 hover:border-green-600 hover:text-white text-gray-800 border-2 border-gray-600 transition-all"
                    type="submit">
                    Add item
                </button>
                <button
                    class="flex-1 justify-center items-center py-2 px-8 text-center max-md:py-2 max-md:px-2 max-md:text-xs font-semibold rounded-md hover:bg-gray-600 border-2 border-gray-600 hover:text-white text-gray-800  transition-all"
                    type="reset">
                    Reset
                </button>
                <a href=" {{ route('inventory') }} "
                    class="flex-1 justify-center items-center py-2 px-8 text-center max-md:py-2 max-md:px-2 max-md:text-xs font-semibold rounded-md hover:bg-red-600 hover:border-red-600 border-2 border-gray-600 text-gray-800  hover:text-white transition-all"
                    type="reset">
                    Cancel
                </a>
            </div>
        </form>
    </section>
    <script>
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('next_visit').setAttribute('min', today);

        function validateInput(field) {
            const input = document.getElementById(field);
            const errorElement = document.getElementById(`${field}_error`);

            // Assuming that the presence of errorElement means the field has an error initially
            if (errorElement) {
                // If the input is valid (e.g., not empty), hide the error message
                if (input.value.trim() !== '') {
                    errorElement.classList.remove('show');
                    errorElement.classList.add('hide');

                    setTimeout(() => {
                        errorElement.style.display = 'none';
                    }, 500);
                } else {
                    // If the input is still invalid, keep the error message visible
                    errorElement.classList.remove('hide');
                    errorElement.classList.add('show');
                }
            }
        }
    </script>
@endsection
