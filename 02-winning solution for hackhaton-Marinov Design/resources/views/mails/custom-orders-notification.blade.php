@component('mail::message')
# Custom Order Notification

You have received a new custom order notification. Below are the details:

**Full Name**: {{ $customOrder->full_name }} <br>
**Email**: {{ $customOrder->email }} <br>
**Message**: {{ $customOrder->message }} <br>
**Link**: {{ $customOrder->link }} <br>

**Image**
![Custom Order Image]({{ $message->embed($customOrder->image) }})

    
Thanks,<br>
{{ config('app.name') }}
@endcomponent
