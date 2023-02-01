<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class DestroyController extends BaseController
{

    public function __invoke(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }
}
