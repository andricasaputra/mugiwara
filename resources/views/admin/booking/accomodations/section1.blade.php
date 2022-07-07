@csrf
<div class="form-group">
    <label for="type_id">Nama penginapan</label>
    <input name="name" type="text" class="form-control" value="{{ old('name') }}">
</div>

<div class="form-group">
    <label for="city">Pilih Provinsi</label>
    <select name="province_id" class="form-control province" id="js-example-basic-single" style="width: 100%;">
        @foreach($provinces as $province)
            <option value="{{ $province->id }}">{{ $province->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group regencies-container">
    <label for="city">Kota</label>
    <select name="regencies" class="form-control regencies" id="js-example-basic-single-regencies" style="width: 100%;">
    </select>
</div>

<div class="form-group districts-container">
    <label for="city">Kecamatan</label>
    <select name="districts" class="form-control districts" id="js-example-basic-single-districts" style="width: 100%;">
    </select>
</div>

<div class="form-group">
    <label for="price">Alamat Lengkap</label>
    <textarea class="form-control" name="address" cols="30" rows="3">{{ old('address') }}</textarea>
</div>
