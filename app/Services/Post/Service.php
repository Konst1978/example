<?php

namespace App\Services\Post;

use App\Models\Post;

class Service
{
    public function store($data)
    {
        $tags = $data['tags'];
        unset($data['tags']);
        $post = Post::create($data);
        $post->tags()->attach($tags);       // Записываем данные в сводную таблицу 'post_tags'. tags() -это модель Tag
// ---- Добавил при изучении запросов API
        return $post;
    }
    public function update()
    {
        $tags = $data['tags'];
        unset($data['tags']);

        $post->update($data);
        $post->tags()->sync($tags);
//        $post = $post->fresh();
    }
}
