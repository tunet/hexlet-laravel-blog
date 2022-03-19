<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(): View
    {
        $articles = Article::paginate();

        return view('article.index', compact('articles'));
    }

    public function create(): View
    {
        $article = new Article();

        return view('article.create', compact('article'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validate($request, [
            'name' => 'required|unique:articles',
            'body' => 'required|min:1000',
        ]);

        $article = new Article();
        $article->fill($data);
        $article->save();

        return redirect()->route('articles.index');
    }

    public function show(Article $article): View
    {
        return view('article.show', compact('article'));
    }

    public function edit(Article $article): View
    {
        return view('article.edit', compact('article'));
    }

    public function update(Request $request, Article $article): RedirectResponse
    {
        $data = $this->validate($request, [
            'name' => "required|unique:articles,name,{$article->id}",
            'body' => 'required|min:100',
        ]);

        $article->fill($data);
        $article->save();

        return redirect()->route('articles.index');
    }

    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();

        return redirect()->route('articles.index');
    }
}
