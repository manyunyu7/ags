@extends('168_template')
@include('168_component.util.wyswyig')


@section("header_name")
    Evaluasi Estimasi Biaya
    <span class="current_status badge badge-xl light badge-primary">Kondisi 3</span>
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

    <!-- Chart ChartJS plugin files -->
    <script src="{{ asset('/168_res') }}/vendor/chart.js/Chart.bundle.min.js"></script>

    <script>

        function checkTabs() {
            // Get the aia element
            var aia = $('#aia');

            // Add click event listeners to the tab elements
            $('#tab1, #tab2, #tab3').click(function (event) {
                if (aia.html() == 2) {
                    event.preventDefault();
                    alert('You cannot open tab 1 or 3 when the value of aia is 2');
                }
            });
        }

        $(document).ready(function () {
            // SmartWizard initialize
            $('#smartwizard').smartWizard();
            var score = 0;


            $("#prev1").click(function () {
                window.location.href = ("{{url("learn/evaluasi-final?case=2")}}");
            });
            $("#next1").click(function () {
                swal({
                    title: "Selesai",
                    text: "Terima Kasih",
                    icon: "success",
                }).then((willConfirm) => {
                    if (willConfirm) {
                        window.location.href = ("{{url("/main")}}");
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
        // First, get the data from the server
        $.ajax({
            type: "GET",
              url:"https://shipyard.feylabs.my.id"+"/get-scores",
            data: {
                user_id: {{ Auth::user()->id }}
            },
            success: function (response) {
                // This function will be called if the request succeeds
                console.log(response);

                // Now, create the chart using Chart.js
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Kondisi 1', 'Kondisi 2', 'Kondisi 3'],
                        datasets: [{
                            label: 'Skor',
                            data: [response.score1, response.score2, response.score3],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            },
            error: function (xhr, status, error) {
                // This function will be called if the request fails
                console.error(error);
            }
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
                    <li class="breadcrumb-item active">
                        <a href="{{url("")}}">
                            Evaluation Result
                        </a>
                    </li>
                </ol>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-xl-12 ">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <h5 class="card-title text-dark">
                                Berikut adalah perkembangan skor anda di pelatihan ini
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <canvas class="my-5" id="myChart" width="300" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-footer border-0 pt-0">
                            <div class="mt-4">
                                <div id="next1" class="btn btn-block btn-outline-primary btn-sm">Selesai</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
