<?php
$get_user = (new \App\Http\Traits\AuthFunction)->getUser();
?>

<div class="pt-3 pb-3">
  <!-- terakhir -->
  <div class="bg-white py-md d-flex justify-content-between align-items-center">
    <img src="{{ asset('') }}icon/hamburger.png" class="toggle-sidebar" width="35" alt="">
    <img src="{{ asset('') }}icon/hamburger.png" class="hover-pointer" id="minimize" onclick="minimize()" width="35" alt="">
    <h1 class="title-page">@yield('title-header')</h1>
    <div class="md-section-show"></div>
  </div>
</div>

<div class="bg-white py-md d-flex justify-content-between align-items-center">
  @yield('breadcrumbs')
</div>
