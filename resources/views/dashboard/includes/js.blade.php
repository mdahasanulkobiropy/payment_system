<script src="{{asset('dashboards')}}/assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="{{asset('dashboards')}}/assets/js/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_KEY_HERE&amp;libraries=geometry&amp;libraries=places"></script>
<script src="{{asset('dashboards')}}/assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="{{asset('dashboards')}}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="{{asset('dashboards')}}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="{{asset('dashboards')}}/assets/plugins/chartjs/js/Chart.min.js"></script>
<script src="{{asset('dashboards')}}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="{{asset('dashboards')}}/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="{{asset('dashboards')}}/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
<script src="{{asset('dashboards')}}/assets/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
<script src="{{asset('dashboards')}}/assets/plugins/jquery-knob/excanvas.js"></script>
<script src="{{asset('dashboards')}}/assets/plugins/jquery-knob/jquery.knob.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
      $(function() {
          $(".knob").knob();
      });

      $("#explore_select").select2({
            multiple: true
      });
      $("#amenity_select").select2({
            multiple: true
      });

  </script>
  <script src="{{asset('dashboards')}}/assets/js/index.js"></script>
<!--app JS-->
<script src="{{asset('dashboards')}}/assets/js/app.js"></script>
