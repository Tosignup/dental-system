@extends('admin.dashboard')
@section('content')
    <div class="m-4">
        @include('components.search')
    </div>
    <section class="flex flex-col gap-2 m-6 rounded-md p-4  bg-white shadow-md max-lg:flex-col  max-lg:mt-14">
        <label class="flex items-center gap-2 max-lg:flex-wrap" for="time">
            <h1 class="font-bold text-3xl mr-4 max-md:text-2xl">Appointment Submissions</h1>

            <div class="">
                <form method="GET" action="{{ route('appointment.submission') }}"
                    class="flex max-lg:text-xs gap-1 items-center max-lg:m-1 ">
                    <h1 class="font-semibold">Sort by: </h1>
                    <select name="sort" class="border text-sm w-auto border-gray-400 pr-6 mx-2 rounded-md max-lg:text-xs"
                        id="sort">
                        <option value="name" {{ request()->get('sort') == 'created_at' ? 'selected' : '' }}>Date Submitted
                        </option>
                        <option value="appointment_date"
                            {{ request()->get('sort') == 'appointment_date' ? 'selected' : '' }}>
                            Appointment Date</option>
                        <option value="branch" {{ request()->get('sort') == 'branch' ? 'selected' : '' }}>Branch</option>
                        <option value="status" {{ request()->get('sort') == 'status' ? 'selected' : '' }}>Status</option>
                    </select>
                </form>

            </div>
        </label>

        <div class="bg-white max-xl:w-full p-4 max-lg:p-2 max-xl:text-xs rounded-lg shadow-md">

            <div class="border-b border-gray-200 mb-4">
                <nav class="flex flex-wrap gap-5 max-lg:gap-2">

                    <button
                        class="text-gray-500 pb-2 border-b-2 border-transparent focus:outline-none hover:border-b-green-300 transition-all"
                        data-tab-target="#walk-in">Walk-in Request</button>
                    <button
                        class="text-gray-500 pb-2 border-b-2 border-transparent focus:outline-none hover:border-b-green-300 transition-all"
                        data-tab-target="#online">Online Request</button>

                </nav>
            </div>
            {{-- Walk-in Contents --}}
            <div id="walk-in" class="tab-content text-gray-700 hidden">
                @include('content.partial.appointment-walkIn-list')
                <div class="w-full mt-2">
                    {{ $walkin_appointments->links() }}
                </div>
            </div>
            {{-- Online Contents --}}
            <div id="online" class="tab-content text-gray-700 hidden">
                @include('content.partial.appointment-online-list')
                <div class="w-full mt-2">
                    {{ $online_appointments->links() }}
                </div>
            </div>

        </div>
    </section>
    <script>
        document.getElementById('sort').addEventListener('change', function() {
            this.form.submit();
            document.getElementById('branch').toUpperCase();

        });


        const tabs = document.querySelectorAll('[data-tab-target]');
        const activeClass = 'border-b-green-600';

        tabs[0].classList.add(activeClass);
        document.querySelector('#walk-in').classList.remove('hidden');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const targetContent = document.querySelector(tab.dataset.tabTarget);

                document.querySelectorAll('.tab-content').forEach(content => content.classList.add(
                    'hidden'));
                targetContent.classList.remove('hidden');

                document.querySelectorAll('.border-b-green-600').forEach(activeTab => activeTab.classList
                    .remove(
                        activeClass));
                tab.classList.add(activeClass);
            })
        });

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
@endsection
