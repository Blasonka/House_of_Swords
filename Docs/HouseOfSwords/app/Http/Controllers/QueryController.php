<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class QueryController extends Controller
{
    public static function useRestParamsStart(Request $r, $type){

    }

    public static function useRestParamsEnd(Request $r, $collection){
        if ($r->query('offset') != null){
            $collection = $collection->skip((int)$r->query('offset'));
        }

        if ($r->query('limit') != null){
            $collection = $collection->take((int)$r->query('limit'));
        }

        // if ($r->query('sort') != null){
        //     if (str_contains($field, ':')){
        //     $field = explode(':', $field)[0];

        //     if (explode(':', $field)[1] == 'desc'){
        //         $sortAsc = false;
        //     }
        // }

        //     foreach ($sortThis as $key => $value) {
        //         $field = $value;
        //         $sortAsc = true;

        //         if (str_contains($field, ':') && explode(':', $field)[1] == 'desc'){
        //             $field = explode(':', $field)[0];
        //             $sortAsc = false;
        //         }

        //         // $collection = sortCollection($collection, $field, $sortAsc);

        //         // if ($sortAsc) {
        //         //      $collection = $collection::sortBy($field);
        //         // }
        //         // else {
        //         //     $collection = $collection::sortByDesc($field);
        //         // }

        //         $collection = QueryController::sortCollection($collection, $field, $sortAsc);
        //     }
        // }

        return $collection;
    }

    // public function sortCollection($collection, $field, $sortAsc){
    //     return $collection::sortBy($field, $sortAsc ? 'asc' : 'desc');
    // }
}
