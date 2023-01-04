@extends('168_template')
@include('168_component.util.wyswyig')


@section("header_name")
    About App
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
                    <li class="breadcrumb-item active"><a href="{{url("sodaqo/me")}}">About App</a></li>
                </ol>
            </div>
            <!-- row -->

            <div class="row">
                <div class="col-xl-6 col-12">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <h5 class="card-title text-dark">Purpose</h5>
                        </div>
                        <div class="card-body">
                            <h4 class="card-text text-black-50">
                                Able to improve the proficiency of user intuition in the estimation of investment in new
                                building shipyards.
                            </h4>
                        </div>
                        <div class="card-footer border-0 pt-0">
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-12">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <h5 class="card-title text-dark">APPLICATION LIMITATIONS :</h5>
                        </div>
                        <div class="card-body">
                            <ul class="text-black" style="font-size: larger">
                                <li>
                                    1. This website-based computer application provides knowledge and engineering
                                    experience in
                                    estimating the investment costs of new building shipyards.
                                </li>
                                <li>
                                    2. The land area to be used in this training application is 10000 - 100000 m2.
                                </li>
                                <li>
                                    3. The size and type of ship that will be a reference in intuition training in cost
                                    estimation are limited, namely small tankers of 5000 - 9999 DWT.
                                </li>
                                <li>
                                    4. The numbers or values in the application are not actual representations, but
                                    rather numbers or
                                    The value of the assumptions made to create a representative simulation
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer border-0 pt-0">

                        </div>
                    </div>
                </div>

                <div class="col-xl-12 ">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <h5 class="card-title text-dark">OPERATIONAL METHODS OF APPLICATION :</h5>
                        </div>
                        <div class="card-body">
                            <img src="http://feylabs.my.id/fm/agsa/about_1.png" alt="" class="img-fluid mt-4 mb-4">
                            <h4>How to Train The Intuition in This Application:</h4>
                            <ul class="text-black" style="font-size: larger">
                                <li>
                                    1. Building Basic Knowledge and Engineering Experience
                                    user about the estimated investment cost of the new building shipyard
                                </li>
                                <li>
                                    2. An explanation of the pattern of the relationship between known conditions and the cost of the investment component and how to estimate the cost.
                                </li>
                                <li>
                                    3. Evaluations are carried out by the user periodically in order to appear in the user's intuitive skills in estimating the investment cost of the new building shipyard.
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer border-0 pt-0">
                            <h1 class="text-primary text-center font-weight-bold">Good Luck</h1>
                            <button id="next1" type="button"
                                    class="btn btn-outline-primary mt-5 btn-block">Start
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
