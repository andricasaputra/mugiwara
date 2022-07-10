
<div class="form-group">
    <label for="room_number">Nomor kamar</label>
   
    <input name="room_number" type="text" class="form-control form-control-lg"  required value="{{ $room->room_number }}">
</div>

<div class="form-group">
    <label for="type_id">Type kamar</label>
    <select name="type_id" class="form-control" id="">
        <option value="{{ $room->type->id }}">{{ $room->type->name }}</option>
        @foreach($types as $type)
            <option value="{{ $type->id }}">{{ $type->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="price">Maksimal Jumlah Tamu</label>
    <input name="max_guest" type="number" class="form-control form-control-lg"  required value="{{ $room->max_guest}}">
</div>

<div class="form-group">
    <label for="price">Fasilitas Kamar</label>
    <select name="facility[]" class="form-control form-control-lg js-example-tokenizer" multiple="multiple" style="width: 100%">
        @foreach($room->facilities as $room_faility)
            <option selected value="{{ $room_faility->id }}">{{ $room_faility->name }}</option>
        @endforeach
        @foreach($facilities as $facility)
            <option value="{{ $facility->id }}">{{ $facility->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="price">Harga / malam</label>
    <input name="price" type="number" class="form-control form-control-lg"  required value="{{ $room->price }}">
</div>

<div class="form-group">
    <label for="price">Type Diskon (optional)</label>
    <select name="discount_type" id="discount_type" class="form-control">
        <option selected value="{{ $room->discount_type }}">{{ ucfirst($room->discount_type )}}</option>
        <option value="">Kosongkan jika tidak diisi</option>
        <option value="flat">Flat</option>
        <option value="persen">Persen</option>
    </select>
</div>

<div id="discount-container">
     <div class="form-group discount_amount">
        <label for="price">Jumlah Diskon</label>
        <input name="discount_amount" type="number" class="form-control form-control-lg" value="{{ $room->discount_amount }}">
    </div>
</div>

<div class="form-group mt-2">
    <label for="price">Deskripsi Penginapan (optional)</label>
    <textarea class="form-control" name="description_room" cols="30" rows="6">{{ $room->description_room }}</textarea>
</div>