<div
    {{ $attributes->merge(['class' => 'absolute inset-0 w-full h-full bg-black bg-opacity-75 flex justify-center items-center']) }}>
    <div class="bg-white  md:max-w-xl rounded-lg shadow-lg overflow-hidden">
        <div
            class="border-b-2 {{ $headerClass ?? 'bg-grey-100' }} flex px-6 py-4 justify-between items center text-white">
            <div>{{ $header ?? 'Modal Header' }}</div>
            <button class="focus:outline-none" @click="{{ $state }} = false">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-6">
            {{ $slot }}
        </div>

        <div class="bg-gray-100 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <div class="flex justify-between">
                {{ $footer }}
            </div>
        </div>
    </div>

</div>
