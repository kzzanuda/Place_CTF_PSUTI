<x-guest-layout>
  <x-auth-card>
    <div style="text-align: center">
      <x-slot name="logo">
        <a href="/">
          <img src="{{asset('storage/logo-white.png')}}" alt="logo" class="logo">
        </a>
      </x-slot>

      <div class="mb-4 text-sm text-gray-600">
        {{ __('Подтвердите почту, прежде чем продолжить участие в мероприятии.') }}
      </div>

      @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
          {{ __('Новое письмо было отправлено на почту, указанную в вашем профиле.') }}
        </div>
      @endif

      <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}" style="padding-bottom: 3rem">
          @csrf

          <div>
            <x-button>
              {{ __('Выслать письмо повторно') }}
            </x-button>
          </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
          @csrf

          <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
            {{ __('Выйти') }}
          </button>
        </form>
      </div>
    </div>
  </x-auth-card>
</x-guest-layout>
