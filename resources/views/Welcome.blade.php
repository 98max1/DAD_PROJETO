@component('mail::message')
	This Email has been sent so you can reset your password on the RestaurantManagement platform!
	@component('mail::button',['url'=>'http://restaurantmanager.dad/#/reset/'.$token.'/email/'.$email])
		Reset Password!
	@endcomponent
	Greetings!
	{{config('app.name')}}
@endcomponent
