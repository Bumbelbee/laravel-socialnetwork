@if(Session::has('success'))
		<div class="alert alert-success" role="alert">
			<strong>{{ Session::get('success') }}</strong> 
		</div>
@endif