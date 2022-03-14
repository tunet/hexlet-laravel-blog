@extends('layouts.app')

@section('content')
    <h1>Список статей</h1>
    @foreach ($articles as $article)
        <h2>
            <a href="{{ route('articles.show', $article) }}">
                {{ $article->name }}
            </a>
            [<a href="{{ route('articles.edit', $article) }}">
                Редактировать
            </a>]
            [<a href="{{ route('articles.destroy', $article) }}" data-method="delete" rel="nofollow">
                Удалить
            </a>]
        </h2>
        <div>
            {{ Str::limit($article->body, 200) }}
        </div>
    @endforeach
@endsection

{{ $articles->links() }}
