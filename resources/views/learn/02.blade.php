@extends('168_template')
@include('168_component.util.wyswyig')


@section("header_name")
    Evaluasi Pengenalan Komponen
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
            // SmartWizard initialize
            $('#smartwizard').smartWizard();
            const correctValues = [
                'Harga Tanah',
                'Biaya Pengerjaan dan Pengerukan Tanah',
                'Biaya Sarana Peluncuran',
                'Biaya Gudang dan Bengkel',
                'Biaya Bangunan Pendukung',
                'Harga Peralatan Kerja',
                'Harga Material Handling',
                'Harga Generator',
                'Biaya Instalasi Air Bersih',
                'Biaya IPAL',
                'Biaya Investasi Tanah',
                'Biaya Investasi Bangunan',
                'Biaya Investasi Peralatan',
                'Biaya Investasi Persiapan',
            ];
            // add correct values for all 14 input fields

            for (let i = 1; i <= 14; i++) {
                $('#isian' + i).on('input', function () {
                    const value = $(this).val();
                    $('#isian' + i).removeClass('is-invalid');
                    $('#isian' + i + 'e').toggleClass('d-none', true);
                });
            }

            $('#simul').click(function () {
                for (let i = 1; i <= 14; i++) {
                    $('#isian' + i).val(correctValues[i - 1]);
                }
            });

            $('#reset').click(function () {
                for (let i = 1; i <= 14; i++) {
                    $('#isian' + i).val("");
                }
            });

            $("#prev1").click(function () {
                window.location.href = ("{{url("/learn/pengenalan-komponen")}}");
            });

            $('#next1').click(function () {
                let correct = true;
                for (let i = 1; i <= 14; i++) {
                    const value = $('#isian' + i).val();
                    if (correctValues[i - 1] !== value) {
                        correct = false;
                        $('#isian' + i).addClass('is-invalid');
                        $('#isian' + i + 'e').toggleClass('d-none', false);
                    } else {
                        $('#isian' + i).removeClass('is-invalid');
                        $('#isian' + i + 'e').toggleClass('d-none', true);
                    }
                }
                if (correct) {
                    window.location.href = 'rekayasa-pengalaman';
                } else {
                    $('#error-message').show();
                }
            });
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
                    <li class="breadcrumb-item active"><a href="{{url("")}}">Evaluasi Pengenalan Komponen</a></li>
                </ol>
            </div>
            <!-- row -->

            <div class="row">
                <div class="col-xl-12 ">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <h5 class="card-title text-dark">
                                EVALUATION OF COMPONENTS FORMING THE COST OF INVESTING IN A NEW BUILDING SHIPYARD
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <img src="{{url("/")}}/agsa/evaluasi_pengenalan_komponen.png" alt=""
                                     class="img-fluid mt-4 mb-4">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Isian Jawaban</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form>
                                    <div class="row">
                                        <div class="col-sm-6 ">
                                            <input id="isian1" type="text" class="form-control" placeholder="Isian 1">
                                            <small id="isian1e" class="text-danger d-none">
                                                isian seharusnya adalah 'Harga Tanah',
                                            </small>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <input id="isian2" type="text" class="form-control" placeholder="Isian 2">
                                            <small id="isian2e" class="text-danger d-none">
                                                isian seharusnya adalah 'Biaya Pengerjaan dan Pengerukan Tanah',
                                            </small>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <input id="isian3" type="text" class="form-control" placeholder="Isian 3">
                                            <small id="isian3e" class="text-danger d-none">
                                                isian seharusnya adalah 'Biaya Sarana Peluncuran',
                                            </small>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <input id="isian4" type="text" class="form-control" placeholder="Isian 4">
                                            <small id="isian4e" class="text-danger d-none">
                                                isian seharusnya adalah 'Biaya Gudang dan Bengkel',
                                            </small>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <input id="isian5" type="text" class="form-control" placeholder="Isian 5">
                                            <small id="isian5e" class="text-danger d-none">
                                                isian seharusnya adalah 'Biaya Bangunan Pendukung',
                                            </small>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <input id="isian6" type="text" class="form-control" placeholder="Isian 6">
                                            <small id="isian6e" class="text-danger d-none">
                                                isian seharusnya adalah 'Harga Peralatan Kerja',
                                            </small>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <input id="isian7" type="text" class="form-control" placeholder="Isian 7">
                                            <small id="isian7e" class="text-danger d-none">
                                                isian seharusnya adalah 'Harga Material Handling',
                                            </small>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <input id="isian8" type="text" class="form-control" placeholder="Isian 8">
                                            <small id="isian8e" class="text-danger d-none">
                                                isian seharusnya adalah 'Harga Generator',
                                            </small>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <input id="isian9" type="text" class="form-control" placeholder="Isian 9">
                                            <small id="isian9e" class="text-danger d-none">
                                                isian seharusnya adalah 'Biaya Instalasi Air Bersih',
                                            </small>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <input id="isian10" type="text" class="form-control" placeholder="Isian 10">
                                            <small id="isian10e" class="text-danger d-none">
                                                isian seharusnya adalah 'Biaya IPAL',
                                            </small>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <input id="isian11" type="text" class="form-control" placeholder="Isian 11">
                                            <small id="isian11e" class="text-danger d-none">
                                                isian seharusnya adalah 'Biaya Investasi Tanah',
                                            </small>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <input id="isian12" type="text" class="form-control" placeholder="Isian 12">
                                            <small id="isian12e" class="text-danger d-none">
                                                isian seharusnya adalah 'Biaya Investasi Bangunan',
                                            </small>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <input id="isian13" type="text" class="form-control" placeholder="Isian 13">
                                            <small id="isian13e" class="text-danger d-none">
                                                isian seharusnya adalah 'Biaya Investasi Peralatan',
                                            </small>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <input id="isian14" type="text" class="form-control" placeholder="Isian 14">
                                            <small id="isian14e" class="text-danger d-none">
                                                isian seharusnya adalah 'Biaya Investasi Persiapan',
                                            </small>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-footer border-0 pt-0">
                            <div class="text-left">
                                <div id="reset" class="btn btn-outline-danger btn-sm col-3">Reset</div>
                                <div id="simul" class="btn btn-outline-secondary btn-sm col-3">Simulasi</div>
                            </div>
                            <div class="text-right mt-5">
                                <div class="float-right mb-2">
                                    <div id="next1" href="next.html" class="btn btn-primary btn-sm">Next</div>
                                </div>
                                <div class="float-left">
                                    <div id="prev1" href="previous.html" class="btn btn-secondary btn-sm">Previous</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
