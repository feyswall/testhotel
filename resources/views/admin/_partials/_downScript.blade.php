
	<script src="{{ asset('assets/js/app.js') }}"></script>

	<script src="{{ asset('assets/js/datatables.js') }}"></script>
	<script src="{{ asset('assets/js/fontawesome.min.js') }}"></script>


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

    document.addEventListener("DOMContentLoaded", function() {
			// Datatables with Buttons
			var datatablesButtons = $("#datatables-buttons").DataTable({
				responsive: true,
				lengthChange: !1,
				buttons: ["copy", "print"]
			});
			datatablesButtons.buttons().container().appendTo("#datatables-buttons_wrapper .col-md-6:eq(0)");
		});
  document.addEventListener("DOMContentLoaded", function() {
    new Choices(document.querySelector(".choices-single"));
    new Choices(document.querySelector(".choices-single-items"));
  });
</script>
