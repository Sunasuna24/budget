@extends('layouts/app')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-2 col-md-offset-10">
                    <form method="get" id="month-form">
                        <select name="month" id="month" class="form-control" onchange="document.getElementById('month-form').submit()">
                            <option value="Jan" {{ $current_month === 'Jan' ? 'selected' : '' }}>January</option>
                            <option value="Feb" {{ $current_month === 'Feb' ? 'selected' : '' }}>February</option>
                            <option value="Mar" {{ $current_month === 'Mar' ? 'selected' : '' }}>March</option>
                            <option value="Apr" {{ $current_month === 'Apr' ? 'selected' : '' }}>April</option>
                            <option value="May" {{ $current_month === 'May' ? 'selected' : '' }}>May</option>
                            <option value="Jun" {{ $current_month === 'Jun' ? 'selected' : '' }}>June</option>
                            <option value="Jul" {{ $current_month === 'Jul' ? 'selected' : '' }}>July</option>
                            <option value="Aug" {{ $current_month === 'Aug' ? 'selected' : '' }}>August</option>
                            <option value="Sep" {{ $current_month === 'Sep' ? 'selected' : '' }}>September</option>
                            <option value="Oct" {{ $current_month === 'Oct' ? 'selected' : '' }}>October</option>
                            <option value="Nov" {{ $current_month === 'Nov' ? 'selected' : '' }}>November</option>
                            <option value="Dec" {{ $current_month === 'Dec' ? 'selected' : '' }}>December</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
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