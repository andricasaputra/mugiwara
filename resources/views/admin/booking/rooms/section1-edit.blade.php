
<div class="form-group">
    <label for="room_numbers">Nomor Kamar</label>
    <select name="room_numbers[]" class="form-control form-control-lg js-example-tokenizer" multiple="multiple" style="width: 100%">
        @php
            $n = [];
    @endphp
        @foreach($accomodation->room as $room)
        @php $n[] = $room->room_number @endphp
         <option value="{{ $room->room_number }}" selected>{{ $room->room_number }}</option>
        @endforeach
        @foreach($numbers as $number)
            @if(!in_array($number->number, $n))
                <option value="{{ $number->number }}">{{ $number->number }}</option>
            @endif
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
    <input name="max_guest" type="number" class="form-control form-control-lg" minlength="1" min="1" required value="{{ $accomodation->room?->first()?->max_guest}}">
</div>

<div class="form-group">
    <label for="price">Fasilitas Kamar</label>
    <select name="facility[]" class="form-control form-control-lg js-example-tokenizer" multiple="multiple" style="width: 100%">
        @php
            $f = [];
        @endphp
        @foreach($accomodation->room?->first()?->facilities ?? [] as $room_faility)
            @php $f[] = $room_faility->name; @endphp
            <option selected value="{{ $room_faility->id }}">{{ $room_faility->name }}</option>
        @endforeach
        @foreach($facilities as $facility)
            @if(!in_array($facility->name, $f))
                <option value="{{ $facility->id }}">{{ $facility->name }}</option>
            @endif
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
        <option value="percent">Persen</option>
    </select>
</div>

<div id="discount-container">
     <div class="form-group discount_amount">
        <label for="discount_amount">Jumlah Diskon</label>
        <input name="discount_amount" type="number" class="form-control form-control-lg" value="{{ $accomodation->room?->first()?->discount_amount }}">
    </div>
</div>

<div class="form-group mt-2">
    <label for="description_room">Deskripsi Penginapan (optional)</label>
    <textarea class="form-control" name="description_room" cols="30" rows="6">{{ $accomodation->room?->first()?->description }}</textarea>
</div>