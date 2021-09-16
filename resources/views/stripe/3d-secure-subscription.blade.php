@extends('layouts.app')
{{--Used for SCA Strong Customer Authentication--}}
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Complete The Security Steps</div>

                    <div class="card-body">
                        <p> Please follow some additional steps from your bank</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            const stripe = Stripe('{{config('services.stripe.key')}}');

            stripe.confirmCardPayment("{{$clientSecret}}",{payment_method : "{{$paymentMethod}}"}).then(function (result) {
                if (result.error) {
                    window.location.replace("{{route('subscribe.cancelled')}}");
                } else {
                    window.location.replace("{!!route('subscribe.approval',[
    'plan'  => $plan,
    'subscription_id' => $subscription->id
                    ])!!}");
                }

            });

        </script>
    @endpush
@endsection

