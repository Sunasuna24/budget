@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Transaction</div>
                <div class="panel-body">
                    <form action="/transactions" method="post">
                        @include('transactions.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection