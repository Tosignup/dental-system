@extends('admin.dashboard')

@section('content')
    <style>
        .upload-modal {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            /* Overlay */
        }

        .upload-modal-dialog {
            position: relative;
            margin: auto;
            top: 20%;
            width: 50%;
        }

        .upload-modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
        }

        .image-modal {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            display: flex;
            justify-content: center;
            overflow-y: auto;
            background-size: contain;
            /* Overlay */
        }
    </style>
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
    <div class="m-4">
        @include('components.search')
    </div>
    <section class="bg-white m-4 p-8 max-lg:mt-12 shadow-lg rounded-md flex flex-col justify-center z-0">
        <div class="flex flex-col justify-between items-start ">
            <div class="w-full flex justify-between gap-4 my-2">
                <a class=" flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md max-lg:hidden hover:border-gray-700 hover:shadow-sm transition-all"
                    href=" {{ route('show.patient', $patient->id) }} ">
                    <img class="h-4" src="{{ asset('assets/images/arrow-back.png') }}" alt="">
                    <h1 class="text-sm">
                        Return to patient information</h1>
                </a>
                <div class="flex self-start text-sm max-md:text-xs">
                    <div
                        class=" flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all">
                        <button id="openModalBtn" class="btn flex items-center justify-start gap-2">
                            <img class="h-4" src="{{ asset('assets/images/add.png') }}" alt="">
                            <h3>Upload Image</h3>
                        </button>
                    </div>
                    {{-- Aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa --}}
                    <!-- Modal Structure -->
                    <div id="uploadModal" class="upload-modal" style="display:none;">
                        <div class="upload-modal-dialog">
                            <div class="upload-modal-content">
                                <div class="modal-header flex justify-between">
                                    <h5 class="modal-title text-2xl font-bold max-md:text-sm">Upload Image</h5>
                                    <button type="button" class="close text-3xl" id="closeModalBtn">&times;</button>
                                </div>
                                <form id="uploadForm" action="{{ route('upload.image') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                                    <div class="modal-body p-4 m-4 border">
                                        <label for="image">Choose Image:</label>
                                        <input type="file" id="image" name="image" accept="image/*" required>
                                    </div>
                                    <div>
                                        <label for="image_type">Image Type:</label>
                                        <select id="image_type" name="image_type" required>
                                            <option value="xray">X-ray</option>
                                            <option value="background">Background</option>
                                            <option value="contract">Contract</option>
                                            <option value="profile_picture">Profile Picture</option>
                                            <option value="proof_of_payment">Proof of Payment</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer flex justify-end">
                                        <button type="button"
                                            class="btn border bg-gray-600 text-white rounded-md py-2 px-4"
                                            id="closeModalFooterBtn">Close</button>
                                        <button type="submit"
                                            class="btn border bg-green-600 text-white rounded-md py-2 px-4">Upload</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa --}}

                </div>
            </div>
            <h1 class="text-4xl font-bold mt-2 mb-6">
                Contract images:
            </h1>
            <div class="w-full flex justify-start">
                @if ($contractImages->isEmpty())
                    <p>No contract images uploaded for this patient.</p>
                @else
                    <div class="flex gap-1">
                        @foreach ($contractImages as $image)
                            <div class="m-2">
                                <h1>{{ $image->created_at }}</h1>
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="Contract Image"
                                    class="img-fluid max-h-80"
                                    onclick="openModal('{{ asset('storage/' . $image->image_path) }}')">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div id="imageModal" class="image-modal hidden">
                <div class=" p-4 rounded">
                    <span id="closeModal"
                        class="fixed right-5 cursor-pointer text-3xl text-white bg-green-500 rounded-full px-2">&times;</span>
                    <img id="modalImage" src="" alt="Modal Image" class="img-fluid max-h-screen">
                </div>
            </div>

        </div>
    </section>
    <script>
        // Get modal and buttons
        const modal = document.getElementById("uploadModal");
        const openModalBtn = document.getElementById("openModalBtn");
        const closeModalBtn = document.getElementById("closeModalBtn");
        const closeModalFooterBtn = document.getElementById("closeModalFooterBtn");

        // Function to open the modal
        openModalBtn.addEventListener("click", function() {
            modal.style.display = "block";
        });

        // Function to close the modal
        closeModalBtn.addEventListener("click", function() {
            modal.style.display = "none";
        });

        closeModalFooterBtn.addEventListener("click", function() {
            modal.style.display = "none";
        });

        // Close the modal if the user clicks outside of it
        window.addEventListener("click", function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });

        function openModal(imageSrc) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            modalImage.src = imageSrc;
            modal.classList.remove('hidden');
        }

        document.getElementById('closeModal').onclick = function() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
        }


        window.onclick = function(event) {
            const modal = document.getElementById('imageModal');
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        }

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
