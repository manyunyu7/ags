@extends('168_template')
@include('168_component.util.wyswyig')


@section("header_name")
    Evaluasi Estimasi Biaya
    <span class="current_status badge badge-xl light badge-primary">Kondisi 2</span>
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
            $('#next1').removeClass('d-none');
            $('#smartwizard').smartWizard();
            var score = 0;

            const correctValues = [
                17062500000, //1 Tanah
                525000000, //2 Land Clearing
                3150000000, //3 Pengurugan Tanah
                525000000, //4 Pemadatan Tanah
                3142500000, //5 Pengerukan Dalam Air
                2752000000, //6 Sarana Pengedokan (.....)
                3000000000, //7 Gudang Penyimpanan
                3000000000, //8 Bengkel Persiapan
                3000000000, //9 Bengkel Fabrikasi
                3000000000, //10 Bengkel Sub Assembly
                3000000000, //11 Bengkel Assembly
                3000000000, //12 Bengkel Blasting and painting
                200000000, //13 Pos Keamanan
                800000000, //14 Area Parkir
                3750000000, //15 Kantor
                500000000, //16 Mushola
                75000000, //17 Toilet
                250000000, //18 Ruangan Listrik
                201654000, //19 Winch
                96000000, //20 Rak
                322000000, //21 Forklift
                1703000000, //22 Straightening Machine
                1965000000, //23 Shot Blasting Machine
                435000000, //24 Overhead Crane 5 ton
                2096000000, //25 CNC Plasma Cutting Machine
                1048000000, //26 Flame Planner
                2358000000, //27 Bending Machine
                435000000, //28 Overhead Crane 5 ton
                88000000, //29 SAW Welding Machine
                60225000, //30 FCAW Welding Machine
                2175000000, //31 Mobile Crane 25 ton
                88000000, //32 SAW Welding Machine
                60225000, //33 FCAW Welding Machine
                3088500000, //34 Mobile Crane 50 ton
                88000000, //35 SAW Welding Machine
                60225000, //36 FCAW Welding Machine
                3088500000, //37 Mobile Crane 50 ton
                4350000000, //38 Transporter
                1800000000, //39 Generator (100 KVA)
                650000000, //40 Generator (80 KVA)
                430000000, //41 Generator (60 KVA)
                50000000, //42 Instalasi Air Bersih dan Listrik
                40000000, //43 IPAL
                24405000000, //44 Investasi Tanah
                26327000000, //45 Investasi Bangunan
                23806329000, //46 Investasi Peralatan
                2970000000, //47 Investasi Persiapan
                77508329000//48 Total Investasi
            ]

            // add correct values for all 14 input fields
            var isScoreSaved = false;
            for (let i = 1; i <= 43; i++) {
                $('#isian_final' + i).on('input', function () {
                    const value = $(this).val();
                    $('#isian_final' + i).removeClass('is-invalid');
                    $('#isian_final' + i + 'e').toggleClass('d-none', true);
                });
            }


            $("#prev1").click(function () {
                window.location.href = ("{{url("/learn/evaluasi-final?case=1")}}");
            });
            $("#next1").click(function () {
                if (isScoreSaved) {
                    $.ajax({
                        type: "GET",
                           url:"https://shipyard.feylabs.my.id"+"/save-score",
                        data: {
                            user_id: {{ Auth::user()->id }},
                            score2: score
                        },
                        success: function(response) {
                            window.location.href = ("{{url("/learn/evaluasi-final?case=3")}}");
                            // This function will be called if the request succeeds
                            console.log(response);
                        },
                        error: function(xhr, status, error) {
                            // This function will be called if the request fails
                            console.error(error);
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Silakan isi dan simpan jawaban sebelum melanjutkan!',
                    });
                }
            });

            $('#simul').click(function () {
                for (let i = 1; i <= 48; i++) {
                    $('#isian_final' + i).val(correctValues[i - 1]);
                }
            });

            $('#save-answer').click(function () {
                let correct = true;
                var correctAnswer = 0;
                var wrongAnswer = 0;
                for (let i = 1; i <= 48; i++) {
                    const value = $('#isian_final' + i).val();
                    const jawaban = parseInt($('#isian_final' + i).val(), 10);
                    const seharusnya = (correctValues[i-1]);

                    if (jawaban !== seharusnya) {
                        correct = false;
                        wrongAnswer++;
                        $('#isian_final' + i).addClass('is-invalid');
                        $('#isian_final' + i + 'e').toggleClass('d-none', false);
                        $('#isian_final' + i + 'e').text("Jawaban seharusnya adalah " + seharusnya + "" +
                            " jawaban anda "+jawaban);
                    } else {
                        correctAnswer++;
                        $('#isian_final' + i).removeClass('is-invalid');
                        $('#isian_final' + i + 'e').toggleClass('d-none', true);
                    }
                }

                var percentage = (correctAnswer / 48) * 100;
                var roundedPercentage = percentage.toFixed(1);
                console.log(roundedPercentage); // Outputs 43.5
                score = roundedPercentage;

                percentage = roundedPercentage
                if (percentage === 100.0) {
                    Swal.fire({
                        title: 'Good job!',
                        text: 'Your score is ' + percentage + ' . Silakan melanjutkan ke tahapan evaluasi selanjutnya',
                        icon: 'success',
                    });
                } else if (percentage < 100) {
                    Swal.fire({
                        title: 'Skor Anda Adalah : ',
                        icon: 'error',
                        html: '<i class="fas fa-frown"></i> <br>' +
                            '<strong>' + percentage + '</strong><br>Periksa jawaban benar pada bagian bawah input',
                    });
                } else {
                    Swal.fire({
                        title: 'Good job!',
                        text: 'Your score is ' + percentage + ' . Silakan melanjutkan ke tahapan evaluasi selanjutnya',
                        icon: 'success',
                    });
                }

                if (correct) {
                    // alert("Jawaban Anda Sudah Benar Semua")
                    // window.location.href = 'evaluasi-driving-parameter?case=2';
                } else {
                    $('#error-message').show();
                }
                isScoreSaved = true;
            });


            $('#reset').click(function () {
                for (let i = 1; i <= 48; i++) {
                    $('#isian_final' + i).val("");
                }
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
                    <li class="breadcrumb-item active"><a href="{{url("")}}">EVALUATION OF ESTIMATED INVESTMENT COST OF
                            THE NEW BUILDING SHIPYARD</a></li>
                </ol>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-xl-12 ">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <h5 class="card-title text-dark">
                                Berikut adalah biaya - biaya yang perlu dipertimbangkan dalam melakukan estimasi :
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-xl-6">
                                    <table class="table table-bordered">
                                        <tr class="bg-primary text-white">
                                            <td colspan="3">Tabel Harga Tanah</td>
                                        </tr>
                                        <tr>
                                            <td>Lokasi</td>
                                            <td>Harga</td>
                                            <td>Satuan</td>
                                        </tr>
                                        <tr>
                                            <td>Lamongan</td>
                                            <td> Rp650,000.00</td>
                                            <td>/m2</td>
                                        </tr>
                                        <tr>
                                            <td>Gresik</td>
                                            <td> Rp700,000.00</td>
                                            <td>/m2</td>
                                        </tr>
                                        <tr>
                                            <td>Batam</td>
                                            <td> Rp1,200,000.00</td>
                                            <td>/m2</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-12 col-xl-6">
                                    <table class="table table-bordered">
                                        <tr class="bg-primary text-white">
                                            <td colspan="3">Tabel Biaya Topografi Tanah</td>
                                        </tr>
                                        <tr>
                                            <td>Komponen</td>
                                            <td>Harga</td>
                                            <td>Satuan</td>
                                        </tr>
                                        <tr>
                                            <td>Biaya Land Clearing</td>
                                            <td> Rp20,000.00</td>
                                            <td>/m2</td>
                                        </tr>
                                        <tr>
                                            <td>Biaya Pengurugan Tanah</td>
                                            <td> Rp120,000.00</td>
                                            <td>/m2</td>
                                        </tr>
                                        <tr>
                                            <td>Biaya Pemadatan Tanah</td>
                                            <td> Rp20,000.00</td>
                                            <td>/m2</td>
                                        </tr>
                                        <tr>
                                            <td>Biaya Pengerukan</td>
                                            <td> Rp50,000.00</td>
                                            <td>/m3</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-12 col-xl-6">
                                    <table class="table table-bordered">
                                        <tr class="bg-primary text-white">
                                            <td colspan="3">Tabel Pekerjaan Persiapan</td>
                                        </tr>
                                        <tr>
                                            <td>Komponen</td>
                                            <td>Biaya</td>
                                            <td>Satuan</td>
                                        </tr>
                                        <tr>
                                            <td>Generator Listrik 100 KVA</td>
                                            <td> Rp450,000,000</td>
                                            <td>/ unit</td>
                                        </tr>
                                        <tr>
                                            <td>Generaror Listrik 80 KVA</td>
                                            <td> Rp325,000,000</td>
                                            <td>/ unit</td>
                                        </tr>
                                        <tr>
                                            <td>Generator Listrik 60 KVA</td>
                                            <td> Rp215,000,000</td>
                                            <td>/ unit</td>
                                        </tr>
                                        <tr>
                                            <td>Instalasi Air Bersih dan Listrik</td>
                                            <td> Rp50,000,000</td>
                                            <td>/ unit</td>
                                        </tr>
                                        <tr>
                                            <td>IPAL</td>
                                            <td> Rp40,000,000</td>
                                            <td>/ unit</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-12 col-xl-6">
                                    <table class="table table-bordered">
                                        <tr class="bg-primary text-white">
                                            <td colspan="3">Tabel Biaya Material Handling</td>
                                        </tr>
                                        <tr>
                                            <td>Komponen</td>
                                            <td>Harga</td>
                                            <td>Satuan</td>
                                        </tr>
                                        <tr>
                                            <td>Forklift 3 Ton</td>
                                            <td>108726800</td>
                                            <td>/unit</td>
                                        </tr>
                                        <tr>
                                            <td>Overhead Crane 5 Ton</td>
                                            <td>152994140</td>
                                            <td>/unit</td>
                                        </tr>
                                        <tr>
                                            <td>Mobile Crane 25 Ton</td>
                                            <td>1320254000</td>
                                            <td>/unit</td>
                                        </tr>
                                        <tr>
                                            <td>Mobile Crane 50 Ton</td>
                                            <td>2174536000</td>
                                            <td>/unit</td>
                                        </tr>
                                        <tr>
                                            <td>Transporter</td>
                                            <td> Rp4,350,000,000</td>
                                            <td>/unit</td>
                                        </tr>
                                    </table>
                                </div>

                                <h5 class="col-12 text-black mt-3">
                                    ESTIMASIKANLAH BIAYA INVESTASI GALANGAN KAPAL BANGUNAN BARU BERDASARAN KONDISI YANG
                                    DIKETAHUI SESUAI DENGAN YANG TELAH DIJELASKAN
                                    <br>AKAN DILAKUKAN EVALUASI BERKALI - KALI ( MINIMAL 3 KALI )
                                    <br>SETIAP SETELAH SETELAH SELESAI MELAKUKAN EVALUASI, USER AKAN DIBERITAHU BIAYA
                                    YANG MASIH BELUM SESUAI
                                </h5>

                                <hr>
                                <h6 class="text-danger bold">Catatan : Wajib Mengisi Pada Bagian Harga</h6>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 ">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <span class="current_status badge badge-xl light badge-primary">Kondisi 2</span><br>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered text-black">
                                <tr>
                                    <td>kondisi 2</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Lokasi :</td>
                                    <td>Lamongan</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Kedalaman Perairan :</td>
                                    <td>2.5</td>
                                    <td>m</td>
                                </tr>
                                <tr>
                                    <td>Ukuran Tanah :</td>
                                    <td>235 x 100</td>
                                    <td>m2</td>
                                </tr>
                                <tr>
                                    <td>DWT Kapal :</td>
                                    <td>5800</td>
                                    <td>DWT</td>
                                </tr>
                                <tr>
                                    <td>L :</td>
                                    <td>95.54</td>
                                    <td>m</td>
                                </tr>
                                <tr>
                                    <td>B :</td>
                                    <td>16.62</td>
                                    <td>m</td>
                                </tr>
                                <tr>
                                    <td>H :</td>
                                    <td>8.35</td>
                                    <td>m</td>
                                </tr>
                                <tr>
                                    <td>T actual :</td>
                                    <td>6.03</td>
                                    <td>m</td>
                                </tr>
                                <tr>
                                    <td>Wst :</td>
                                    <td>1580.94</td>
                                    <td>ton</td>
                                </tr>
                                <tr>
                                    <td>Sarana Peluncuran :</td>
                                    <td>Airbag System</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h3>Investasi Tanah</h3>
                                    <table class="table text-black table-bordered table-responsive-sm">
                                        <tr>
                                            <td>Uraian</td>
                                            <td>Ukuran</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>Harga / Unit</td>
                                            <td>Total Harga</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Panjang (m)</td>
                                            <td>Lebar (m)</td>
                                            <td>Tinggi (m)</td>
                                            <td>Luas (m2)</td>
                                            <td>Volume (m3)</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Tanah</td>
                                            <td class="">
                                                <input id="isian1" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian1e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian2" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian2e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final1" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final1e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Land Clearing</td>
                                            <td class="">
                                                <input id="isian1" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian1e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian2" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian2e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final2" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final2e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pengurugan Tanah</td>
                                            <td class="">
                                                <input id="isian1" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian1e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian2" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian2e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final3" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pemadatan Tanah</td>
                                            <td class="">
                                                <input id="isian1" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian1e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian2" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian2e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final4" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final4e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pengerukan Dalam Air</td>
                                            <td class="">
                                                <input id="isian1" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian1e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian2" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian2e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final5" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final5e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>Total =</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="col-12">
                                    <h3>Investasi Bangunan</h3>
                                    <table class="table text-black table-bordered table-responsive-sm">
                                        <tr>
                                            <td>Uraian</td>
                                            <td>Ukuran</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>Harga / Unit</td>
                                            <td>Total Harga</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Panjang (m)</td>
                                            <td>Lebar (m)</td>
                                            <td>Tinggi (m)</td>
                                            <td>Luas (m2)</td>
                                            <td>Volume (m3)</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Sarana Pengedokan (…..)</td>
                                            <td class="">
                                                <input id="isian1" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian1e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian2" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian2e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final6" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final6e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Gudang Penyimpanan</td>
                                            <td class="">
                                                <input id="isian1" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian1e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian2" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian2e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final7" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final7e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Bengkel Persiapan</td>
                                            <td class="">
                                                <input id="isian1" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian1e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian2" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian2e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final8" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final8e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Bengkel Fabrikasi</td>
                                            <td class="">
                                                <input id="isian1" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian1e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian2" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian2e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final9" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final9e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Bengkel Sub Assembly</td>
                                            <td class="">
                                                <input id="isian1" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian1e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian2" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian2e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final10" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final10e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Bengkel Assembly</td>
                                            <td class="">
                                                <input id="isian1" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian1e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian2" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian2e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final11" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final11e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Bengkel Blasting and painting</td>
                                            <td class="">
                                                <input id="isian1" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian1e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian2" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian2e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final12" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final12e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pos Keamanan</td>
                                            <td class="">
                                                <input id="isian1" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian1e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian2" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian2e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final13" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final13e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Area Parkir</td>
                                            <td class="">
                                                <input id="isian1" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian1e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian2" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian2e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final14" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final14e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kantor</td>
                                            <td class="">
                                                <input id="isian1" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian1e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian2" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian2e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final15" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final15e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Mushola</td>
                                            <td class="">
                                                <input id="isian1" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian1e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian2" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian2e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final16" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final16e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Toilet</td>
                                            <td class="">
                                                <input id="isian1" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian1e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian2" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian2e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final17" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final17e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Ruangan Listrik</td>
                                            <td class="">
                                                <input id="isian1" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian1e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian2" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian2e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final18" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final18e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>Total :</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-12">
                                    <h3>Investasi Peralatan</h3>
                                    <table class="table text-black table-bordered table-responsive-sm">
                                        <tr>
                                            <td>Investasi Peralatan</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Item</td>
                                            <td>Harga Satuan</td>
                                            <td>Jumlah ( Unit )</td>
                                            <td>Total Harga</td>
                                        </tr>
                                        <tr>
                                            <td>Winch</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final19" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final19e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Gudang Penyimpanan</td>
                                            <td class="">

                                            </td>
                                            <td class="">

                                            </td>
                                            <td class="">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Rak</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final20" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final20e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Forklift</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final21" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final21e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Bengkel Persiapan</td>
                                            <td class="">

                                            </td>
                                            <td class="">

                                            </td>
                                            <td class="">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Straightening Machine</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final22" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final22e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Shot Blasting Machine</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final23" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final23e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Overhead Crane 5 ton</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final24" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final24e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Bengkel Fabrikasi</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>CNC Plasma Cutting Machine</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final25" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final25e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Flame Planner</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final26" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final26e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Bending Machine</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final27" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final27e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Overhead Crane 5 ton</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final28" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final28e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Bengkel Sub-Assembly</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">

                                        </tr>
                                        <tr>
                                            <td>SAW Welding Machine</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final29" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final29e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>FCAW Welding Machine</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final30" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final30e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Mobile Crane 25 ton</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final31" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final31e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Bengkel Assembly</td>
                                            <td class="">

                                            </td>
                                            <td class="">

                                            </td>
                                            <td class="">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>SAW Welding Machine</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final32" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final32e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>FCAW Welding Machine</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final33" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final33e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Mobile Crane 50 ton</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final34" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final34e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Erection Area</td>
                                            <td class="">

                                            </td>
                                            <td class="">

                                            </td>
                                            <td class="">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>SAW Welding Machine</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final35" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final35e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>FCAW Welding Machine</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final36" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final36e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Mobile Crane 50 ton</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final37" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final37e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Transporter</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final38" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final38e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>Total =</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-12">
                                    <h3>Investasi Persiapan</h3>
                                    <table class="table text-black table-bordered table-responsive-sm">
                                        <tr>
                                            <td>Investasi Persiapan</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Item</td>
                                            <td>Jumlah</td>
                                            <td>Harga Satuan</td>
                                            <td> Total Harga</td>
                                        </tr>
                                        <tr>
                                            <td>Generator ( 100 KVA )</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final39" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final39e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Geberator ( 80 KVA )</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final40" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final40e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Generator ( 60 KVA )</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final41" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final41e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Instalasi Air Bersih dan Listrik</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final42" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final42e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>IPAL</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                            <td class="">
                                                <input id="isian_final43" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final43e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>Total =</td>
                                            <td class="">
                                                <input id="isian3" type="number" class="form-control bgl-warning "
                                                       placeholder="">
                                                <small id="isian3e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-12">
                                    <table class="table text-black table-bordered table-responsive-sm">
                                        <tr>
                                            <td>Item</td>
                                            <td>Biaya</td>
                                        </tr>
                                        <tr>
                                            <td>Investasi Tanah</td>
                                            <td class="">
                                                <input id="isian_final44" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final44e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Investasi Bangunan</td>
                                            <td class="">
                                                <input id="isian_final45" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final45e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Investasi Peralatan</td>
                                            <td class="">
                                                <input id="isian_final46" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final46e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Investasi Persiapan</td>
                                            <td class="">
                                                <input id="isian_final47" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final47e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr class="text-primary">
                                            <td>Total Investasi</td>
                                            <td class="">
                                                <input id="isian_final48" type="number" class="form-control bgl-success "
                                                       placeholder="">
                                                <small id="isian_final48e" class="text-danger d-none">
                                                </small>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-footer border-0 pt-0">
                            <div class="text-left mt-4">
                                <div id="reset" class="btn btn-outline-danger btn-sm col-3">Reset</div>
                                <div id="simul" class="btn btn-outline-secondary btn-sm col-3">Simulasi</div>
                                <div id="save-answer" class="btn btn-outline-secondary btn-sm col-3">Simpan Jawaban
                                </div>
                            </div>
                            <div class="text-right mt-3">
                                <div class="float-right mb-2">
                                    <div id="next1" href="next.html" class="btn btn-primary btn-sm d-none">Next</div>
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
@endsection
