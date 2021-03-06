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
        let table = $("#datatables-column-search-text-inputs").DataTable({  
            "pageLength": 7,
            "lengthMenu": [ 7, 10, 25, 50, 75, 100 ]
         });
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
                    retrieve: true,
                    paging: false,
				responsive: true,
				lengthChange: !1,
				buttons: ["copy", "print"]
			});
			datatablesButtons.buttons().container().appendTo("#datatables-buttons_wrapper .col-md-6:eq(0)");
		});

        
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
