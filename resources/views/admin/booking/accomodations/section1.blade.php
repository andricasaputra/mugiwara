@csrf
<div class="form-group">
    <label for="type_id">Nama penginapan</label>
    <input name="name" type="text" class="form-control" value="{{ old('name') }}">
</div>

<div class="form-group">
    <label for="city">Kota</label>
    <select name="regencies" class="form-control" id="js-example-basic-single" style="width: 100%;">
        @foreach($regencies as $regency)
            <option value="{{ $regency->id }}">{{ $regency->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="price">Alamat Lengkap</label>
    <textarea class="form-control" name="address" cols="30" rows="3">{{ old('address') }}</textarea>
</div>
