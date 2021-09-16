<?php

namespace App\Http\Controllers;

use App\Models\PaymentPlatform;
use App\Models\Plan;
use App\Models\Subscription;
use App\Resolvers\PaymentPlatformResolver;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    protected $paymentPlatformResolver;

    public function __construct(PaymentPlatformResolver  $paymentPlatformResolver) {
        $this->paymentPlatformResolver = $paymentPlatformResolver;
        $this->middleware(['auth','unsubscribed']);
    }

    public function show() {

        $paymentPlatforms = PaymentPlatform::where('subscriptions_enabled', true)->get(); // Returns the platforms that allow subscription

        return view('subscribe')->with([
           'plans' => Plan::all(),
           'paymentPlatforms' => $paymentPlatforms,

        ]);
    }
    public function store(Request $request) {

        $rules = [

            'plan' => ['required','exists:plans,slug'],
            'payment_platform' => ['required','exists:payment_platforms,id']
        ];

        $request->validate($rules);

        $paymentPlatform = $this->paymentPlatformResolver->resolveService($request->payment_platform);
        session()->put('subscriptionPlatformId', $request->payment_platform); // place in the session the platform that the user requested to subscribe with
        return $paymentPlatform->handleSubscription($request);


    }

    public function approval(Request  $request) {

        $rules = [

            'plan' => ['required', 'exists:plans,slug'],

        ];

        $request->validate($rules);

        if (session()->has('subscriptionPlatformId')) {
            $paymentPlatform = $this->paymentPlatformResolver->resolveService(session()->get('subscriptionPlatformId'));

            if ($paymentPlatform->validateSubscription($request)) {
                $plan = Plan::where('slug', $request->plan)->firstOrFail();

                $user = $request->user();

                $subscription = Subscription::create([

                    'active_until' => now()->addDays($plan->duration_in_days),
                    'user_id' => $user->id,
                    'plan_id' => $plan->id
                ]);

                $subscription->save();

                return redirect()->route('home')->withSuccess(['payment' => "Thanks, {$user->name}. You have now a {$plan->slug} subscription. Start using it now"]);
            }

        }
        //$paymentPlatform =

        return redirect()->route('subscribe.show')->withErrors('We cannot check your subscription, try again please');



    }


    public function cancelled() {

        return redirect()->route('subscribe.show')->withErrors('You cancelled. Come back whenever you are ready.');
    }




}
