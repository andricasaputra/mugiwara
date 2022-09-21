@csrf
<div class="form-group">
    <label for="type_id">Nama penginapan</label>
    <input name="name" type="text" class="form-control" value="{{ $accomodation->name }}">
</div>

<div class="form-group">
    <label for="city">Pilih Provinsi</label>
    <select name="province_id" class="form-control province" id="js-example-basic-single" style="width: 100%; height:">
        <option selected value="{{ $accomodation->province->id }}">{{ $accomodation->province->name }}</option>
        @foreach($provinces as $province)
            <option value="{{ $province->id }}">{{ $province->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="city">Kota</label>
    <select name="regency_id" class="form-control regencies" id="js-example-basic-single-regencies" style="width: 100%;">
        <option selected value="{{ $accomodation->regency->id }}">{{ $accomodation->regency->name }}</option>
        @foreach($regencies as $regency)
            <option value="{{ $regency->id }}">{{ $regency->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="city">Kecamatan</label>
    <select name="districts_id" class="form-control districts" id="js-example-basic-single-districts" style="width: 100%;">
        <option selected value="{{ $accomodation->districts?->id }}">{{ $accomodation->districts?->name }}</option>
        @foreach($districts as $district)
            <option value="{{ $district->id }}">{{ $district->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="address">Alamat Lengkap</label>
    <textarea class="form-control" name="address" cols="30" rows="3">{{ $accomodation->address }}</textarea>
</div>

<div class="form-inline-group">
   <div class="form-row">
    <div class="col">
        <label for="inputEmail4">Lokasi latitude</label>
        <input type="text" class="form-control" placeholder="latitude" name="lat" value="{{ $accomodation->lat }}">
    </div>
    <div class="col">
        <label for="inputEmail4">Lokasi longatitude</label>
        <input type="text" class="form-control" placeholder="longatitude" name="lang" value="{{ $accomodation->lang }}">
    </div>
  </div>
</div>

<div class="form-group mt-2">
    <label for="price">Deskripsi Penginapan (optional)</label>
    <textarea class="form-control" name="description" cols="30" rows="6">{{ $accomodation->description }}</textarea>
</div>

<div class="form-group mt-2">
    <label for="price">Is Active</label>
   <select name="is_active" class="form-control">
    @if($accomodation->is_active == 1)
        <option value="1" selected>Ya</option>
        <option value="">Tidak</option>
    @else
         <option value="" selected>Tidak</option>
         <option value="1">Ya</option>
    @endif
    
   </select>
</div>





