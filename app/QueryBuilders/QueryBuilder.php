<?php

namespace App\QueryBuilders;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder as SpatieQueryBuilder;

class QueryBuilder extends SpatieQueryBuilder
{
    /**
     * @param int $perPage
     * @param string[] $columns
     * @param string $pageName
     * @param null $page
     * @return LengthAwarePaginator
     */
    public function paginate($perPage = 15, $columns = ['*'], $pageName = 'page', $page = null): LengthAwarePaginator
    {
        return parent::paginate(request()->input('paginate') ?? $perPage, $columns, $pageName, $page);
    }
}
