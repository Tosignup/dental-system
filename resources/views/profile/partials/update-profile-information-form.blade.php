<section class="w-full flex flex-col py-2 px-4">
    <header>
        <h2 class="text-lg text-white font-semibold ">
            Profile Information
        </h2>

        <p class="mt-1 text-white text-sm ">
            Update your account's profile information and email address.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update', $user->id) }}" class="mt-2 space-y-6">
        @method('put')
        @csrf
        <label class="flex flex-col flex-1 max-md:text-sm" for="username">
            <h1 class="mb-1 text-white ">Username</h1>
            <input class="border border-gray-400 py-2 px-4 rounded-md max-md:text-sm" name="username" type="text"
                id="username" value="{{ old('username', $user->username) }}" autocomplete="off"
                oninput="validateInput('username')">
            @error('username')
                <span id="username_error"
                    class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
            @enderror
        </label>
        <div>
            <label class="flex flex-col flex-1 max-md:text-sm" for="email">
                <h1 class="mb-1 text-white ">Email</h1>
                <input class="border border-gray-400 py-2 px-4 rounded-md max-md:text-sm" name="email" type="email"
                    id="email" value="{{ old('email', $user->email) }}" autocomplete="off"
                    oninput="validateInput('email')">
                @error('email')
                    <span id="email_error"
                        class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                @enderror
            </label>
            <div>
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification"
                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="flex justify-end items-center">
            <button
                class="py-2 px-8 font-semibold rounded-md text-white bg-slate-600 hover:bg-green-600 hover:text-white  transition-all
                        max-md:flex max-md:justify-center max-md:items-center max-md:py-1 max-md:text-center max-md:px-2 max-md:text-sm"
                type="submit">
                Update
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Updated.') }}</p>
            @endif
        </div>
    </form>
</section>
