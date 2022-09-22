<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">

    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
        <i class="mr-2"><img src="{{ url('storage/icons/dashboard.png') }}" alt="icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    @php

      $menus = \App\Models\ManajemanMenu::with(['image', 'role', 'childs'])->oldest('id')->get();
    @endphp

    @foreach($menus as  $key => $menu)

      @if($menu->is_active == 1 && in_array(2, $menu->role?->pluck('role_id')->toArray()))

        @if(count($menu->childs) > 0)

         <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#{{ str_replace(" ", "", $menu->name) . $key }}" aria-expanded="false" aria-controls="{{ str_replace(" ", "", $menu->name) . $key }}">
              <i><img src="{{ url('storage/icons/' . $menu->image?->image) }}" alt="icon"></i>
              <span class="menu-title ml-2">{{ ucwords($menu->name) }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="{{ str_replace(" ", "", $menu->name) . $key }}">
              <ul class="nav flex-column sub-menu">

                 @foreach($menu->childs as $child)

                  @if($child->is_active == 1)

                    <li class="nav-item">
                      <a class="nav-link" href="{{ url('admin/' . $child->url) }}">{{ ucwords($child->name) }}</a>
                    </li>

                  @endif

                 @endforeach

              </ul>
            </div>
          </li>

        @else

           <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/' . $menu->url) }}">
                <i><img src="{{ url('storage/icons/' . $menu->image?->image) }}" alt="icon"></i>
                <span class="menu-title ml-2">{{ ucwords($menu->name) }}</span>
              </a>
            </li>

        @endif

      @endif

    @endforeach

    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#setting" aria-expanded="false" aria-controls="setting">
          <i class="mr-2"><img src="{{ url('storage/icons/settings.png') }}" alt="icon"></i>
          <span class="menu-title">Setting</span>
          <i class="menu-arrow"></i>
        </a>

        <div id="setting" class="collapse" >
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.settings.point.index') }}"> Poin </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.settings.payment') }}"> List Metode Pembayaran </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.settings.tax') }}"> Pajak </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.playstores.index') }}"> Play Store </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.appstores.index') }}"> App Store </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.menus.index') }}"> Manajemen Menu </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.payments_methods.index') }}"> Cara Pembayaran </a></li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#compro" aria-expanded="false" aria-controls="setting">
          <i class="mr-2"><img src="{{ url('storage/icons/settings.png') }}" alt="icon"></i>
          <span class="menu-title">Compro</span>
          <i class="menu-arrow"></i>
        </a>



        <div id="compro" class="collapse" >
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.general-settings.general-settings') }}"> General </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.menu.menu') }}"> Menu </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.beranda.beranda') }}"> Beranda </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.beranda-tentang.beranda-tentang') }}"> Tentang </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.beranda-overview.beranda-overview') }}"> Overview </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.mitra-section.mitra-section') }}"> Mitra </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.mitra-registran.mitra-registran') }}"> Mitra Registran </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.beranda-informasi.beranda-informasi') }}"> Informasi </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.slider.slider') }}"> Slider </a></li>
            <!-- <li class="nav-item"> <a class="nav-link" href="{{ route('admin.slider-tentang.slider-tentang') }}"> Slider Tentang </a></li> -->
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.sliderFitur.sliderFitur') }}"> Slider Fitur </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.slider-mitra.slider-mitra') }}"> Slider Mitra </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.pendaftaran.pendaftaran') }}"> Pendaftaran </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.syarat-dokumen.syarat-dokumen') }}"> Syarat & Dokumen </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.visiMisi.visiMisi') }}"> Visi & Misi </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.teamHeader.teamHeader') }}"> Team Header </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.pertanyaan.pertanyaan') }}"> Pertanyaan </a></li>
            <!-- <li class="nav-item"> <a class="nav-link" href="{{ route('admin.sosmed.sosmed') }}"> Sosmed Footer </a></li> -->
            <!-- <li class="nav-item"> <a class="nav-link" href="{{ route('admin.alamat.alamat') }}"> Alamat Footer </a></li> -->
            <!-- <li class="nav-item"> <a class="nav-link" href="{{ route('admin.kontak.kontak') }}"> Kontak </a></li> -->
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.hubungiKami.hubungiKami') }}"> Hubungi Kami </a></li>
            <!-- <li class="nav-item"> <a class="nav-link" href="{{ route('admin.aboutAwal.aboutAwal') }}"> Keterangan Slider </a></li> -->
            {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('admin.keteranganSlider.keteranganSlider') }}"> Keterangan Slider </a></li> --}}
            <!-- <li class="nav-item"> <a class="nav-link" href="{{ route('admin.aboutPertama.aboutPertama') }}"> About Pertama </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.aboutKedua.aboutKedua') }}"> About Keudua </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.keteranganFitur.keteranganFitur') }}"> Keterangan Fitur </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.mitraGabung.mitraGabung') }}"> Mitra Gabung </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.tombol') }}"> Recruitment
            </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.sosmed.sosmed') }}"> Sosmed Footer </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.alamat.alamat') }}"> Alamat Footer </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.kontak.kontak') }}"> Kontak </a></li> -->
            {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('admin.sliderMitra.sliderMitra') }}"> Slider Mitra </a></li> --}}
            <!-- <li class="nav-item"> <a class="nav-link" href="{{ route('admin.prosesPendaftaran.prosesPendaftaran') }}"> Proses Pendaftaran </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.syarat.syarat') }}"> Syarat Pendaftaran </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.documentUnduh.documentUnduh') }}"> Document Unduh </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.teamHeader.teamHeader') }}"> Team Header </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.visiMisi.visiMisi') }}"> Visi dan Misi </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.pertanyaan.pertanyaan') }}"> Pertanyaan </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.hubungiKami.hubungiKami') }}"> Hubungi Kami </a></li> -->
          </ul>
        </div>

        
      </li>


  </ul>
</nav>

@section('scripts')
  <script>
    let active = $('.active');

    $('li.nav-item').removeClass('active')
        $('div.collapse').removeClass('show')
  </script>
@endsection
