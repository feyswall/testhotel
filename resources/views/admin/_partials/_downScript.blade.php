
	<script src="{{ asset('assets/js/app.js') }}"></script>

	<script src="{{ asset('assets/js/datatables.js') }}"></script>

	{{-- <script>
		document.addEventListener("DOMContentLoaded", function() {
			// Datatables Responsive
			$("#datatables-reponsive").DataTable({
				responsive: true
			});
		});
	</script>

<script>
  document.addEventListener("DOMContentLoaded", function(event) { 
    setTimeout(function(){
      if(localStorage.getItem('popState') !== 'shown'){
        window.notyf.open({
          type: "success",
          message: "Get access to all 500+ components and 45+ pages with AdminKit PRO. <u><a class=\"text-white\" href=\"https://adminkit.io/pricing\" target=\"_blank\">More info</a></u> 🚀",
          duration: 10000,
          ripple: true,
          dismissible: false,
          position: {
            x: "left",
            y: "bottom"
          }
        });

        localStorage.setItem('popState','shown');
      }
    }, 15000);
  });
</script> --}}

<script>
      // DataTables with Column Search by Text Inputs
      document.addEventListener("DOMContentLoaded", function() {
        // Setup - add a text input to each footer cell
        $("#datatables-column-search-text-inputs tfoot th").each(function() {
            var title = $(this).text();
            $(this).html("<input type=\"text\" class=\"form-control\" placeholder=\"Search " + title + "\" />");
        });
        // DataTables
        var table = $("#datatables-column-search-text-inputs").DataTable();
        // Apply the search
        table.columns().every(function() {
            var that = this;
            $("input", this.footer()).on("keyup change clear", function() {
                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });
    });
</script>