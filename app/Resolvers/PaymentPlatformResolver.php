<?php

namespace App\Resolvers;

use App\Models\PaymentPlatform;

class PaymentPlatformResolver
{

    protected $paymentPlatforms;


    /**
     * Constructor with assignment of all the payment platforms to a property $paymentPlatforms
     */
    public function __construct()
    {
        $this->paymentPlatforms = PaymentPlatform::all();
    }

    /**
     * Function Extracts the available services from the  services configuration using the id passed to the function,
     * it searches the database for the given id and if found extracts the information from the services file
     * @param $paymentPlatformId
     * @return \Illuminate\Contracts\Foundation\Application|mixed
     * @throws \Exception
     */
    public function resolveService($paymentPlatformId) {

        $name = strtolower($this->paymentPlatforms->firstWhere('id', $paymentPlatformId)->name);

        $service = config("services.{$name}.class");

        if ($service) {
            return resolve($service);
        }

        throw new \Exception('This selected platform is not in the configuration');
    }
}
