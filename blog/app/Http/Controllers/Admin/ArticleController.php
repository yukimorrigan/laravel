<?php

namespace App\Http\Controllers\Admin;

use App\Article;
// необходимо подключить модель категории
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // сортировать список новостей в обратном порядке по дате создания
        return view('admin.articles.index', [
            'articles' => Article::orderBy('created_at', 'desc')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // список категорий передается для присвоения новости категории
        // delimiter - переменная для отрисовки вложенности категорий
        return view('admin.articles.create', [
            'article' => [],
            'categories' => Category::with('children')->where('parent_id', 0)->get(),
            'delimiter' => ''
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Передаем все переменные из модели (точнее ее миграции) для создания новости
        $article = Article::create($request->all());

        // Проверяем есть ли значение в поле categories
        if ($request->input('categories')) :
            // Здесь будет создаваться связь новости со списком категорий
            // categories - метод модели полиморфной связи
            // в методе attach передаем массив с категориями для присоединения
            $article->categories()->attach($request->input('categories'));
        endif;

        return redirect()->route('admin.article.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('admin.articles.edit', [
            'article' => $article,
            'categories' => Category::with('children')->where('parent_id', 0)->get(),
            'delimiter' => ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        // исключаем поле slug
        $article->update($request->except('slug'));

        // отсоединить категории
        $article->categories()->detach();

        // Проверяем есть ли значение в поле categories
        if ($request->input('categories')) :
            // Здесь будет создаваться связь новости со списком категорий
            // categories - метод модели полиморфной связи
            // в методе attach передаем массив с категориями для присоединения
            $article->categories()->attach($request->input('categories'));
        endif;

        return redirect()->route('admin.article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        // отсоеденяем связи с категориями
        $article->categories()->detach();
        $article->delete();

        return redirect()->route('admin.article.index');
    }
}
