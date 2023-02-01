<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Filters\PostFilter;
use App\Http\Requests\Post\FilterRequest;
use App\Http\Requests\Post\IndexRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;


class IndexController extends BaseController
{

    public function __invoke(FilterRequest $request)
    {
        $data = $request->validated();
        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 10;

        $filter = app()->make(PostFilter::class, ['queryParams' => array_filter($data)]);
//        dd($filter);
        $posts = Post::filter($filter)->paginate($perPage, ['*'], 'page', $page);
        return PostResource::collection($posts);
     //   return view('post.index', compact('posts'));
    }
}
//$data = $request->validated();
//$page = $data['page'] ?? 1;
//$perPage = $data['per_page'] ?? 10;
//
//$filter = app()->make(PostFilter::class, ['queryParams' => array_filter($data)]);
////        dd($filter);
//$posts = Post::filter($filter)->paginate(10);
//return PostResource::collection($posts);
//   return view('post.index', compact('posts'));

//_____________
//        dd($posts);
//        $data = $request->validated();
//        dd($data);
//_________
//        $query = Post::query();
//
//        if (isset($data['category_id'])) {
//            $query->where('category_id', $data['category_id']);
//        }
//        if (isset($data['title'])) {
//            $query->where('title', 'like', "%{$data['title']}%");
//        }
//        if (isset($data['content'])) {
//            $query->where('content', 'like', "%{$data['content']}%");
//        }
//        $posts = $query->get();
//        dd($posts);
//        $posts = Post::where('is_published', 1)
//          ->where('category_id', 5)
//          ->get();
//        dd($posts);
//        _________
//        $posts = Post::all();
//        $posts = Post::paginate(10);


//_____
//        $category = Category::find(1);
//        $tag = Tag::find(1);
//        dd($post->tags);
//        $post = Post::find(1);
//        dd($post->category);
//        $posts = Post::all();
//        return view('post.index', compact('posts'));

//        $post = Post::find(1);

//  Получение постов относящихся к указанному тегу.
//        $tag = Tag::find(2);
//        dd($tag->posts);

//        $post = Post::find(1);
//        dd($post->posts);
//  Получаем посты, которые принадлежат категории. Один ко многим.
//        $category = Category::find(2);
//        dd($category->posts);

//  Получаем категорию, которая принадлежит посту. Один ко многим.
//        $post = Post::find(1);
//        dd($post->category);

//        $posts = Post::where('category_id', $category->id)->get();
//        dd($posts);
//        $posts = Post::all();
//        $categories = Category::all();
//        dd($categories);

//        return view('post.index', compact('posts'));

//      $posts = Post::all();
//        dump($posts);
//           $post = Post::where('is_published', 1)->first();
//           dump($post->title);
//dd('end');
//}
