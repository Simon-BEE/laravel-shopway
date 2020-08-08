@component('mail::message')
# Your order has been confirmed

Thanks, {{ $user->firstname ?? $user->email }}!

Your order n°{{ $order->id }}, from {{ Format::date($order->created_at) }}, is in preparation.
Your payment was **accepted**.

Shipping address:
{{ $user->address->full_name }}
{{ $user->address->full_address }}

Order details:
**{{ Format::priceWithCurrency($order->price) }}**
@component('mail::button', ['url' => $url])
View details
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
