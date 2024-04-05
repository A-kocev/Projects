@component('mail::message')
# FAQ Notification

You have received new FAQs. Below are the details:

- **Question:** {{ $faq->question }}

Waiting on your answer.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
