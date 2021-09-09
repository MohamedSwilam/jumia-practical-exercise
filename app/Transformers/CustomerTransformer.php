<?php

namespace App\Transformers;

use App\Models\Customer;
use League\Fractal\TransformerAbstract;

class CustomerTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @param Customer $customer
     * @return array
     */
    public function transform(Customer $customer)
    {
        $data = $customer->toArray();
        if ($customer->phone) {
            $data['code'] = count(explode(' ', $customer->phone)) > 0 ? explode(' ', $customer->phone)[0] : '-';
            $data['phone'] = count(explode(' ', $customer->phone)) > 1 ? explode(' ', $customer->phone)[1] : '-';
            $data['country'] = $customer->getCountries()[$data['code']]['country'];
            $data['valid'] = (boolean)preg_match($customer->getCountries()[$data['code']]['regex'], $customer->phone);
        }
        if (request()->input('valid') || $data['valid']) {
            return $data;
        }
        return $data;
    }
}
