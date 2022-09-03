
{{-- <div class="form-group">
    <label for="room_number">Nomor kamar</label>
    <input name="room_number" type="text" class="form-control form-control-lg"  required value="{{ old('room_number') }}">
</div> --}}

<div class="form-group">
    <label for="type_id">Type kamar</label>
    <select name="type_id" class="form-control" id="">
        @foreach($types as $type)
            <option value="{{ $type->id }}">{{ ucfirst($type->name) }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="price">Maksimal Jumlah Tamu</label>
    <input name="max_guest" type="number" class="form-control form-control-lg"  required value="{{ old('max_guest') }}">
</div>

<div class="form-group">
    <label for="price">Fasilitas Kamar</label>
    <select name="facility[]" class="form-control form-control-lg js-example-tokenizer" multiple="multiple" style="width: 100%">
        @foreach($facilities as $facility)
            <option value="{{ $facility->id }}">{{ $facility->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="room_numbers">Nomor Kamar</label>
    <select name="room_numbers[]" class="form-control form-control-lg js-example-tokenizer" multiple="multiple" style="width: 100%">
        @foreach($numbers as $number)
            <option value="{{ $number->id }}">{{ $number->number }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="price">Harga / malam</label>
    <input name="price" class="form-control" type="text" id="element">
</div>

<div class="form-group">
    <label for="price">Type Diskon (optional)</label>
    <select name="discount_type" id="discount_type" class="form-control">
        <option value="">Kosongkan jika tidak diisi</option>
        <option value="flat">Flat</option>
        <option value="percent">Persen</option>
    </select>
</div>

<div id="discount-container"></div>

<div class="form-group">
    <label for="images">Apakah Terdapat Refund?</label>
    <select name="is_refunded" class="form-control">
        <option value="1">Ya</option>
        <option value="">Tidak</option>
    </select>
</div>

<div class="form-group mt-2">
    <label for="price">Deskripsi Penginapan (optional)</label>
    <textarea class="form-control" name="description_room" cols="30" rows="6">{{ old('description_room') }}</textarea>
</div>