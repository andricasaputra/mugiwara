
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
        @foreach($room->facilities as $room_facility)
            <option selected value="{{ $room_facility->id }}">{{ $room_facility->name }}</option>
        @endforeach
        @foreach($facilities as $facility)
            <option value="{{ $facility->id }}">{{ $facility->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="price">Harga / malam</label>
    <input name="price" type="text" id="element" class="form-control form-control-lg"  required value="{{ $room->price }}">
</div>

<div class="form-group">
    <label for="price">Diskon (optional)</label>
    <input name="discount" type="number" class="form-control form-control-lg" value="{{ $room->discount }}">
</div>
