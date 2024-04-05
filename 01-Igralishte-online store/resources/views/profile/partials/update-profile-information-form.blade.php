<section>
    <header>
        <h2 class="text-lg font-semibold text-gray-900">
            {{ __('Мој профил') }}
        </h2>
    </header>
    <form method="post" action="{{ route('profile.update') }}" class="mt-4 space-y-4" accept-charset="UTF-8" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div>
            <div class="w-[85px] h-[85px] rounded-full overflow-hidden" id="profileImageWrapper">
                <img src="{{$user->image_url}}" alt="user image" class="w-full h-full object-cover">
            </div>
            <label class="text-[#8A8328] underline font-medium inline-block mt-1" for="profile_img">Промени слика</label>
            <input type="file" name="profile_img" id="profile_img" hidden accept="image/*">
            <x-input-error class="mt-2" :messages="$errors->get('main_img')" />

        </div>
        <div>
            <x-input-label for="name" :value="__('Име')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->first_name . ' ' . $user->last_name)" required autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email адреса')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>
        <div>
            <x-input-label for="phone_number" :value="__('Телефонски број')" />
            <x-text-input id="phone_number" name="phone_number" type="number" class="mt-1 block w-full" :value="old('phone_number', $user->phone_number)" required />
            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
        </div>
        <div>
            <x-input-label for="password" :value="__('Лозинка')" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" disabled value="password" />
            <a class="text-[#8A8328] underline font-medium inline-block mt-1" href="{{route('password.change')}}">Промени лозинка</a>
        </div>
        <div>
            <x-primary-button class="block w-full mt-4">
                Зачувај
            </x-primary-button>
        </div>
    </form>
</section>