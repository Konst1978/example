<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;


class StoreController extends BaseController
{

    public function __invoke(StoreRequest $request)         // Само добавление поста. Запись в БД поста и выбор тегов.
    {
        $data = $request->validated();
//        $this->service->store($data);

        $post = $this->service->store($data);

        return new PostResource($post);
//        $arr = [
//          'title' => $post->title,
//          'content' => $post->content,
//          'image' => $post->image,
//        ];
//        dd($post);
//        return $arr;

//        return redirect()->route('post.index');
    }
}
