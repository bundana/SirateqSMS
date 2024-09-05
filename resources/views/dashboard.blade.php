<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sirateq SMS Software') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="font-medium text-sm text-green-600">
                            <h4>  {{session('success')}}</h4>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="font-medium text-sm text-red-600">
                            <h4>  {{session('error')}}</h4>
                        </div>
                    @endif

                    <form method="post" action="{{ route('send-message') }}" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="name" :value="__('Phone Numbers')"/>
                            <textarea id="phone" name="phone" type="text" class="mt-1 block w-full"
                                      placeholder="Enter phone numbers seperated by commas" autofocus
                                      autocomplete="name" rows="7"></textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('phone')"/>
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('SMS Message')"/>
                            <textarea id="message" name="message" type="text" class="mt-1 block w-full"
                                      placeholder="Enter sms message here" autofocus
                                      autocomplete="name" rows="7"></textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('message')"/>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Send Now') }}</x-primary-button>

                            @if (session('status') === 'profile-updated')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600"
                                >{{ __('Saved.') }}</p>
                            @endif
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
