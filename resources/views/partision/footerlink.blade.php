@php
use App\Models\Utility;
$settings = Utility::settings();
@endphp
<footer class="dash-footer">
    <div class="footer-wrapper">
        <div class="py-1">
            <span class="text-muted">{{($settings['footer_text']) ? $settings['footer_text'] :  __('© GreenFSCO') }} {{ date('Y') }}</span>
        </div>
    </div>
</footer>

<!-- Required Js -->
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/plugins/popper.js') }}"></script>
<script src="{{ asset('assets/js/plugins/simplebar.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/plugins/feather.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-switch-button.js')}}"></script>
<script src="{{ asset('assets/js/dash.js') }}"></script>
<script src="{{ asset('assets/js/plugins/apexcharts.js') }}"></script>
<script src="{{ asset('assets/js/plugins/notifier.js') }}"></script>
<script src="{{ asset('assets/js/plugins/sweetalert2.all.js') }}"></script>
<script src="{{ asset('assets/js/plugins/choices.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.3/plugins/minMaxTimePlugin.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{asset('assets/js/plugins/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/js/plugins/dataTables.bootstrap5.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>


<script>
    feather.replace();
    var pctoggle = document.querySelector("#pct-toggler");
    if (pctoggle) {
        pctoggle.addEventListener("click", function() {
            if (
                !document.querySelector(".pct-customizer").classList.contains("active")
            ) {
                document.querySelector(".pct-customizer").classList.add("active");
            } else {
                document.querySelector(".pct-customizer").classList.remove("active");
            }
        });
    }

    var themescolors = document.querySelectorAll(".themes-color > a");
    for (var h = 0; h < themescolors.length; h++) {
        var c = themescolors[h];

        c.addEventListener("click", function(event) {
            var targetElement = event.target;
            if (targetElement.tagName == "SPAN") {
                targetElement = targetElement.parentNode;
            }
            var temp = targetElement.getAttribute("data-value");
            removeClassByPrefix(document.querySelector("body"), "theme-");
            document.querySelector("body").classList.add(temp);
        });
    }

    function removeClassByPrefix(node, prefix) {
        for (let i = 0; i < node.classList.length; i++) {
            let value = node.classList[i];
            if (value.startsWith(prefix)) {
                node.classList.remove(value);
            }
        }
    }


    $(function() {

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }

        }, cb);

        cb(start, end);

    });
</script>
<audio id="success-audio" >
    <source src="{{ asset('audio/success.ogg') }}" type="audio/ogg">
    <source src="{{ asset('audio/success.mp3') }}" type="audio/mpeg">
</audio>
<audio id="error-audio">
    <source src="{{ asset('audio/error.ogg') }}" type="audio/ogg">
    <source src="{{ asset('audio/error.mp3') }}" type="audio/mpeg">
</audio>
<audio id="warning-audio">
    <source src="{{ asset('audio/warning.ogg') }}" type="audio/ogg">
    <source src="{{ asset('audio/warning.mp3') }}" type="audio/mpeg">
</audio>
<script>
  const element = document.getElementById('choices-js');
  const choices = new Choices(element, {
    removeItemButton: true,
    placeholderValue: 'Select fruits...',
    searchPlaceholderValue: 'Search here...',
  });
</script>
