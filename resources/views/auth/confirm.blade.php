@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('auth.email_validation.page.title')</div>
                <div class="panel-body">
                    <p>@lang('auth.email_validation.page.message')</p>
                    <p>@lang('auth.email_validation.page.new_token_maybe_message')</p>
                    <form class="form-horizontal" role="form" method="GET" action="{{ route('confirm.new_token') }}">
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('auth.email_validation.page.new_token_btn')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
