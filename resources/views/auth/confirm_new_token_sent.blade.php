@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">@lang('auth.email_validation.page.title')</div>
                    <div class="panel-body">
                        <p>@lang('auth.email_validation.page.new_token_sent_message')</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
