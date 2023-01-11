<x-mail::message>
# New Enquiry

Your new  Enquiry been Recived!

<x-mail::button :url="$mailData['subject']">
View Order
</x-mail::button>

{{$mailData['message']}}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
