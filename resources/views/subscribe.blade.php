@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Subscribe') }}</div>

                    <div class="card-body">


                        <form action="{{route('subscribe.store')}}" method="POST" id="paymentForm">
                            @csrf
                            <div class="row mt-3">
                                <div class="col">
                                    <label for="">Select your plan</label>
                                    <div class="form-group">
                                        <div  class="btn-group btn-group-toggle">
                                            @foreach($plans as $plan)
                                                <label  class="btn btn-outline-info rounded m-2 p-1">
                                                    <input type="radio" name="plan" value="{{$plan->slug}}" required >
                                                    <p class="h2 font-weight-bold text-capitalize">{{$plan->slug}}</p>

                                                    <p class="display-4 text-capitalize">
                                                        {{$plan->visual_price}}
                                                    </p>
                                                </label>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <label for="">Select the desired payment platform</label>
                                    <div class="form-group" id="toggler">
                                        <div data-toggle="buttons" class="btn-group btn-group-toggle">
                                            @foreach($paymentPlatforms as $paymentPlatform)
                                                <label data-target="#{{$paymentPlatform->name}}Collapse" data-toggle="collapse" class="btn btn-outline-secondary rounded m-2 p-1">
                                                    <input type="radio" name="payment_platform" value="{{$paymentPlatform->id}}" required >
                                                    <img src="{{asset($paymentPlatform->image)}}" class="img-thumbnail" alt="">
                                                </label>
                                            @endforeach

                                        </div>
                                        @foreach($paymentPlatforms as $paymentPlatform)
                                            <div id="{{$paymentPlatform->name}}Collapse" class="collapse" data-parent="#toggler" >
                                                @includeIf('components.' . strtolower($paymentPlatform->name) .'-collapse')
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" id="payButton" class="btn btn-primary btn-lg">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
