<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = "customer";

    /**
     * @var array|\string[][]
     */
    private array $countries = [
        '(237)' => [
            'country' => 'Cameroon',
            'regex' => '/\(237\)\ ?[2368]\d{7,8}$/'
        ],
        '(251)' => [
            'country' => 'Ethiopia',
            'regex' => '/\(251\)\ ?[1-59]\d{8}$/'
        ],
        '(212)' => [
            'country' => 'Morocco',
            'regex' => '/\(212\)\ ?[5-9]\d{8}$/'
        ],
        '(258)' => [
            'country' => 'Mozambique',
            'regex' => '/\(258\)\ ?[28]\d{7,8}$/'
        ],
        '(256)' => [
            'country' => 'Uganda',
            'regex' => '/\(256\)\ ?\d{9}$/'
        ],
    ];

    /**
     * @param Builder $query
     * @param string $code
     * @return Builder
     */
    public function scopeCode(Builder $query, string $code): Builder
    {
        return $query->where('phone', 'LIKE', "($code)%");
    }

    /**
     * @return array|\string[][]
     */
    public function getCountries() {
        return $this->countries;
    }
}
