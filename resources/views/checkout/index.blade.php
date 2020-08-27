@extends('layouts.app')

@section('meta-desc')
    <meta name="description" content="Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem nam veniam tempora fugit fuga pariatur atque maiores consequuntur asperiores dolores! Facere natus vitae odit, quis corporis recusandae ad consectetur numquam!"/>
@endsection

@section('meta-title')
    {{ __('Checkout') }}
@endsection

@section('breadcrumb')
    <x-breadcrumb-item route="{{ route('cart.index') }}" label="{{ __('Cart') }}" />
    <x-breadcrumb-item route="{{ route('checkout.index') }}" label="{{ __('Checkout') }}" active />
@endsection

@section('content')

<livewire:checkout.index />

@endsection
@section('extra-js')
<script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe("{{ config('shop.stripe.public_key') }}");
        const elements = stripe.elements();
        const cardError = document.querySelector("#card-error");
        const style = {
            base: {
                color: "#32325d",
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: "antialiased",
                fontSize: "16px",
                "::placeholder": {
                    color: "#aab7c4"
                }
            },
            invalid: {
                color: "#fa755a",
                iconColor: "#fa755a"
            }
        };
        const card = elements.create("card", { style: style });
        card.mount("#card-element");

        card.on("change", function (event) {
          document.querySelector("button").disabled = event.empty;
          cardError.textContent = event.error ? event.error.message : "";
        });

        const buttonForm = document.getElementById('submit');
        const paymentForm = document.getElementById('payment-form');
        paymentForm.addEventListener('submit', (e) => {
            e.preventDefault();
            if (document.getElementById('card-element').classList.contains('StripeElement--complete')) {
                paymentProccess(stripe, card);
            }
        });

        const paymentProccess = (stripe, card) => {
            loading();

            fetch("{{ route('checkout.payment.intent') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then((result) => {
                result.json().then((r) => { 

                    stripe.confirmCardPayment(r.clientSecret, {
                        payment_method: {
                            card: card
                        }
                    }).then((result) => {
                        if (result.error) {
                            cardError.textContent = result.error.message;
                            loading(false);
                            return;
                        }
                        orderComplete(result.paymentIntent.id)
                    });
                });

            }).catch((error) => {
                window.location.href = "{{ route('checkout.error') }}";
            });
        };

        const orderComplete = (paymentIntentId) => {
            fetch("{{ route('checkout.order.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    paymentIntent: paymentIntentId
                })
            }).then((result) => {
                result.json().then((r) => {
                    // if (!result.success) {
                    //     console.log(result);
                    //     console.log(r);
                    //     // window.location.href = "{{ route('checkout.error') }}";
                    //     return;
                    // }

                    console.log('Payment: OK');
                    window.location.href = "{{ route('checkout.successful') }}";
                });
            }).catch((error) => {
                alert(error);
                console.log(error);
                window.location.href = "{{ route('checkout.error') }}";
            });
        };

        const loading = (isLoading = true) => {
            if (isLoading) {
                buttonForm.disabled = true;
                document.getElementById('spinner').classList.remove('hidden');
                document.getElementById('button-text').classList.add('hidden');
            } else {
                buttonForm.disabled = false;
                document.getElementById('spinner').classList.add('hidden');
                document.getElementById('button-text').classList.remove('hidden');
            }
        };

    </script>
@endsection