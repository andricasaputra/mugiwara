<div class="form-group">
    <label for="price">Harga / malam</label>
    <input name="price" type="number" class="form-control form-control-lg"  required value="{{ $accomodation->room?->first()?->price }}">
</div>

<div class="form-group">
    <label for="price">Type Diskon (optional)</label>
    <select name="discount_type" id="discount_type" class="form-control">
        @if($accomodation->room?->first()?->discount_type == 'percent')
            <option value="percent" selected>Persen</option>
            <option value="flat">Flat</option>
            <option value="">Tanpa Diskon</option>
        @elseif($accomodation->room?->first()?->discount_type == 'flat')
            <option value="flat" selected>Flat</option>
            <option value="percent">Persen</option>
            <option value="">Tanpa Diskon</option>
        @else
            <option value="" selected>Tanpa Diskon</option>
            <option value="flat">Flat</option>
            <option value="percent">Persen</option>
        @endif
    </select>
</div>

<div id="discount-container">
     <div class="form-group discount_amount">
        <label for="discount_amount">Jumlah Diskon</label>
        <input name="discount_amount" type="number" class="form-control form-control-lg" value="{{ $accomodation->room?->first()?->discount_amount }}">
    </div>
</div>

