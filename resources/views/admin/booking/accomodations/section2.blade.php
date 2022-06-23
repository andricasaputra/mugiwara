
<div class="form-group">
    <label for="room_number">Nomor kamar</label>
    <input name="room_number" type="text" class="form-control form-control-lg"  required value="{{ old('room_number') }}">
</div>

<div class="form-group">
    <label for="type_id">Type kamar</label>
    <select name="type_id" class="form-control" id="">
        @foreach($types as $type)
            <option value="{{ $type->id }}">{{ $type->name }}</option>

        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="price">Maksimal Jumlah Tamu</label>
    <input name="max_guest" type="number" class="form-control form-control-lg"  required value="{{ old('max_guest') }}">
</div>

<div class="form-group">
    <label for="price">Fasilitas Kamar</label>
    <select name="facility" class="form-control form-control-lg js-example-tokenizer" multiple="multiple" style="width: 100%">
        @foreach($facilities as $facility)
            <option value="{{ $facility->id }}">{{ $facility->name }}</option>

        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="price">Harga / malam</label>
    <input name="price" type="number" class="form-control form-control-lg"  required value="{{ old('price') }}">
</div>

<div class="form-group">
    <label for="price">Diskon (optional)</label>
    <input name="discount" type="number" class="form-control form-control-lg" value="{{ old('discount') }}">
</div>
