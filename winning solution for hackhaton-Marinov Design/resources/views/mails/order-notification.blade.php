@component('mail::message')
# Order Notification

You have received a new order. Below are the details:

**Order ID:** {{ $order->id }}  
**Full Name:** {{ $order->full_name }}  
**Email:** {{ $order->email }}  
**Country:** {{ $order->country }}  
**City:** {{ $order->city }}  
**Zip Code:** {{ $order->zip_code }}  
**Address:** {{ $order->address }}  
**Discount Code:** {{ $order->discount_code ?? 'N/A' }}  
**Total Amount:** ${{ $order->total_amount }}

**Ordered Products:**
@foreach ($order->products as $product)
- **Product Name:** {{ $product->title }}
- **Quantity:** {{ $product->pivot->quantity }}
@endforeach

Thanks,<br>
{{ config('app.name') }}
@endcomponent
