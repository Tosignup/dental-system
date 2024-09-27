@extends('admin.dashboard')

@section('content')
    <style>
        .modal {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Overlay */
        }

        .modal-dialog {
            position: relative;
            margin: auto;
            top: 20%;
            width: 50%;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
        }
    </style>
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
                    <div id="xrayModal" class="modal" style="display:none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
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
            <div class="w-full flex justify-center border border-red-100">
                @if ($image)
                    <div>
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Contract Image" class="img-fluid">
                    </div>
                @else
                    <p>No contract image uploaded for this patient.</p>
                @endif
            </div>

        </div>
    </section>
    <script>
        // Get modal and buttons
        const modal = document.getElementById("xrayModal");
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
    </script>
@endsection
