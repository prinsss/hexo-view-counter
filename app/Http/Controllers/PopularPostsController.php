<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class PopularPostsController extends Controller
{

    public function getSlugs(Request $request)
    {
        $limit = $request->input('limit', 10);
        $result = DB::table('post_views')->orderBy('pv', 'desc')->limit($limit)->get();

        return response()->json($result);
    }

}
