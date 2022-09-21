@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Transaction</div>
                <div class="panel-body">
                    <form action="/transactions/{{ $transaction->id }}" method="post">
                        {{ method_field('PUT') }}
                        @include('transactions.form', ['buttonText' => 'Update'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection