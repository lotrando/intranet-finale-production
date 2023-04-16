<div class="navbar-expand-md sticky-top shadow">
  <div class="navbar-collapse collapse" id="navbar-menu">
    <div class="navbar navbar-light">
      <div class="row">
        <div class="col-12">
          <ul class="navbar-nav">
            @foreach ($navitems as $navitem)
              <li class="nav-item {{ request()->segment(1) == $navitem->route ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-original-title="{{ __($navitem->tooltip) }}">
                <a class="nav-link" href="{{ route($navitem->route) }}">
                  <span class="nav-link-icon d-inline-block {{ $navitem->icon_class }}">
                    {!! $navitem->svg_icon !!}
                  </span>
                  <span class="nav-link-title d-block d-md-inline d-lg-inline d-xl-inline">
                    {{-- {{ __($navitem->name) }} --}}
                  </span>
                </a>
              </li>
            @endforeach
            {{-- Oznámení Dropdown --}}
            <li class="nav-item dropdown {{ request()->segment(1) == 'oznameni' ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-original-title="Co se děje na intranetu KHN">
              <a class="nav-link" data-bs-toggle="dropdown" data-bs-auto-close="outside" href="" role="button" aria-expanded="false">
                <span class="nav-link-icon d-inline-block d-sm-inline-block d-mg-none d-lg-none d-xl-none d-xxl-inline-block">
                  <svg class="icon icon-tabler text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <circle cx="12" cy="12" r="9"></circle>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    <polyline points="11 12 12 12 12 16 13 16"></polyline>
                  </svg>
                </span>
                <span class="nav-link-title d-block d-md-none d-md-inline d-lg-inline d-xl-inline">
                  {{ __('Oznámení') }}
                </span>
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item {{ request()->segment(2) == 'prehledy' ? 'active' : '' }}"
                  href="{{ url('https://www.sukl.cz/souhrny-informaci-o-lecivech') }}" target="_blank">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg class="icon text-red" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="2"
                      stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path
                        d="M13 3a1 1 0 0 1 1 1v4.535l3.928 -2.267a1 1 0 0 1 1.366 .366l1 1.732a1 1 0 0 1 -.366 1.366l-3.927 2.268l3.927 2.269a1 1 0 0 1 .366 1.366l-1 1.732a1 1 0 0 1 -1.366 .366l-3.928 -2.269v4.536a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-4.536l-3.928 2.268a1 1 0 0 1 -1.366 -.366l-1 -1.732a1 1 0 0 1 .366 -1.366l3.927 -2.268l-3.927 -2.268a1 1 0 0 1 -.366 -1.366l1 -1.732a1 1 0 0 1 1.366 -.366l3.928 2.267v-4.535a1 1 0 0 1 1 -1h2z">
                      </path>
                    </svg>
                  </span>
                  <span>
                    {{ __('SÚKL měsíční přehledy') }}
                  </span>
                  <span class="badge badge-sm bg-red-lt text-uppercase ms-auto">www odkaz</span>
                </a>
                <a class="dropdown-item {{ request()->segment(2) == 'prehledy' ? 'active' : '' }}"
                  href="{{ url('https://www.sukl.cz/modules/unregistered/?rewrite=modules/unregistered') }}" target="_blank">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg class="icon text-red" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="2"
                      stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path
                        d="M13 3a1 1 0 0 1 1 1v4.535l3.928 -2.267a1 1 0 0 1 1.366 .366l1 1.732a1 1 0 0 1 -.366 1.366l-3.927 2.268l3.927 2.269a1 1 0 0 1 .366 1.366l-1 1.732a1 1 0 0 1 -1.366 .366l-3.928 -2.269v4.536a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-4.536l-3.928 2.268a1 1 0 0 1 -1.366 -.366l-1 -1.732a1 1 0 0 1 .366 -1.366l3.927 -2.268l-3.927 -2.268a1 1 0 0 1 -.366 -1.366l1 -1.732a1 1 0 0 1 1.366 -.366l3.928 2.267v-4.535a1 1 0 0 1 1 -1h2z">
                      </path>
                    </svg>
                  </span>
                  <span class="nav-link-title">
                    {{ __('SÚKL formulář') }}
                  </span>
                  <span class="badge badge-sm bg-red-lt text-uppercase ms-auto">www odkaz</span>
                </a>
                <a class="dropdown-item {{ request()->segment(2) == 'zmeny-standardu' ? 'active' : '' }}" href="{{ route('oznameni.zmeny-standardu') }}">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg class="icon text-purple" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                      stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M14 20h-8a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12v5"></path>
                      <path d="M11 16h-5a2 2 0 0 0 -2 2"></path>
                      <path d="M15 16l3 -3l3 3"></path>
                      <path d="M18 13v9"></path>
                    </svg>
                  </span>
                  <span class="nav-link-title">
                    {{ __('Změny ve standardech') }}
                  </span>
                  <span class="badge badge-sm bg-purple-lt text-uppercase ms-auto">{{ $changedStands->count() }}</span>
                </a>
                <a class="dropdown-item {{ request()->segment(2) == 'zmeny-v-dokumentaci' ? 'active' : '' }}"
                  href="{{ route('oznameni.zmeny-v-dokumentaci') }}">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg class="icon text-pink" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                      stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                      <rect x="9" y="3" width="6" height="4" rx="2"></rect>
                      <path d="M9 14l2 2l4 -4"></path>
                    </svg>
                  </span>
                  <span class="nav-link-title">
                    {{ __('Změny v dokumentaci') }}
                  </span>
                  <span class="badge badge-sm bg-pink-lt text-uppercase ms-auto">{{ $changedDocs->count() }}</span>
                </a>
                @foreach ($types as $type)
                  <a class="dropdown-item {{ request()->segment(2) == $type->type_route ? 'active' : '' }}"
                    href="{{ route($type->type_route . '', $type->id) }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      {!! $type->svg_icon !!}
                    </span>
                    <span class="nav-link-title">
                      {{ $type->type_name }}
                    </span>
                    <span
                      class="badge badge-sm bg-{{ $type->type_color }}-lt text-uppercase ms-auto">{{ $type->notification->where('status', 'Zobrazeno')->count() }}</span>
                  </a>
                @endforeach
              </div>
            </li>
            {{-- Stravování --}}
            <li class="nav-item dropdown {{ request()->segment(1) == 'stravovani' ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-original-title="Nabídky stravovacího provozu">
              <a class="nav-link" data-bs-toggle="dropdown" data-bs-auto-close="outside" href="#" role="button" aria-expanded="false">
                <span class="nav-link-icon d-inline-block d-sm-inline-block d-mg-none d-lg-none d-xl-none d-xxl-inline-block">
                  <svg class="icon icon-tabler icon-tabler-tools-kitchen-2 text-cyan" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M19 3v12h-5c-.023 -3.681 .184 -7.406 5 -12zm0 12v6h-1v-3m-10 -14v17m-3 -17v3a3 3 0 1 0 6 0v-3">
                    </path>
                  </svg>
                </span>
                <span class="nav-link-title d-block d-md-none d-md-inline d-lg-inline d-xl-inline">
                  {{ __('Stravování') }}
                </span>
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item {{ request()->segment(2) == 'obedy' ? 'active' : '' }}" href="{{ route('stravovani.obedy') }}" target="_blank">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg class="icon icon-tabler icon-tabler-meat text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                      stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M13.62 8.382l1.966 -1.967a2 2 0 1 1 3.414 -1.415a2 2 0 1 1 -1.413 3.414l-1.82 1.821">
                      </path>
                      <path
                        d="M5.904 18.596c2.733 2.734 5.9 4 7.07 2.829c1.172 -1.172 -.094 -4.338 -2.828 -7.071c-2.733 -2.734 -5.9 -4 -7.07 -2.829c-1.172 1.172 .094 4.338 2.828 7.071z">
                      </path>
                      <path d="M7.5 16l1 1"></path>
                      <path d="M12.975 21.425c3.905 -3.906 4.855 -9.288 2.121 -12.021c-2.733 -2.734 -8.115 -1.784 -12.02 2.121">
                      </path>
                    </svg>
                  </span>
                  <span class="nav-link-title">
                    {{ __('Objednávka obědů') }}
                  </span>
                  <span class="badge badge-sm bg-red-lt text-uppercase ms-auto">v novém okně</span>
                </a>
                <a class="dropdown-item {{ request()->segment(2) == 'kantyna' ? 'active' : '' }}" href="{{ route('stravovani.kantyna') }}">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg class="icon icon-tabler icon-tabler-baguette text-yellow" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                      stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path
                        d="M5.628 11.283l5.644 -5.637c2.665 -2.663 5.924 -3.747 8.663 -1.205l.188 .181a2.987 2.987 0 0 1 0 4.228l-11.287 11.274a2.996 2.996 0 0 1 -4.089 .135l-.143 -.135c-2.728 -2.724 -1.704 -6.117 1.024 -8.841z">
                      </path>
                      <path d="M9.5 7.5l1.5 3.5"></path>
                      <path d="M6.5 10.5l1.5 3.5"></path>
                      <path d="M12.5 4.5l1.5 3.5"></path>
                    </svg>
                  </span>
                  <span class="nav-link-title">
                    {{ __('Nabídka kantýny') }}
                  </span>
                </a>
              </div>
            </li>
            {{-- Email --}}
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Email KHN" href="https://email.khn.cz"
                target="_blank">
                <span class="nav-link-icon d-inline-block d-sm-inline-block d-mg-none d-lg-none d-xl-none d-xxl-inline-block">
                  <svg class="icon icon-tabler icon-tabler-mail text-yellow" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                    <polyline points="3 7 12 13 21 7"></polyline>
                  </svg>
                </span>
                <span class="nav-link-title d-block d-md-none d-md-inline d-lg-inline d-xl-inline">
                  {{ __('Pošta') }}
                </span>
              </a>
            </li>
            <li class="nav-item dropdown {{ request()->segment(1) == 'rozpisy-sluzeb' ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-original-title="Rozpisy služeb">
              <a class="nav-link" data-bs-toggle="dropdown" data-bs-auto-close="outside" href="" role="button" aria-expanded="false">
                <span class="nav-link-icon d-inline-block d-sm-inline-block d-mg-none d-lg-none d-xl-none d-xxl-inline-block">
                  <svg class="icon text-purple" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4"></path>
                    <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                    <path d="M15 3v4"></path>
                    <path d="M7 3v4"></path>
                    <path d="M3 11h16"></path>
                    <path d="M18 16.496v1.504l1 1"></path>
                  </svg>
                </span>
                <span class="nav-link-title d-block d-md-none d-md-inline d-lg-inline d-xl-inline">
                  {{ __('Služby') }}
                </span>
              </a>
              <div class="dropdown-menu">
                @foreach ($rozpisy as $rozpis)
                  <a class="dropdown-item {{ request()->segment(2) == $rozpis->folder_name ? 'active' : '' }}"
                    href="{{ route('rozpisy-sluzeb.' . $rozpis->folder_name . '', $rozpis->id) }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      {!! $rozpis->svg_icon !!}
                    </span>
                    <span class="nav-link-title">
                      {{ $rozpis->category_name }}
                    </span>
                  </a>
                @endforeach
              </div>
            </li>
            <li class="nav-item dropdown {{ request()->segment(1) == 'dokumenty' ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-original-title="Ddokumentace nemocnice">
              <a class="nav-link" data-bs-toggle="dropdown" data-bs-auto-close="outside" href="#" role="button" aria-expanded="false">
                <span class="nav-link-icon d-inline-block d-sm-inline-block d-mg-none d-lg-none d-xl-none d-xxl-inline-block">
                  <svg class="icon text-pink" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                    <rect x="9" y="3" width="6" height="4" rx="2"></rect>
                    <path d="M10 14h4"></path>
                    <path d="M12 12v4"></path>
                  </svg>
                </span>
                <span class="nav-link-title d-block d-md-none d-md-inline d-lg-inline d-xl-inline">
                  {{ __('Dokumentace') }}
                </span>
              </a>
              <div class="dropdown-menu">
                @foreach ($docs as $document)
                  <a class="dropdown-item {{ request()->segment(2) == $document->folder_name ? 'active' : '' }}"
                    href="{{ route('dokumenty.' . $document->folder_name . '', $document->id) }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      {!! $document->svg_icon !!}
                    </span>
                    <span class="nav-link-title">
                      {{ $document->category_name }}
                    </span>
                    <span class="badge badge-sm bg-{{ $document->color }}-lt text-uppercase ms-auto">{{ $document->documents->count() }}</span>
                  </a>
                @endforeach
              </div>
            </li>
            <li class="nav-item dropdown {{ request()->segment(1) == 'standardy' ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-original-title="Standardy nemocnice">
              <a class="nav-link" data-bs-toggle="dropdown" data-bs-auto-close="outside" href="#" role="button" aria-expanded="false">
                <span class="nav-link-icon d-inline-block d-sm-inline-block d-mg-none d-lg-none d-xl-none d-xxl-inline-block">
                  <svg class="icon text-purple" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z"></path>
                    <path d="M19 16h-12a2 2 0 0 0 -2 2"></path>
                    <path d="M9 8h6"></path>
                  </svg>
                </span>
                <span class="nav-link-title d-block d-md-none d-md-inline d-lg-inline d-xl-inline">
                  {{ __('Standardy') }}
                </span>
              </a>
              <div class="dropdown-menu">
                @foreach ($stands as $category)
                  <a class="dropdown-item {{ request()->segment(2) == $category->folder_name ? 'active' : '' }}"
                    href="{{ route('standardy.' . $category->folder_name . '', $category->id) }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      {!! $category->svg_icon !!}
                    </span>
                    <span class="nav-link-title">
                      {{ $category->category_name }}
                    </span>
                    <span class="badge badge-sm bg-{{ $category->color }}-lt text-uppercase ms-auto">{{ $category->documents->count() }}</span>
                  </a>
                @endforeach
              </div>
            </li>
            <li class="nav-item dropdown {{ request()->segment(1) == 'isp' ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-original-title="Informované souhlasy KHN a.s.">
              <a class="nav-link" href="{{ route('isp') }}">
                <span class="nav-link-icon d-inline-block d-sm-inline-block d-mg-none d-lg-none d-xl-none d-xxl-inline-block">
                  <svg class="icon text-azure" width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                    <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                    <path d="M9 14l2 2l4 -4"></path>
                  </svg>
                </span>
                <span class="nav-link-title d-block d-md-none d-md-inline d-lg-inline d-xl-inline">
                  {{ __('ISP') }}
                </span>
              </a>
            </li>
            <li class="nav-item dropdown {{ request()->segment(1) == 'bozp' ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-original-title="BOZP a PO dokumenty">
              <a class="nav-link" data-bs-toggle="dropdown" data-bs-auto-close="outside" href="" role="button" aria-expanded="false">
                <span class="nav-link-icon d-inline-block d-sm-inline-block d-mg-none d-lg-none d-xl-none d-xxl-inline-block">
                  <svg class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 21h14"></path>
                    <path d="M17 21v-5h1a1 1 0 0 0 1 -1v-2a1 1 0 0 0 -1 -1h-1v-4a5 5 0 0 0 -10 0v4h-1a1 1 0 0 0 -1 1v2a1 1 0 0 0 1 1h1v5">
                    </path>
                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                    <path d="M6 8h12"></path>
                  </svg>
                </span>
                <span class="nav-link-title d-block d-md-none d-md-inline d-lg-inline d-xl-inline">
                  {{ __('BOZP a PO') }}
                </span>
              </a>
              <div class="dropdown-menu">
                @foreach ($bozps as $bozp)
                  <a class="dropdown-item {{ request()->segment(2) == $bozp->folder_name ? 'active' : '' }}"
                    href="{{ route('bozp.' . $bozp->folder_name . '', $bozp->id) }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      {!! $bozp->svg_icon !!}
                    </span>
                    <span class="nav-link-title">
                      {{ $bozp->category_name }}
                    </span>
                    <span class="badge badge-sm bg-{{ $bozp->color }}-lt text-uppercase ms-auto">{{ $bozp->documents->count() }}</span>
                  </a>
                @endforeach
              </div>
            </li>
            <li class="nav-item dropdown {{ request()->segment(1) == 'indikatory-kvality' ? 'active' : '' }}" data-bs-toggle="tooltip"
              data-bs-placement="top" data-bs-original-title="Indikátory kvality">
              <a class="nav-link" data-bs-toggle="dropdown" data-bs-auto-close="outside" href="" role="button" aria-expanded="false">
                <span class="nav-link-icon d-inline-block d-sm-inline-block d-mg-none d-lg-none d-xl-none d-xxl-inline-block">
                  <svg class="icon text-blue" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M14 6m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                    <path d="M4 6l8 0"></path>
                    <path d="M16 6l4 0"></path>
                    <path d="M8 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                    <path d="M4 12l2 0"></path>
                    <path d="M10 12l10 0"></path>
                    <path d="M17 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                    <path d="M4 18l11 0"></path>
                    <path d="M19 18l1 0"></path>
                  </svg>
                </span>
                <span class="nav-link-title d-block d-md-none d-md-inline d-lg-inline d-xl-inline">
                  {{ __('Kvalita') }}
                </span>
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item {{ request()->segment(1) == 'adversevents' ? 'bg-primary-lt' : '' }}" data-bs-toggle="tooltip"
                  data-bs-placement="bottom" data-bs-original-title="Odeslat nežádoucí událost" href="{{ route('adversevents.index') }}" rel="noreferrer">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                      stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M12 9v2m0 4v.01"></path>
                      <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75"></path>
                    </svg>
                  </span>
                  <span class="nav-link-title">
                    {{ __('Nežádoucí události') }}
                  </span>
                  <span class="badge badge-sm bg-red-lt text-uppercase ms-auto">{{ App\Models\Adversevent::all()->count() }}</span>
                </a>
                <hr class="d-sm-none d-md-none d-lg-inline my-1">
                @foreach ($indikators as $indikator)
                  <a class="dropdown-item {{ request()->segment(2) == $indikator->folder_name ? 'active' : '' }}"
                    href="{{ route($indikator->category_file . '.' . $indikator->folder_name . '', $indikator->id) }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      {!! $indikator->svg_icon !!}
                    </span>
                    <span class="nav-link-title">
                      {{ $indikator->category_name }}
                    </span>
                    <span class="badge badge-sm bg-{{ $indikator->color }}-lt text-uppercase ms-auto">{{ $indikator->documents->count() }}</span>
                  </a>
                @endforeach
              </div>
            </li>
            <li class="nav-item dropdown {{ request()->segment(1) == 'akreditace' ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-original-title="Akreditace">
              <a class="nav-link" data-bs-toggle="dropdown" data-bs-auto-close="outside" href="" role="button" aria-expanded="false">
                <span class="nav-link-icon d-inline-block d-sm-inline-block d-mg-none d-lg-none d-xl-none d-xxl-inline-block">
                  <svg class="icon text-purple" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12 15m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                    <path d="M10 7h4"></path>
                    <path d="M10 18v4l2 -1l2 1v-4"></path>
                    <path d="M10 19h-2a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-2"></path>
                  </svg>
                </span>
                <span class="nav-link-title d-block d-md-none d-md-inline d-lg-inline d-xl-inline">
                  {{ __('Akreditace') }}
                </span>
              </a>
              <div class="dropdown-menu">
                @foreach ($akreditace as $akredit)
                  <a class="dropdown-item {{ request()->segment(2) == $akredit->folder_name ? 'active' : '' }}"
                    href="{{ route('akreditace.' . $akredit->folder_name . '', $akredit->id) }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      {!! $akredit->svg_icon !!}
                    </span>
                    <span class="nav-link-title">
                      {{ $akredit->category_name }}
                    </span>
                    <span class="badge badge-sm bg-{{ $akredit->color }}-lt text-uppercase ms-auto">{{ $akredit->documents->count() }}</span>
                  </a>
                @endforeach
              </div>
            </li>
            <li class="nav-item dropdown {{ request()->segment(1) == 'ridici-akty' ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-original-title="Řídící akty">
              <a class="nav-link" data-bs-toggle="dropdown" data-bs-auto-close="outside" href="" role="button" aria-expanded="false">
                <span class="nav-link-icon d-inline-block d-sm-inline-block d-mg-none d-lg-none d-xl-none d-xxl-inline-block">
                  <svg class="icon text-pink" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                    <path d="M12 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                    <path d="M12 14l0 7"></path>
                    <path d="M10 12l-6.75 -2"></path>
                    <path d="M14 12l6.75 -2"></path>
                  </svg>
                </span>
                <span class="nav-link-title d-block d-md-none d-md-inline d-lg-inline d-xl-inline">
                  {{ __('Řídící akty') }}
                </span>
              </a>
              <div class="dropdown-menu">
                @foreach ($acts as $act)
                  <a class="dropdown-item {{ request()->segment(2) == $act->folder_name ? 'active' : '' }}"
                    href="{{ route($act->category_file . '.' . $act->folder_name . '', $act->id) }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      {!! $act->svg_icon !!}
                    </span>
                    <span class="nav-link-title">
                      {{ $act->category_name }}
                    </span>
                    <span class="badge badge-sm bg-{{ $act->color }}-lt text-uppercase ms-auto">{{ $act->documents->count() }}</span>
                  </a>
                @endforeach
              </div>
            </li>
            <li class="nav-item dropdown {{ request()->segment(1) == 'porady' ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-original-title="Zápisy z porad">
              <a class="nav-link" data-bs-toggle="dropdown" data-bs-auto-close="outside" href="" role="button" aria-expanded="false">
                <span class="nav-link-icon d-inline-block d-sm-inline-block d-mg-none d-lg-none d-xl-none d-xxl-inline-block">
                  <svg class="icon text-teal" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M16 6h3a1 1 0 0 1 1 1v11a2 2 0 0 1 -4 0v-13a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1v12a3 3 0 0 0 3 3h11"></path>
                    <path d="M8 8l4 0"></path>
                    <path d="M8 12l4 0"></path>
                    <path d="M8 16l4 0"></path>
                  </svg>
                </span>
                <span class="nav-link-title d-block d-md-none d-md-inline d-lg-inline d-xl-inline">
                  {{ __('Porady') }}
                </span>
              </a>
              <div class="dropdown-menu">
                @foreach ($porady as $porada)
                  <a class="dropdown-item {{ request()->segment(2) == $porada->folder_name ? 'active' : '' }}"
                    href="{{ route($porada->category_file . '.' . $porada->folder_name . '', $porada->id) }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      {!! $porada->svg_icon !!}
                    </span>
                    <span class="nav-link-title">
                      {{ $porada->category_name }}
                    </span>
                    <span class="badge badge-sm bg-{{ $porada->color }}-lt text-uppercase ms-auto">{{ $porada->documents->count() }}</span>
                  </a>
                @endforeach
              </div>
            </li>
            <li class="nav-item dropdown {{ request()->segment(1) == 'media' ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-original-title="Radio, Video, Překladatelé...">
              <a class="nav-link" data-bs-toggle="dropdown" data-bs-auto-close="outside" href="#" role="button" aria-expanded="false">
                <span class="nav-link-icon d-inline-block d-sm-inline-block d-mg-none d-lg-none d-xl-none d-xxl-inline-block">
                  <svg class="icon icon-tabler icon-tabler-device-tv-old text-lime" width="40" height="40" viewBox="0 0 24 24" stroke-width="21"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <rect x="3" y="7" width="18" height="13" rx="2"></rect>
                    <path d="M16 3l-4 4l-4 -4"></path>
                    <path d="M15 7v13"></path>
                    <path d="M18 15v.01"></path>
                    <path d="M18 12v.01"></path>
                  </svg>
                </span>
                <span class="nav-link-title d-block d-md-none d-md-inline d-lg-inline d-xl-inline">
                  {{ __('Média') }}
                </span>
              </a>
              <div class="dropdown-menu">
                <div class="dropdown">
                  <a class="dropdown-item{{ request()->segment(2) == 'radio' ? 'active' : '' }}" href="{{ route('media.radio') }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <svg class="icon text-orange" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M14 3l-9.371 3.749a1 1 0 0 0 -.629 .928v11.323a1 1 0 0 0 1 1h14a1 1 0 0 0 1 -1v-11a1 1 0 0 0 -1 -1h-14.5">
                        </path>
                        <path d="M4 12h16"></path>
                        <path d="M7 12v-2"></path>
                        <path d="M17 16v.01"></path>
                        <path d="M13 16v.01"></path>
                      </svg>
                    </span>
                    <span class="nav-link-title">
                      Rádio
                    </span>
                  </a>
                  <a class="dropdown-item {{ request()->segment(2) == 'videa' ? 'active' : '' }}" href="{{ route('media.videa') }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <svg class="icon text-blue" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                        <line x1="8" y1="4" x2="8" y2="20">
                        </line>
                        <line x1="16" y1="4" x2="16" y2="20">
                        </line>
                        <line x1="4" y1="8" x2="8" y2="8">
                        </line>
                        <line x1="4" y1="16" x2="8" y2="16">
                        </line>
                        <line x1="4" y1="12" x2="20" y2="12">
                        </line>
                        <line x1="16" y1="8" x2="20" y2="8">
                        </line>
                        <line x1="16" y1="16" x2="20" y2="16">
                        </line>
                      </svg>
                    </span>
                    <span class="nav-link-title">
                      Videa
                    </span>
                  </a>
                  <a class="dropdown-item {{ request()->segment(2) == 'prekladatele' ? 'active' : '' }}" href="{{ route('media.prekladatele') }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <svg class="icon icon-tabler icon-tabler-language nav-link-icon text-yellow" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M4 5h7"></path>
                        <path d="M9 3v2c0 4.418 -2.239 8 -5 8"></path>
                        <path d="M5 9c-.003 2.144 2.952 3.908 6.7 4"></path>
                        <path d="M12 20l4 -9l4 9"></path>
                        <path d="M19.1 18h-6.2"></path>
                      </svg>
                    </span>
                    <span class="nav-link-title">
                      Překladatelé
                    </span>
                  </a>
                  <div class="dropend">
                    <a class="dropdown-item show" data-bs-toggle="dropdown" data-bs-auto-close="outside" href="#" role="button"
                      aria-expanded="true">
                      <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg class="icon text-pink" width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                          fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                          <path d="M8 8v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2"></path>
                          <path d="M4 8m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>
                          <path d="M10 14h4"></path>
                          <path d="M12 12v4"></path>
                        </svg>
                      </span>
                      <span class="nav-link-title">
                        Edukace
                      </span>
                    </a>
                    <div class="dropdown-menu">
                      @foreach ($educations as $education)
                        <a class="dropdown-item {{ request()->segment(3) == $education->folder_name ? 'active' : '' }}"
                          href="{{ route('' . $education->category_file . '.' . $education->folder_name . '', $education->id) }}">
                          <span class="nav-link-icon d-md-none d-lg-inline-block">
                            {!! $education->svg_icon !!}
                          </span>
                          <span class="nav-link-title">
                            {{ $education->category_name }}
                          </span>
                          <span class="badge badge-sm bg-{{ $education->color }}-lt text-uppercase ms-auto">{{ $education->documents->count() }}</span>
                        </a>
                      @endforeach
                    </div>
                  </div>
                  <div class="dropend">
                    <a class="dropdown-item show" data-bs-toggle="dropdown" data-bs-auto-close="outside" href="#" role="button"
                      aria-expanded="true">
                      <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg class="icon icon-tabler icon-tabler-headset text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                          stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                          <rect x="4" y="13" rx="2" width="4" height="6"></rect>
                          <rect x="16" y="13" rx="2" width="4" height="6"></rect>
                          <path d="M4 15v-3a8 8 0 0 1 16 0v3"></path>
                          <path d="M18 19a6 3 0 0 1 -6 3"></path>
                        </svg>
                      </span>
                      <span class="nav-link-title">
                        Edukační videa
                      </span>
                    </a>
                    <div class="dropdown-menu show" data-bs-popper="static">
                      <a class="dropdown-item {{ request()->segment(3) == 'lekis' ? 'active' : '' }}" href="{{ route('media.videa-lekis') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                          <svg class="icon icon-tabler icon-tabler-pill text-lime" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M4.5 12.5l8 -8a4.94 4.94 0 0 1 7 7l-8 8a4.94 4.94 0 0 1 -7 -7"></path>
                            <line x1="8.5" y1="8.5" x2="15.5" y2="15.5"></line>
                          </svg>
                        </span>
                        <span class="nav-link-title">
                          Lekis
                        </span>
                      </a>
                      <a class="dropdown-item {{ request()->segment(3) == 'bozp' ? 'active' : '' }}" href="{{ route('media.videa-bozp') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                          <svg class="icon icon-tabler icon-tabler-flame-off text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path
                              d="M8.973 8.974c-.335 .378 -.67 .716 -.973 1.026c-1.226 1.26 -2 3.24 -2 5a6 6 0 0 0 11.472 2.466m.383 -3.597c-.32 -1.409 -1.122 -3.045 -1.855 -3.869c-.281 .472 -.543 .87 -.79 1.202m-2.358 -2.35c-.068 -2.157 -1.182 -4.184 -1.852 -4.852c0 .968 -.18 1.801 -.465 2.527">
                            </path>
                            <path d="M3 3l18 18"></path>
                          </svg>
                        </span>
                        <span class="nav-link-title">
                          BOZP a PO
                        </span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item dropdown {{ request()->segment(1) == 'moznosti' ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-original-title="Další volby">
              <a class="nav-link" data-bs-toggle="dropdown" data-bs-auto-close="outside" href="#" role="button" aria-expanded="false">
                <span class="nav-link-icon d-inline-block d-sm-inline-block d-mg-none d-lg-none d-xl-none d-xxl-inline-block">
                  <svg class="icon text-yellow" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12 2l3 5h6l-3 5l3 5h-6l-3 5l-3 -5h-6l3 -5l-3 -5h6z"></path>
                  </svg>
                </span>
                <span class="nav-link-title d-block d-md-none d-md-inline d-lg-inline d-xl-inline">
                  {{ __('Ostatní') }}
                </span>
              </a>
              <div class="dropdown-menu">
                <div class="dropdown">
                  <div class="dropend">
                    <a class="dropdown-item {{ request()->segment(2) == 'helpdesk' ? 'active' : '' }}" href="{{ route('media.videa') }}">
                      <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                          fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                          <circle cx="12" cy="12" r="4"></circle>
                          <circle cx="12" cy="12" r="9"></circle>
                          <line x1="15" y1="15" x2="18.35" y2="18.35"></line>
                          <line x1="9" y1="15" x2="5.65" y2="18.35"></line>
                          <line x1="5.65" y1="5.65" x2="9" y2="9"></line>
                          <line x1="18.35" y1="5.65" x2="15" y2="9"></line>
                        </svg>
                      </span>
                      <span class="nav-link-title">
                        {{ __('Helpdesk') }}
                      </span>
                    </a>
                    <a class="dropdown-item {{ request()->segment(1) == 'employees' ? 'bg-primary-lt' : '' }}" href="{{ route('employees.index') }}">
                      <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg class="icon text-lime" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                          fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                          <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                          <path d="M6 21v-2a4 4 0 0 1 4 -4h1.5"></path>
                          <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                          <path d="M20.2 20.2l1.8 1.8"></path>
                        </svg>
                      </span>
                      <span class="nav-link-title">
                        {{ __('Employees') }}
                      </span>
                    </a>
                    <a class="dropdown-item show" data-bs-toggle="dropdown" data-bs-auto-close="outside" href="#" role="button"
                      aria-expanded="true">
                      <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg class="icon text-azure" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                          fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                          <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z">
                          </path>
                          <path d="M16 3l0 4"></path>
                          <path d="M8 3l0 4"></path>
                          <path d="M4 11l16 0"></path>
                          <path d="M8 15h2v2h-2z"></path>
                        </svg>
                      </span>
                      <span class="nav-link-title">
                        {{ __('Reservation') }}
                      </span>
                    </a>
                    <div class="dropdown-menu show" data-bs-popper="static">
                      <a class="dropdown-item {{ request()->segment(1) == 'paints' ? 'active' : '' }}" href="{{ route('paints.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                          <svg class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 3m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v2a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z">
                            </path>
                            <path d="M19 6h1a2 2 0 0 1 2 2a5 5 0 0 1 -5 5l-5 0v2"></path>
                            <path d="M10 15m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z">
                            </path>
                          </svg>
                        </span>
                        <span class="nav-link-title">
                          {{ __('Painting') }}
                        </span>
                      </a>
                      <a class="dropdown-item {{ request()->segment(2) == 'bikes' ? 'active' : '' }}" href="#">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                          <svg class="icon text-blue" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                            <path d="M19 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                            <path d="M12 19l0 -4l-3 -3l5 -4l2 3l3 0"></path>
                            <path d="M17 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                          </svg>
                        </span>
                        <span class="nav-link-title">
                          {{ __('Bikes') }}
                        </span>
                      </a>
                      <a class="dropdown-item {{ request()->segment(2) == 'tires' ? 'active' : '' }}" href="#">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                          <svg class="icon text-mute" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                            <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                            <path d="M5 17h-2v-6l2 -5h9l4 5h1a2 2 0 0 1 2 2v4h-2m-4 0h-6m-6 -6h15m-6 0v-5"></path>
                          </svg>
                        </span>
                        <span class="nav-link-title">
                          {{ __('Tires') }}
                        </span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Odbory KHN a.s." href="{{ route('zvos') }}">
                <span class="nav-link-icon d-inline-block d-sm-inline-block d-mg-none d-lg-none d-xl-none d-xxl-inline-block">
                  <svg class="icon text-pink" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8"></path>
                    <path d="M13 7l0 .01"></path>
                    <path d="M17 7l0 .01"></path>
                    <path d="M17 11l0 .01"></path>
                    <path d="M17 15l0 .01"></path>
                  </svg>
                </span>
                <span class="nav-link-title d-block d-md-none d-md-inline d-lg-inline d-xl-inline">
                  {{ __('ZVOS') }}
                </span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  </li>
  </ul>
  <div class="my-2">
    @yield('searchbar')
  </div>
  @yield('buttons')
</div>
</div>
</div>
</div>
