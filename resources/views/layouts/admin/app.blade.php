<!DOCTYPE html>
<html lang="id">

@include('layouts.admin.header')

<body
  class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-aside--enabled kt-aside--fixed kt-page--loading">

  @include('layouts.admin.headbar_mobile')

  <div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

      @include('layouts.admin.sidebar')

      <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

        @include('layouts.admin.headbar')

        <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
          <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="container-fluid">
              @yield('content')
            </div>
          </div>
        </div>

        @include('layouts.admin.footer')

      </div>
    </div>
  </div>

  @include('layouts.admin.script')

</body>

</html>
