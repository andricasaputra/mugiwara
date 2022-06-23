@csrf
<div class="form-group">
    <label for="type_id">Nama penginapan</label>
    <input type="text" class="form-control" value="{{ old('name') }}">
</div>

<div class="form-group">
    <label for="price">Kota</label>
    <select name="city" class="form-control js-example-basic-single">
        @foreach($cities as $city)

            <option value="{{ $city->city_id }}">{{ $city->city_name }}</option>

        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="price">Alamat Lengkap</label>
    <textarea class="form-control" name="address" cols="30" rows="3">
        {{ old('address') }}
    </textarea>
</div>
