@extends('layouts.app')

@section('title', $article->title)

@section('content')

    @can('touch', $article)
        @include('partials.articles._action_buttons', [
            'article' => $article
        ])

        @include('partials.articles._status_bar', [
            'article' => $article
        ])
    @endcan

    <div class="blog-post">
        <div class="uppercase text-xs tracking-wider font-thin flex justify-between">
            <span>
                {{ $article->category->name }}
            </span>
        </div>

        <h3 class="mt-1">
            <a href="{{ route('articles.show', $article) }}">
                {{ $article->title }}
            </a>
        </h3>

        <p class="blog-post-meta mt-1 mb-3">
            {{ $article->publish_at_readable }} by
            <a href="{{ route('profiles.show', $article->user->profile) }}" class="blue">
                {{ $article->user->name }}
            </a>
        </p>

        <p class="text-sm italic">{{ $article->excerpt }}</p>

        <hr>

        @if ($article->hasImage())
            <img src="{{ ArticleImage::getUrl($article->image) }}" class="w-full mb-4"
            alt="Article Image">
        @endif

        <div class="mb-2">{{ $article->body }}</div>

        <div class="flex justify-between">
            <span>
                @foreach ($article->tags as $tag)
                    <a href="#" class="btn btn-link btn-sm btn-success bg-green-400
                    text-white hover:no-underline">
                        {{ $tag->name }}
                    </a>
                 @endforeach
            </span>
        </div>
    </div>
@endsection