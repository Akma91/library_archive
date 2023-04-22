<?php

namespace App\Http\Controllers;

use App\Models\OpenBookQuery;
use Illuminate\Http\Request;

class OpenBookQueryController extends Controller
{
    public function store() {

        $queryFormValues = request()->validate([
            'book_id' => 'required|integer',
            'query_text' => 'required|string|max:500',
        ]);

        $queryFormValues['user_id'] = auth()->user()->id;

        OpenBookQuery::create($queryFormValues);

        return back()
                ->with(['success' => 'Upit je uspješno poslan!']);
    }
}
