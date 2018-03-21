<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class SearchController extends Controller
{

    public function autocomplete(){
        $term = Input::get('term');

        $results = array();

        $queries = DB::table('payaments')
            ->where('nome', 'LIKE', '%'.$term.'%')
            ->take(5)->get();

        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' => $query->nome ];
        }
        return Response::json($results);
    }


}
