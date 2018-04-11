@component('mail::message')
# @lang('auth.email_validation.mail.title')

@lang('auth.email_validation.mail.line1')

@component('mail::button', ['url' => url('/confirm/' . $user->confirmation_token)])
@lang('auth.email_validation.mail.button')
@endcomponent

@lang('auth.email_validation.mail.line2')<br />

@lang('email.regards'),<br>
{{ config('app.name') }}

@component('mail::subcopy')
@lang('email.action_subtext', ['actionText' => __('auth.email_validation.mail.button'), 'actionUrl' => url('/confirm/' . $user->confirmation_token)])
@endcomponent

@endcomponent
