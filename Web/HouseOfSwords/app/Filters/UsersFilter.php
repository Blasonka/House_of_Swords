<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;


class UsersFilter extends ApiFilter {
    protected $safeParms = [
        'UID' => ['eq'],
        'EmailAddress' => ['eq'],
        'PwdHash' => ['eq'],
        'PwdSalt' => ['eq']
    ];

    // protected $columnMap = [
    //     'postalCode' => 'postal_code'
    // ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
    ];

}
