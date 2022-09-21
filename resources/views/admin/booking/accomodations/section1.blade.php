@csrf
<div class="form-group">
    <label for="type_id">Nama penginapan</label>
    <input name="name" type="text" class="form-control" value="{{ old('name') }}">
</div>

<div class="form-group">
    <label for="city">Provinsi</label>
    <select name="province_id" class="form-control province" id="js-example-basic-single" style="width: 100%;">
        @foreach($provinces as $province)
            <option value="{{ $province->id }}">{{ $province->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group regencies-container">
    <label for="city">Kota</label>
    <select name="regency_id" class="form-control regencies" id="js-example-basic-single-regencies" style="width: 100%;">
    </select>
</div>

<div class="form-group districts-container">
    <label for="city">Kecamatan</label>
    <select name="districts_id" class="form-control districts" id="js-example-basic-single-districts" style="width: 100%;">
    </select>
</div>

<div class="form-group">
    <label for="price">Alamat Lengkap</label>
    <textarea class="form-control" name="address" cols="30" rows="3">{{ old('address') }}</textarea>
</div>

<div class="form-inline-group">
   <div class="form-row">
    <div class="col">
        <label for="inputEmail4">Lokasi latitude</label>
        <input type="text" class="form-control" placeholder="latitude" name="lat" value="{{ old('lat') }}">
    </div>
    <div class="col">
        <label for="inputEmail4">Lokasi longatitude</label>
        <input type="text" class="form-control" placeholder="longatitude" name="lang" value="{{ old('lang') }}">
    </div>
  </div>
</div>

<div class="form-group mt-2">
    <label for="price">Deskripsi Penginapan (optional)</label>
    <textarea class="form-control" name="description_acc" cols="30" rows="6">{{ old('description_acc') }}</textarea>
</div>

<div class="form-group mt-2">
    <label for="price">Is Active</label>
   <select name="is_active" class="form-control">
        <option value="1" selected>Ya</option>
         <option value="">Tidak</option>
   </select>
</div>



