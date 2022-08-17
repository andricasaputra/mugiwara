<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Kebijakan privasi</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

	<div class="container py-4">
    <header class="pb-3 mb-4 border-bottom d-flex justify-content-center">
    	<img width="200" src="{{ asset('assets/images/capsuleinnlogo.png') }}" class="text-center" alt="logo"/>
    </header>

    <div class="row align-items-md-stretch">
      <div class="col-md-12">
        <div class="h-100 p-5 bg-light border rounded-3">
          <h3 class="text-center">{{ $policy->title }}</h3>
          <p>
          	{!! $policy->body !!}
          </p>
         {{--  <button class="btn btn-outline-secondary" type="button">Example button</button> --}}
        </div>
      </div>
    </div>

    <footer class="pt-3 mt-4 text-muted border-top text-center">
    	 {{ env('APP_NAME', 'Capsule Inn') }} &copy; {{ date('Y') }}
    </footer>
  </div>
</main>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>