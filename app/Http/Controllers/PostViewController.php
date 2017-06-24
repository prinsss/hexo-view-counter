<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;

class PostViewController extends Controller
{
    /**
     * Get a post's view count by slug.
     *
     * @param  string $slug Unique identification for post.
     * @return mixed
     */
    public function get($slug) {
        $result = DB::table('post_views')->where('slug', $slug)->first();

        if ($result) {
            return response()->json(['slug' => $slug, 'pv' => $result->pv]);
        } else {
            return response('No such slug.', 404);
        }
    }

    /**
     * Increase a post's view count by slug or created a new record.
     *
     * @param  string $slug
     * @return mixed
     */
    public function increase($slug) {
        $result = DB::table('post_views')->where('slug', $slug)->first();

        if ($result) {
            DB::table('post_views')->where('slug', $slug)->increment('pv', 1, [
                'updated_at' => Carbon::now('Asia/Shanghai')
            ]);

            $pv = $result->pv + 1;
        } else {
            DB::table('post_views')->insert(
                ['slug' => $slug, 'pv' => 1, 'created_at' => Carbon::now('Asia/Shanghai')]
            );

            $pv = 1;
        }

        return response()->json(['slug' => $slug, 'pv' => $pv]);
    }
}
