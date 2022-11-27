<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="google-site-verification" content="Ppv4Dxckz6jaHplQ6Jc0ISLu2tPqThCIXOCws09wAYU">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
	<link rel="stylesheet" href="{{ asset('/assets/profile/css/main.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/profile/css/responsiv.css') }}">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="icon" type="image/x-icon" href="{{url('images/compro/favicon/' . $settings?->favicon)}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>{{$title !== '' ? $title : 'CapsuleInn'}}</title>
	<style>
		.hotel .card form input{
		  background-color: var(--hsr-form-on);
		  border: none;
		  border-radius: 15px;
		  display: flex;
		  width: 100%;
		  height: 60px;
		  padding: 0 30px;
		  margin-bottom: 30px;
		  font-size: 1rem;
		  color: var(--hsr-primary);
		  appearance: none;
		  -webkit-appearance: none;
		  -moz-appearance: none;
		}
	</style>
</head>
<body>