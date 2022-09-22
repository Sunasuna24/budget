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
                            <th>Description</th>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->created_at->format('m/d/Y') }}</td>
                            <td><a href="/transactions/{{ $transaction->id }}">{{ $transaction->description }}</a></td>
                            <td>{{ $transaction->category->name }}</td>
                            <td>{{ $transaction->amount }}</td>
                            <td>
                                <form action="/transactions" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-xs">Remove</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection