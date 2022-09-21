
<div class="form-group">
    <label for="room_numbers">Nomor Kamar</label>
    <select name="room_numbers[]" class="form-control form-control-lg js-example-tokenizer" multiple="multiple" style="width: 100%">
        @foreach($accomodation->room as $room)
         <option value="{{ $room->room_number }}" selected>{{ $room->room_number }}</option>
        @endforeach
        @foreach($numbers as $number)
            <option value="{{ $number->number }}">{{ $number->number }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="type_id">Type kamar</label>
    <select name="type_id" class="form-control" id="">
        <option value="{{ $accomodation->room?->first()?->type->id }}">{{ $accomodation->room?->first()?->type->name }}</option>
        @foreach($types as $type)
            <option value="{{ $type->id }}">{{ $type->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="price">Maksimal Jumlah Tamu</label>
    <input name="max_guest" type="number" class="form-control form-control-lg"  required value="{{ $accomodation->room?->first()?->max_guest}}">
</div>

<div class="form-group">
    <label for="price">Fasilitas Kamar</label>
    <select name="facility[]" class="form-control form-control-lg js-example-tokenizer" multiple="multiple" style="width: 100%">
        @foreach($accomodation->room?->first()?->facilities ?? [] as $room_faility)
            <option selected value="{{ $room_faility->id }}">{{ $room_faility->name }}</option>
        @endforeach
        @foreach($facilities as $facility)
            <option value="{{ $facility->id }}">{{ $facility->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="price">Harga / malam</label>
    <input name="price" type="number" class="form-control form-control-lg"  required value="{{ $accomodation->room?->first()?->price }}">
</div>

<div class="form-group">
    <label for="price">Type Diskon (optional)</label>
    <select name="discount_type" id="discount_type" class="form-control">
        <option selected value="{{ $accomodation->room?->first()?->discount_type }}">{{ ucfirst($accomodation->room?->first()?->discount_type )}}</option>
        <option value="">Kosongkan jika tidak diisi</option>
        <option value="flat">Flat</option>
        <option value="persen">Persen</option>
    </select>
</div>

<div id="discount-container">
     <div class="form-group discount_amount">
        <label for="price">Jumlah Diskon</label>
        <input name="discount_amount" type="number" class="form-control form-control-lg" value="{{ $accomodation->room?->first()?->discount_amount }}">
    </div>
</div>

<div class="form-group mt-2">
    <label for="price">Deskripsi Penginapan (optional)</label>
    <textarea class="form-control" name="description_room" cols="30" rows="6">{{ $accomodation->room?->first()?->description }}</textarea>
</div>