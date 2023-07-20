<!-- index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Posts</h1>

    @if ($posts->isEmpty())
        <p>No posts found.</p>
    @else
        <ul>    
            @foreach ($posts as $post)
                <li>
                    <h3>{{ $post->title }}</h3>
                    <p>{{ $post->body }}</p>
                    <p>Posted by: {{ $post->user->name }}</p>
                </li>
                <div>
                    <a href="{{ route('posts.show', $post) }}" style="background-color: blue; color: white; padding: 6px 12px;">View</a>
                    

                    @can('update', $post)
                        <a href="{{ route('posts.edit', $post) }}" style="background-color: orange; color: white; padding: 6px 12px;">Edit</a>
                    @endcan
                    @can('delete', $post)
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background-color: red; color: white; padding: 3px 9px;">Delete</button>
                        </form>
                    @endcan
                </div>
                <hr class="dotted">
            @endforeach
        </ul>
        {{ $posts->links() }}
    @endif
@endsection
