<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Filters\PostFilter;
use App\Http\Requests\Post\FilterRequest;
use App\Http\Requests\Post\IndexRequest;
use App\Models\Post;

// Контроллер админки
class IndexController extends Controller
{
    public function __invoke(FilterRequest $request)
    {
//        FilterRequest $request
        $data = $request->validated();
        $filter = app()->make(PostFilter::class, ['queryParams' => array_filter($data)]);
        $posts = Post::filter($filter)->paginate(10);
//        return view( 'admin.post.index');
        return view( 'admin.post.index', compact('posts'));

    }
}
