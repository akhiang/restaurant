    <!-- Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../logout.php" method="post">
                <div class="modal-body">
                Are you sure you want to Logout?
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Logout</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/js/simplebar.min.js"></script>
    <script src="../assets/js/jquery.validate.min.js"></script>
    <script src="../assets/js/sweetalert2@9.js"></script>
    <script src="../assets/js/currency.min.js"></script>
    
    <script src="../assets/js/isotope.pkgd.min.js"></script>
    <script src="../assets/js/jquery.nicescroll.js"></script>
    <script src="../assets/js/InputSpinner.js"></script>
    <!-- DatePicker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="../assets/js/kasir/kasir.js"></script>
    <script>
        $(function() {
            $('#date-check').click(function() {
                if ($(this).is(':checked')) {
                    $('.date').prop('disabled', false);
                } else {
                    $('.date').prop('disabled', true);
                }
            });

            $('.date').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 2000,
                clearBtn: true,
                maxYear: parseInt(moment().format('YYYY'),10,),
                locale: {
                    format: 'YYYY-MM-D'
                }
            });

            $('#filter').on('click', function() {
                if ($('#date-check').is(':checked')) {                    
                    var is_date = 'yes',
                        from = $('#from-date').val(), to = $('#to-date').val();
                } else {                    
                    var is_date = 'no',
                        from = '', to = '';
                }

                $('#order-table').DataTable({
                    "destroy": true,
                    "ajax": {
                        url: "order_list_fetch.php",
                        type: "POST",
                        data: {
                            is_date: is_date,
                            from: from,
                            to: to,
                        }
                    },
                    "order": [[0, "desc"]]
                });
            });
        });
    </script>
</body>
</html>