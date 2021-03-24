<div>

    <section class="card relative">
        <div wire:loading.flex class="absolute w-full h-full bg-gray-200 bg-opacity-25 z-30 items-center justify-center">
        <x-spinner.spinner size='20' />
    </div>
        <div class="px-6 py-4 bg-gray-50">
            <h1 class="text-gray-700 text-lg font-bold ">Metodos de pago agregado</h1>
        </div>
        <div class="card-body divide-y divide-gray-200">
            @forelse ($paymentMethods as $paymentMethod)
                <article class="text-sm text-grey-700 py-2 flex justify-between items-center">
                    <div>
                        <h1><span class="font-bold">{{ $paymentMethod->billing_details->name }}</span> xxxx-{{ $paymentMethod->card->last4 }}
                            @if ($paymentMethod->id == auth()->user()->defaultPaymentMethod()->id )
                                (default)
                            @endif
                        </h1>

                        <p class="">Expira {{ $paymentMethod->card->exp_month }}/{{ $paymentMethod->card->exp_year }}</p>
                    </div>
                    <div class="flex grid grid-cols-2 border border-gray-200 rounded divide-x divide-gray-200">
                        @unless ($paymentMethod->id == auth()->user()->defaultPaymentMethod()->id)
                            <span class="cursor-pointer p-3 hover:text-gray-700" wire:click="defaultPaymentMethod('{{$paymentMethod->id}}')">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                            </span>
                            <span class="cursor-pointer p-3 hover:text-gray-700" wire:click="deletePaymentMethod('{{$paymentMethod->id}}')">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </span>
                        @endunless
                    </div>
                </article>
            @empty 
                <article>
                    <h1 class="text-sm text-gray-700">
                        No cuenta con metodos de pago
                    </h1>
                </article>
            @endforelse
        </div>
    </section>
</div>
