@extends('admin.dashboard')
@section('content')
    @if (session('success'))
        <div id="toast" class="absolute bottom-8 right-8">
            <div class="max-w-xs bg-green-600 text-sm text-white rounded-md shadow-lg dark:bg-gray-900 mb-3 ml-3"
                role="alert">
                <div class="flex p-4">
                    {{ session('success') }} <!-- Display the success message -->

                    <div class="ml-auto px-1">
                        <button type="button"
                            class="inline-flex gap-2 flex-shrink-0 justify-center items-center h-4 w-4 rounded-md text-white/[.5] hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-gray-600 transition-all text-sm dark:focus:ring-offset-gray-900 dark:focus:ring-gray-800"
                            onclick="closeToast()">
                            <span class="sr-only">Close</span>
                            <svg class="w-3.5 h-3.5 self-center" width="16" height="16" viewBox="0 0 16 16"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.92524 0.687069C1.126 0.486219 1.39823 0.373377 1.68209 0.373377C1.96597 0.373377 2.2382 0.486219 2.43894 0.687069L8.10514 6.35813L13.7714 0.687069C13.8701 0.584748 13.9882 0.503105 14.1188 0.446962C14.2494 0.39082 14.3899 0.361248 14.5321 0.360026C14.6742 0.358783 14.8151 0.38589 14.9468 0.439762C15.0782 0.493633 15.1977 0.573197 15.2983 0.673783C15.3987 0.774389 15.4784 0.894026 15.5321 1.02568C15.5859 1.15736 15.6131 1.29845 15.6118 1.44071C15.6105 1.58297 15.5809 1.72357 15.5248 1.85428C15.4688 1.98499 15.3872 2.10324 15.2851 2.20206L9.61883 7.87312L15.2851 13.5441C15.4801 13.7462 15.588 14.0168 15.5854 14.2977C15.5831 14.5787 15.4705 14.8474 15.272 15.046C15.0735 15.2449 14.805 15.3574 14.5244 15.3599C14.2437 15.3623 13.9733 15.2543 13.7714 15.0591L8.10514 9.38812L2.43894 15.0591C2.23704 15.2543 1.96663 15.3623 1.68594 15.3599C1.40526 15.3574 1.13677 15.2449 0.938279 15.046C0.739807 14.8474 0.627232 14.5787 0.624791 14.2977C0.62235 14.0168 0.730236 13.7462 0.92524 13.5441L6.59144 7.87312L0.92524 2.20206C0.724562 2.00115 0.611816 1.72867 0.611816 1.44457C0.611816 1.16047 0.724562 0.887983 0.92524 0.687069Z"
                                    fill="currentColor" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="m-4 mb-8">
        @include('components.search')
    </div>
    <section class=" m-4 p-4 bg-white shadow-lg rounded-md max-lg:mt-14">
        <div class="flex items-center justify-between py-2  max-lg:flex-wrap">
            <label class="flex items-center gap-2" for="time">
                <h1 class="font-bold text-3xl mr-4 max-md:mr-0 max-md:text-2xl">Branch List</h1>
            </label>
            <form method="GET" action="{{ route('branch.add') }}">
                @csrf
                <button
                    class="flex justify-center items-center gap-2  rounded-md py-2 px-4 min-w-max border-2 border-gray-600 hover:shadow-md hover:border-green-700 font-semibold text-gray-800 transition-all max-md:px-2">
                    <span class="max-md:text-xs"> Add Branch</span>
                    <img class="h-8 max-md:h-4" src="{{ asset('assets/images/add.png') }}" alt="">
                </button>
            </form>
        </div>

        <table class="w-full table-auto mb-2 overflow-hidden">
            <thead>
                <tr class="bg-gray-300 text-gray-500">
                    <th class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">Branch Code</th>
                    <th class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">Branch Location</th>
                    <th class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($branches as $branch)
                    <tr class="border-b-2">
                        <td class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">{{ $branch->id }}</td>
                        <td class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">{{ $branch->branch_loc }}</td>
                        <td class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs max-md:flex">
                            <div class="flex gap-2 justify-center flex-wrap items-center">
                                <a class=" border border-slate-600 flex max-md:flex-1 justify-center items-center rounded-md py-2 px-4 max-md:py-1 max-md:px-2 text-white font-semibold hover:bg-gray-300 transition-all"
                                    href="{{ route('branch.edit', $branch->id) }}">
                                    <h1 class=" text-xs text-gray-700 text-center">Edit</h1>
                                </a>

                                <div class="flex max-md:flex-1  self-start max-md:text-xs ">
                                    <div
                                        class=" border border-slate-600 flex max-md:flex-1 justify-center items-center rounded-md py-2 px-4 max-md:py-1 max-md:px-2 text-white font-semibold hover:bg-gray-300 transition-all">
                                        <button class="  text-xs text-gray-700 text-center"
                                            onclick="document.getElementById('delete_modal_{{ $branch->id }}').showModal()">Delete</button>
                                    </div>
                                    <dialog id="delete_modal_{{ $branch->id }}"
                                        class="modal p-4 rounded-md max-md:text-lg">
                                        <div class="modal-box flex flex-col">
                                            <h3 class="text-lg font-bold max-md:text-sm text-left">Branch</h3>
                                            <p class="py-4 max-md:text-sm mb-4">Are you sure you want to delete this item?
                                            </p>
                                            <div class="modal-action flex gap-2 self-end">
                                                <form method="dialog"
                                                    class="border rounded-md hover:bg-gray-300 transition-all py-2 px-4">
                                                    <button class="btn max-md:text-xs">Close</button>
                                                </form>
                                                <form method="POST" action="{{ route('branch.delete', $branch->id) }}"
                                                    class="border rounded-md bg-red-500 hover:bg-red-700 text-white transition-all py-2 px-4">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn max-md:text-xs">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </dialog>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    <script>
        document.querySelectorAll('[id^="delete_modal_"]').forEach((modal) => {
            if (modal) {
                const modalId = modal.id;
                const button = document.querySelector(
                    `[onclick="document.getElementById('${modalId}').showModal()"]`);

                if (button) {
                    button.addEventListener('click', () => {
                        modal.showModal();
                    });
                }
            }
        });
        setTimeout(() => {
            const toast = document.getElementById('toast');
            if (toast) {
                toast.style.display = 'none';
            }
        }, 3000);


        function closeToast() {
            const toast = document.getElementById('toast');
            if (toast) {
                toast.style.display = 'none';
            }
        }
    </script>
@endsection
