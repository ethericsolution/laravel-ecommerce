<?php

namespace App\Http\Controllers;

use App\Models\Search;
use App\Models\SearchQuery;
use App\Models\SearchUser;
use App\Models\UserSearchQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SearchController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if ($request->query == null) {
            return redirect()->route('products.index');
        }


        $searchQuery = SearchQuery::firstOrCreate(
            ['query' => $request->get('query')],
        );

        $searchQuery->increment('count');

        if (Auth::check()) {

            $userSearch = UserSearchQuery::firstOrCreate(
                [
                    'user_id' => Auth::id(),
                    'search_query_id' => $searchQuery->id
                ],

            );
            $userSearch->increment('count');
        }

        return redirect()->back()->with('success', 'Search saved successfully!');
    }
}
