<!-- Required vendors -->
<script src="../assets/vendor/global/global.min.js"></script>
<script src="../assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="../assets/js/custom.min.js"></script>
<script src="../assets/js/deznav-init.js"></script>
<!-- Toastr -->
<script src="../assets/vendor/toastr/toastr.min.js"></script>
<!-- Custom File  -->
<script src="../assets/js/bs-custom-file-input.min.js"></script>
<!-- momment js is must -->
<script src="../assets/vendor/moment/moment.min.js"></script>
<!-- pickdate -->
<script src="../assets/vendor/pickadate/picker.js"></script>
<script src="../assets/vendor/pickadate/picker.time.js"></script>
<script src="../assets/vendor/pickadate/picker.date.js"></script>
<!-- Pickdate -->
<script src="../assets/js/plugins-init/pickadate-init.js"></script>
<!-- Data Tables CDN -->
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script>
    function assignedDoctor() {

        /*  testimonial one function by = owl.carousel.js */
        jQuery('.assigned-doctor').owlCarousel({
            loop: false,
            margin: 30,
            nav: true,
            autoplaySpeed: 3000,
            navSpeed: 3000,
            paginationSpeed: 3000,
            slideSpeed: 3000,
            smartSpeed: 3000,
            autoplay: false,
            dots: false,
            navText: ['<i class="fa fa-caret-left"></i>', '<i class="fa fa-caret-right"></i>'],
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                767: {
                    items: 3
                },
                991: {
                    items: 2
                },
                1200: {
                    items: 3
                },
                1600: {
                    items: 5
                }
            }
        })
    }

    jQuery(window).on('load', function() {
        setTimeout(function() {
            assignedDoctor();
        }, 1000);
    });
</script>
<script>
    /* Init Tool Tip Js */
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
    /* Init Data Tables */
    $(document).ready(function() {
        $('.table').DataTable();
    });

    $(document).ready(function() {
        $('.report_table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>
<script>
    /* Init Custom File Select */
    $(document).ready(function() {
        bsCustomFileInput.init();
    });
    /* Show Selected File Name */
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = document.getElementById("myInput").files[0].name;
        var nextSibling = e.target.nextElementSibling
        nextSibling.innerText = fileName
    })
</script>
<!-- Init  Alerts -->
<?php if (isset($success)) { ?>
    <!-- Pop Success Alert -->
    <script>
        toastr.success("<?php echo $success; ?>", "", {
            positionClass: "toast-top-left",
            timeOut: 5e3,
            newestOnTop: !0,
            progressBar: !0,
            onclick: null,
            showDuration: "300",
            hideDuration: "1000",
            extendedTimeOut: "1000",
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut",
        })
    </script>

<?php }
if (isset($err)) { ?>
    <script>
        toastr.error("<?php echo $err; ?>", "", {
            positionClass: "toast-top-left",
            timeOut: 5e3,
            newestOnTop: !0,
            progressBar: !0,
            onclick: null,
            showDuration: "300",
            hideDuration: "1000",
            extendedTimeOut: "1000",
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut",
        })
    </script>
<?php }
if (isset($info)) { ?>
    <script>
        toastr.warning("<?php echo $info; ?>", "", {
            positionClass: "toast-top-left",
            timeOut: 5e3,
            newestOnTop: !0,
            progressBar: !0,
            onclick: null,
            showDuration: "300",
            hideDuration: "1000",
            extendedTimeOut: "1000",
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut",
        })
    </script>
<?php }
?>