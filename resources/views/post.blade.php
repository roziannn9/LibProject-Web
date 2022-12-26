@extends('layouts.main')
@include('partials.navbar')

@section('container')
    <div class="container">
        <div class="row justify-content-left mb-5">
            <div class="col-md-8">
                <div class="item-join d-flex justify-content-between">
                    <div class="mr-auto">
                        <h3 class="mb-3">{{ $post->title }}</h3>
                    </div>
                    <div class="join-button">
                        <button type="button" class="btn btn-primary btn-sm text-white"> + Join Project</button>
                    </div>
                </div>

                <p><a href="#/{{ $post->user->username }}" class="text-decoration-none">{{ $post->user->name }} </a> in <a
                        href="/posts?category={{ $post->category->slug }}"
                        class="text-decoration-none">{{ $post->category->name }}</a></p>

                @if ($post->image)
                    <div style="max-height: 350px; overflow:hidden">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}"
                            class="img-fluid">
                    </div>
                @else
                    <img src="https://source.unsplash.com/1200x400? {{ $post->category->name }}"
                        alt="{{ $post->category->name }}" class="img-fluid">
                @endif

                <article class="my-3">
                    {!! $post->body !!}
                </article>
                <a href="/posts" class="d-block mt-5">Back to Project</a>
            </div>

            <div class="col-md-4">
                <h5>Komentar</h5>
                <hr>
                @foreach ($post->comments as $comment)
                    <div class="d-flex flex-column">
                        <div class="d-flex justify-content-between">
                            <a href="#" style="text-decoration:none"> {{ $comment->user->name }}</a>
                            @if ($comment->user->name == auth()->user()->name)
                                <a href="#" style="font-size: 13px; text-decoration:none;">Hapus</a>
                            @endif
                        </div>
                        <p>{{ $comment->subject }}
                            <br> <span style="font-size: 11px">{{ $comment->created_at->diffForhumans() }}</span>
                        </p>

                    </div>
                @endforeach
                <form method="POST" action="/post-comment/{{ $post->id }}">
                    @csrf
                    <div class="form-group">
                        <label for="subject"></label>
                        <textarea class="form-control" name="subject" id="subject" rows="3" style="width: 100%;"></textarea>
                    </div>
                    <div class="item-button mt-3 text-right">
                        <button type="submit" class="btn btn-primary btn-sm">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
