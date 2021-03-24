<div>
    <article class="card relative">
        <form action="" id="card-form">
            <div wire:loading.flex
                class="absolute w-full h-full bg-gray-200 bg-opacity-25 z-30 items-center justify-center">
                <x-spinner.spinner size='20' />
            </div>
            <div class="card-body">
                <h1 class="text-grey-700 text-lg font-bold mb-4">Agregar metodo de pago</h1>
                <div class="flex">
                    <p class="text-grey-700">Informacion de tarjeta</p>
                    <div class="flex-1 ml-6">
                        <div class="form-group">
                            <input id="card-holder-name" type="text" class="form-control"
                                placeholder="Nombre del titular de la tarjeta" required>
                        </div>
                        <div>
                            <div id="card-element" class="form-control"></div>
                            <div id="card-errors" class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-grey-50 flex justify-end">
                <button id="card-button" class="btn btn-primary" data-secret="{{ $intent->client_secret }}">
                    Update Payment Method
                </button>
            </div>
        </form>
    </article>

    @slot('js')

        <script>
            document.addEventListener('livewire:load', function() {
                stripe();
            });
            Livewire.on('resetStripe', function() {
                document.getElementById('card-form').reset();
                stripe();

            });

        </script>
        <script>
            function stripe() {
                const stripe = Stripe( "{{ env('STRIPE_KEY') }}" );

                const elements = stripe.elements();
                const cardElement = elements.create('card');

                cardElement.mount('#card-element');


                //GENERAR TOKEN
                const cardHolderName = document.getElementById('card-holder-name');
                const cardButton = document.getElementById('card-button');
                const clientSecret = cardButton.dataset.secret;
                const cardForm = document.getElementById('card-form')

                cardForm.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    const {
                        setupIntent,
                        error
                    } = await stripe.confirmCardSetup(
                        clientSecret, {
                            payment_method: {
                                card: cardElement,
                                billing_details: {
                                    name: cardHolderName.value
                                }
                            }
                        }
                    );

                    if (error) {
                        document.getElementById('card-errors').textContent = error.message;
                    } else {
                        Livewire.emit('paymentMethodCreate', setupIntent.payment_method)
                    }
                });
            }

        </script>
    @endslot
</div>
