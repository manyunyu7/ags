@extends('168_template')
@include('168_component.util.wyswyig')


@section("header_name")
    Pengenalan Komponen
@endsection

@push("css")
    <!-- Form step -->
    <link href="{{asset("/168_res")}}/vendor/jquery-smartwizard/dist/css/smart_wizard.min.css" rel="stylesheet">
@endpush

@push("script")
    <script src="{{asset("/168_res")}}/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js"></script>
    <script src="{{asset("/168_res")}}/vendor/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="{{asset("/168_res")}}/vendor/jquery-validation/jquery.validate.min.js"></script>
    <!-- Form validate init -->
    <script src="{{asset("/168_res")}}/js/plugins-init/jquery.validate-init.js"></script>

    <script>
        $(document).ready(function () {

            $("#next1").click(function () {
                swal({
                    title: "Perhatian!",
                    text: "Anda Yakin ingin memulai pelatihan ?",
                    icon: "warning",
                    buttons: {
                        cancel: "No",
                        confirm: "Yes"
                    },
                    dangerMode: true
                }).then((willConfirm) => {
                    if (willConfirm) {
                        window.location.href = ("{{url("/learn/pengenalan-komponen")}}");
                    }
                });

            });

        });
    </script>

    <script>
        $(document).ready(function () {
            // SmartWizard initialize
            $('#smartwizard').smartWizard();
        });
    </script>
    <script>

        var form = document.querySelector('form');

        // Listen for the submit event on the form
        form.addEventListener("submit", function (event) {
            // Prevent the form from being submitted
            event.preventDefault();
            showConfirmationPrompt()
        });


        function showConfirmationPrompt() {

            var form = document.querySelector('form');

            // Check the validity of the form
            if (form.checkValidity()) {
                // Use the Swal.fire() method to show the confirmation prompt
                Swal.fire({
                    title: 'Anda Yakin ?',
                    text: 'Periksa kembali data anda',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya'
                }).then((result) => {
                    if (result.value) {
                        // If the user clicks "OK", submit the form
                        form.submit()
                        return true;
                    } else {
                        // If the user clicks "Cancel", prevent the form from being submitted
                        return false;
                    }
                });
            } else {
                // If the form is invalid, don't show the confirmation prompt
                // and let the browser handle the validation error
                Swal.fire({
                    title: 'Error!',
                    text: 'Lengkapi Form terlebih dahulu',
                    type: 'error'
                });
                return false;
            }


        }
    </script>
@endpush

@section("page_content")
    <div class="content-body" style="min-height: 798px;">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{url("")}}">Pengenalan Komponen</a></li>
                </ol>
            </div>
            <!-- row -->

            <div class="row">
                <div class="col-xl-12 ">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <h5 class="card-title text-dark">INTRODUCTION OF COMPONENTS FORMING THE COST OF INVESTING IN A NEW BUILDING SHIPYARD

                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <img src="{{url("/")}}/agsa/pengenalan_komponen.png" alt=""
                                     class="img-fluid mt-4 mb-4">

                            </div>
                        </div>
                        <div class="card-footer border-0 pt-0">
                            <div class="text-right">
                                <div class="float-right mb-2">
                                    <a href="{{url("learn/evaluasi-pengenalan-komponen")}}" class="btn btn-primary btn-sm">Next</a>
                                </div>
                                <div class="float-left">
                                    <a href="{{url("main")}}" class="btn btn-secondary btn-sm">Previous</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
