@extends('layouts/app')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->created_at->format('m/d/Y') }}</td>
                            <td><a href="/categories/{{ $category->id }}">{{ $category->name }}</a></td>
                            <td>{{ $category->slug }}</td>
                            <td>
                                <form action="/categories/{{ $category->id }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-xs">Remove</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>
@endsection