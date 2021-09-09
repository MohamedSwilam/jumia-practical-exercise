<?php

namespace App\Http\QueryBuilders;

use App\Models\Customer;
use App\QueryBuilders\QueryBuilder;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;

class CustomerQueryBuilder extends QueryBuilder
{
    /**
     * CustomerQueryBuilder constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $query = Customer::query();

        parent::__construct($query, $request);

        $this->allowedFields(['id', 'name', 'phone']);

        $this->allowedFilters([
            AllowedFilter::scope('code'),
        ]);
    }
}
