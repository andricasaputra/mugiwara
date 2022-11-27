<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script src="{{ asset('assets/profile/js/main.js') }}"></script>
<script>

	function getPlayStore(){

		$.ajax({
			url : '{{ route('playstorelink') }}',
			success: function({ data }){
				window.open(data.url)
			}
		});
	}

	function getAppStore(){

		$.ajax({
			url : '{{ route('appstorelink') }}',
			success: function({ data }){
				window.open(data.url)
			}
		});
	}

	$('#playstore').click(function(e){
		e.preventDefault();
		getPlayStore();
	});


	$('#appstore').click(function(e){
		e.preventDefault();
		getAppStore();
	});
</script>
<script>

	$('#searchHotel').click(function(e){
		e.preventDefault();

		const dateSearch = $('#dateSearch').val();

		searchHotel(dateSearch);
	});

	function searchHotel(dateSearch){
		$.ajax({
			url: "{{ route('api.accomodation.index') }}",
			methood : "POST",
			header: "{{ csrf_token() }}",
			success : function({ data }){

				$('.hotels').empty();

				$.each(data, function(i, hotel){
					if(parseInt(hotel.available_room_count) > 0){
						$('.hotels').append(hotelListTemplate(hotel));
					}
					
				});
			},
			error: function(err){
				console.log(err)
			}
		});
	}

	function hotelListTemplate(hotel){

		return `<div class="card">
                    		 	
	        <div class="card-img">

	            <img class="card-img-top" src="${hotel.rooms[0].images[0].url}" style="width: 100%; height: 100%">

	            <div class="link-action">
	                <a href="#" class="btn btn-sm btn-redirect"><img src="{{ asset('compro/assets/img/appstore.png') }}"><span class="mx-3">Appstore</span></a>
	                <a href="#" class="btn btn-sm btn-redirect"><img src="{{ asset('compro/assets/img/playstore.png') }}"><span class="mx-3">Playstore</span></a>
	            </div>
	        </div>
	        <div class="card-body">
	            <div class="starts">

	                <span class="badge badge-secondary">${hotel.rooms[0].room_type}</span>

	                ${ratingTemplate(hotel.ratings_avg)}
	                	
	                <span>${hotel.ratings_avg}</span>
	            </div>
	            <h3>${hotel.name}</h3>
	        </div>
	    </div>`;
	}

	function ratingTemplate(rating){

		let stars = "";

		for(let i = 0; i <= parseInt(rating); i++){
			stars += `<img class="start" src="{{ asset('compro/assets/img/bintang.png') }}">`;
		}

		return stars;
	}

	$('.btn-categories').click(function(){
		const category = $(this).data('category');

		filterHotel(category)
	});

	function filterHotel(category){
		$.ajax({
			url: "{{ route('api.accomodation.index') }}?category=" + category,
			methood : "POST",
			header: "{{ csrf_token() }}",
			success : function({ data }){

				$('.hotels').empty();

				$.each(data, function(i, hotel){
					console.log(hotel)
					if(parseInt(hotel.available_room_count) > 0){
						//console.log(hotel)
						$('.hotels').append(hotelListTemplate(hotel));
					}
				});
			},
			error: function(err){
				console.log(err)
			}
		});
	}
</script>

@if($popup && $popup->is_active == 1)
	<!-- jQuery Code (to Show Modal on Page Load) -->
<script>
$(document).ready(function() {
    $("#myModal").modal("show");
});
</script>
@endif
</body>
</html>