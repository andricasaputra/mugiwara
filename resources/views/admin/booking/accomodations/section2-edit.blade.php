
<div class="form-group">
    <label for="room_number">Nomor kamar</label>
   
    <input name="room_number" type="text" class="form-control form-control-lg"  required value="{{ $rooms->room_number }}">
</div>

<div class="form-group">
    <label for="type_id">Type kamar</label>
    <select name="type_id" class="form-control" id="">
        <option value="{{ $rooms->type->id }}">{{ $rooms->type->name }}</option>
        @foreach($types as $type)
            <option value="{{ $type->id }}">{{ $type->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="price">Maksimal Jumlah Tamu</label>
    <input name="max_guest" type="number" class="form-control form-control-lg" minlength="1" min="1" required value="{{ $rooms->max_guest}}">
</div>

<div class="form-group">
    <label for="price">Fasilitas Kamar</label>
    <select name="facility[]" class="form-control form-control-lg js-example-tokenizer" multiple="multiple" style="width: 100%">
        <option selected value="{{ $rooms->facilities->id }}">{{ $rooms->facilities->name }}</option>
        @foreach($facilities as $facility)
            <option value="{{ $facility->id }}">{{ $facility->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="price">Harga / malam</label>
    <input name="price" type="number" class="form-control form-control-lg"  required value="{{ $rooms->price }}">
</div>

<div class="form-group">
    <label for="price">Type Diskon (optional)</label>
    <select name="discount_type" id="discount_type" class="form-control">
        <option value="{{ $room->discount_type }}">{{ ucfirst($room->discount_type )}}</option>
        <option value="">Kosongkan jika tidak diisi</option>
        <option value="flat">Flat</option>
        <option value="percent">Persen</option>
    </select>
</div>

<div id="discount-container"></div>


<div class="form-group mt-2">
    <label for="price">Deskripsi Kamar (optional)</label>
    <textarea class="form-control" name="description_room" cols="30" rows="6">{{ $rooms->description_room }}</textarea>
</div>