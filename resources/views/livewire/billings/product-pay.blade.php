<div>
    {{$prueba}}
    <div class="card relative">
        <div wire:loading.flex
        class="absolute w-full h-full bg-gray-200 bg-opacity-25 z-30 items-center justify-center">
        <x-spinner.spinner size='20' />
    </div>
        <div class="card-body">

            <div class="flex justify-between items-center mb-4">
                <h1 class="text-lg font-bold text-gray-700">Método de pago</h1>
                <img class='h-8' src="https://leadershipmemphis.org/wp-content/uploads/2020/08/780370.png" alt="">
              
            </div>
            <form action="" id="card-form" class="">

                <div class="form-group">
                    <label class="form-label" for=""
                        aria-placeholder="Ingrese el nombre del titular de la tarjeta">Nombre de la tarjeta</label>
                    <input id="card-holder-name" type="text" class="form-control" required>
                </div>

                <!-- Stripe Elements Placeholder -->
                <div class="form-group">
                    <label for="" class="form-label">Número de tarjeta</label>
                    <div id="card-element" class="form-control"></div>
                    <span id='card-error' class="invalid-feedback"></span>
                </div>

                <button id="card-button" class="btn btn-primary">
                    Process Payment
                </button>
            </form>
        </div>
    </div>
    @slot('js')
    <script>
        document.addEventListener('livewire:load',function(){
            stripe();
        });

        Livewire.on('resetStripe',function(){
            stripe();
            document.getElementById("card-form").reset();
        })
    </script>
        <script>
            function stripe() {

                const stripe = Stripe("{{ env('STRIPE_KEY') }}");
                const elements = stripe.elements();
                const cardElement = elements.create('card');
                const cardForm = document.getElementById('card-form');

                cardElement.mount('#card-element');

                const cardHolderName = document.getElementById('card-holder-name');
                const cardButton = document.getElementById('card-button');

                cardForm.addEventListener('submit', async (e) => {
                    e.preventDefault();

                    const {
                        paymentMethod,
                        error
                    } = await stripe.createPaymentMethod(
                        'card', cardElement, {
                            billing_details: {
                                name: cardHolderName.value
                            }
                        }
                    );

                    if (error) {
                        document.getElementById("card-error").textContent = error.message;
                    } else {
                        Livewire.emit('paymentMethodCreate', paymentMethod.id)
                    }
                });
            }

        </script>
    @endslot
</div>
