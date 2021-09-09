<?php

namespace App\Http\Controllers;

use App\Http\QueryBuilders\CustomerQueryBuilder;
use App\Http\Responses\Facades\ApiResponse;
use App\Transformers\CustomerTransformer;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    /**
     * @param CustomerQueryBuilder $customerQueryBuilder
     * @return JsonResponse
     */
    public function index(CustomerQueryBuilder $customerQueryBuilder): JsonResponse
    {
        return ApiResponse::indexResponse($customerQueryBuilder->paginate(), CustomerTransformer::class);
    }
}
