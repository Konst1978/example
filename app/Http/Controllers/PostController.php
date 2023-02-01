<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::all();
        return view('post.index', compact('posts'));

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
    }
//      $posts = Post::all();
//        dump($posts);
//           $post = Post::where('is_published', 1)->first();
//           dump($post->title);
//dd('end');

    public function create()        // Страница добавления поста. Форма
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.create', compact('categories', 'tags'));
    }

    public function store()         // Само добавление поста. Запись в БД поста и выбор тегов.
    {
        $data = request()->validate([
            'title' => 'required|string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => '',
            'tags' => '',
        ]);
        $tags = $data['tags'];
        unset($data['tags']);

        $post = Post::create($data);
        $post->tags()->attach($tags);       // Записываем данные в сводную таблицу 'post_tags'. tags() -это модель Tag
//        foreach ($tags as $tag) {
//            PostTag::firstOrCreate([
//                'tag_id' => $tag->id,
//                'post_id' => $post->id,
//            ]);
//        }
        return redirect()->route('post.index');
    }

//  получение одного поста по введенному в строке id
//  Если мы укажем именно так public function show(Post $post) то внутри ничего указывать не надо
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
        //        $post = Post::findOrFail($id);
//        dd($post->title);
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Post $post)
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => '',
            'tags' => '',
        ]);
        $tags = $data['tags'];
        unset($data['tags']);

        $post->update($data);
        $post->tags()->sync($tags);
//        $post = $post->fresh();
        return redirect()->route('post.show', $post->id);
    }

    public function delete()
    {
        $post = Post::withTrashed()->find(2);
        $post->restore();
        dd('deleted');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }

// Это было в методе create в начале урока.
//        $postsArr = [
//            [
//                'title' => 'tetle of post from phpshtorm',
//                'content' => 'some interesting content',
//                'image' => 'imagblabla.jpg',
//                'likes' => 20,
//                'is_published' => 1,
//            ],
//            [
//                'title' => 'another tetle of post from phpshtorm',
//                'content' => 'another some interesting content',
//                'image' => 'another imagblabla.jpg',
//                'likes' => 50,
//                'is_published' => 1,
//            ],
//        ];
//
//        foreach ($postsArr as $item) {
//            Post::create($item);
//  ___________________

//        Здесь мы просто добавляем в БД запись поста. Не из массива.
//      Post::create([
//            'title' => 'another tetle of post from phpshtorm',
//            'content' => 'another some interesting content',
//            'image' => 'another imagblabla.jpg',
//            'likes' => 50,
//            'is_published' => 1,
//        ]);
//        dd('created');

//    public function update()
//    {
//        $post = Post::find(3);
//
//        $post->update([
//            'title' => 'updated',
//            'content' => 'updated',
//            'image' => 'updated',
//            'likes' => 1000,
//            'is_published' => 0,
//        ]);
//        dd('update');
//    }
//    public function delete()
//    {
////        $post = Post::find(3);
//        $post = Post::withTrashed()->find(3);
//        $post->restore();
////        dd($post->title);
//        dd('deleted post');
//    }
//    public function firstOrCreate()
//    {
//        $anotherPost = [
//            'title' => 'new updated2',
//            'content' => 'new updated2',
//            'image' => 'someimagblabla.jpg',
//            'likes' => 30,
//            'is_published' => 0,
//
//        ];
//        $post = Post::firstOrCreate([
//            'title' => 'new updated2',
//        ],$anotherPost);
//            'title' => 'new content updated1',
//            'content' => 'new updated1',
//            'image' => 'updated',
//            'likes' => 2000,
//            'is_published' => 0,
//        dump($post->content);
//        dd('firstOrCreate');
//    }
//    public function updateOrCreate()
//    {
//        $anotherPost = [
//            'title' => 'some post1',
//            'content' => 'some post1',
//            'image' => '222someimagblabla.jpg',
//            'likes' => 30,
//            'is_published' => 0,
//        ];
//        $post = Post::updateOrCreate([
//            'title' => 'some post1',
//        ],$anotherPost);
//            'title' => 'some post1',
//            'content' => 'new some post1',
//            'image' => 'new some post1',
//            'likes' => 3000,
//            'is_published' => 1,
//        dump($post->content);
//        dd('updateOrCreate');
//    }
}
