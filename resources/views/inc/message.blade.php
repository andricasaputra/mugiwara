@if (session()->has('success'))
   <div style="border-radius: 10px" class="alert alert-success mt-2">{{ session()->get('success') }}</div>
@elseif (session()->has('warning'))
    <div style="border-radius: 10px" class="alert alert-warning mt-2">{{ session()->get('warning') }}</div>
@endif

@if($errors->any())
  @foreach($errors->all() as $error)
    <div style="border-radius: 10px" class="alert alert-danger mt-2">{{ $error }}</div>
  @endforeach
@endif

<div id="message-flash"></div>
