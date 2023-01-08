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

            $("#next1").click(function () {
                window.location.href = ("{{url("/learn/estimasi-biaya")}}");
            });

            $("#prev1").click(function () {
                window.location.href = ("{{url("/learn/evaluasi-pengenalan-komponen")}}");
            });

        });
    </script>

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
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <h3 class="card-title text-dark">Rekayasa Pengalaman 1</h3>
                        </div>
                        <div class="card-body">
                            <div class="accordion-item">
                                <div class="accordion-header rounded-lg collapsed" data-bs-toggle="collapse"
                                     data-bs-target="#a_init" aria-controls="a_init" aria-expanded="false"
                                     role="button">
                                    <span class="accordion-header-text"><h4>Pengenalan Proyek</h4></span>
                                    <span class="accordion-header-indicator"></span>
                                </div>
                                <div id="a_init" class="accordion__body " aria-labelledby="a_init" style="">
                                    <div style="border: 0.5px solid #ddd; border-radius: 20px; padding: 20px">
                                        <ul style="font-size: larger">
                                            <li><span class="text-dark"> Lokasi Galangan : </span>
                                                Berlokasi di Desa Socah, Kabupaten Bangkalan, Madura
                                            </li>
                                            <li><span class="text-dark"> Luasan Tanah : </span>
                                                160 x 110 m2 (Tanah Pasir berlumpur)
                                            </li>
                                            <li><span class="text-dark">Kedalaman Perairan : </span>
                                                5 m
                                            </li>
                                            <li>
                                                Tenaga Kerja diambil dari lulusan SMA/SMK dan perguruan tinggi yang ada
                                                di madura
                                            </li>
                                            <li><span class="text-dark">Harga Tanah : </span>
                                                Rp 600.000,- /m2
                                            </li>
                                            <li><span class="text-dark">Ukuran Kapal : </span>
                                                Kapal Tanker 6400 DWT dengan dimensi utama :<br>
                                                L : 98.45 m<br>
                                                B : 17.09 m<br>
                                                H : 8.76 m<br>
                                                T actual : 6.24 <br>
                                                Berat Baja Kapal (Wst) sebesar 1755.96 Ton
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <div class="accordion-header rounded-lg collapsed" data-bs-toggle="collapse"
                                     data-bs-target="#a_1" aria-controls="a_1" aria-expanded="false" role="button">
                                    <span class="accordion-header-text"><h4>Investasi Tanah</h4></span>
                                    <span class="accordion-header-indicator"></span>
                                </div>
                                <div id="a_1" class="accordion__body collapse" aria-labelledby="a_1" style="">
                                    <div style="border: 0.5px solid #ddd; border-radius: 20px; padding: 20px">
                                        <table class="table table-bordered table-responsive-sm">
                                            <tr>
                                                <th>Uraian</th>
                                                <td>Ukuran</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Harga / Unit</td>
                                                <td>Total Harga</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Panjang (m)</td>
                                                <td>Lebar (m)</td>
                                                <td>Tinggi (m)</td>
                                                <td>Luas (m2)</td>
                                                <td>Volume (m3)</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>Tanah</th>
                                                <td>160</td>
                                                <td>110</td>
                                                <td></td>
                                                <td>17600</td>
                                                <td></td>
                                                <td> Rp600,000</td>
                                                <td> Rp10,560,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Land Clearing</th>
                                                <td>160</td>
                                                <td>110</td>
                                                <td></td>
                                                <td>17600</td>
                                                <td></td>
                                                <td> Rp20,000</td>
                                                <td> Rp352,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Pengurugan Tanah</th>
                                                <td>160</td>
                                                <td>110</td>
                                                <td></td>
                                                <td>17600</td>
                                                <td></td>
                                                <td> Rp120,000</td>
                                                <td> Rp2,112,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Pemadatan Tanah</th>
                                                <td>160</td>
                                                <td>110</td>
                                                <td></td>
                                                <td>17600</td>
                                                <td></td>
                                                <td> Rp20,000</td>
                                                <td> Rp352,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Pengerukan Dalam Air</th>
                                                <td>100</td>
                                                <td>110</td>
                                                <td>2.24</td>
                                                <td></td>
                                                <td>24640</td>
                                                <td> Rp50,000</td>
                                                <td> Rp1,232,000,000</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Total =</td>
                                                <td> Rp14,608,000,000</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <div class="accordion-header rounded-lg collapsed" data-bs-toggle="collapse"
                                     data-bs-target="#a_2" aria-controls="a_2" aria-expanded="false" role="button">
                                    <span class="accordion-header-text"><h4>Investasi Bangunan</h4></span>
                                    <span class="accordion-header-indicator"></span>
                                </div>
                                <div id="a_2" class="accordion__body collapse" aria-labelledby="a_2" style="">
                                    <div style="border: 0.5px solid #ddd; border-radius: 20px; padding: 20px">
                                        <table class="table table-bordered table-responsive-sm">
                                            <tr>
                                                <th>Uraian</th>
                                                <td>Ukuran</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Harga / Unit</td>
                                                <td>Total Harga</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Panjang (m)</td>
                                                <td>Lebar (m)</td>
                                                <td>Tinggi (m)</td>
                                                <td>Luas (m2)</td>
                                                <td>Volume (m3)</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>Graving Dock 6400 DWT</th>
                                                <td>109</td>
                                                <td>25</td>
                                                <td>8</td>
                                                <td>2725</td>
                                                <td>21800</td>
                                                <td> Rp1,200,000</td>
                                                <td> Rp26,160,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Gudang Penyimpanan</th>
                                                <td>40</td>
                                                <td>20</td>
                                                <td></td>
                                                <td>800</td>
                                                <td></td>
                                                <td> Rp3,000,000</td>
                                                <td> Rp2,400,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Bengkel Persiapan</th>
                                                <td>40</td>
                                                <td>20</td>
                                                <td></td>
                                                <td>800</td>
                                                <td></td>
                                                <td> Rp3,000,000</td>
                                                <td> Rp2,400,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Bengkel Fabrikasi</th>
                                                <td>40</td>
                                                <td>20</td>
                                                <td></td>
                                                <td>800</td>
                                                <td></td>
                                                <td> Rp3,000,000</td>
                                                <td> Rp2,400,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Bengkel Sub Assembly</th>
                                                <td>40</td>
                                                <td>20</td>
                                                <td></td>
                                                <td>800</td>
                                                <td></td>
                                                <td> Rp3,000,000</td>
                                                <td> Rp2,400,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Bengkel Assembly</th>
                                                <td>40</td>
                                                <td>20</td>
                                                <td></td>
                                                <td>800</td>
                                                <td></td>
                                                <td> Rp3,000,000</td>
                                                <td> Rp2,400,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Bengkel Blasting and painting</th>
                                                <td>40</td>
                                                <td>20</td>
                                                <td></td>
                                                <td>800</td>
                                                <td></td>
                                                <td> Rp3,000,000</td>
                                                <td> Rp2,400,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Pos Keamanan</th>
                                                <td>8</td>
                                                <td>5</td>
                                                <td></td>
                                                <td>40</td>
                                                <td></td>
                                                <td> Rp5,000,000</td>
                                                <td> Rp200,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Area Parkir</th>
                                                <td>20</td>
                                                <td>40</td>
                                                <td></td>
                                                <td>800</td>
                                                <td></td>
                                                <td> Rp1,000,000</td>
                                                <td> Rp800,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Kantor</th>
                                                <td>15</td>
                                                <td>50</td>
                                                <td></td>
                                                <td>750</td>
                                                <td></td>
                                                <td> Rp5,000,000</td>
                                                <td> Rp3,750,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Mushola</th>
                                                <td>10</td>
                                                <td>10</td>
                                                <td></td>
                                                <td>100</td>
                                                <td></td>
                                                <td> Rp5,000,000</td>
                                                <td> Rp500,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Toilet</th>
                                                <td>5</td>
                                                <td>3</td>
                                                <td></td>
                                                <td>15</td>
                                                <td></td>
                                                <td> Rp5,000,000</td>
                                                <td> Rp75,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Ruangan Listrik</th>
                                                <td>5</td>
                                                <td>10</td>
                                                <td></td>
                                                <td>50</td>
                                                <td></td>
                                                <td> Rp5,000,000</td>
                                                <td> Rp250,000,000</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Total :</td>
                                                <td> Rp46,135,000,000</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <div class="accordion-header rounded-lg collapsed" data-bs-toggle="collapse"
                                     data-bs-target="#a_3" aria-controls="a_3" aria-expanded="false" role="button">
                                    <span class="accordion-header-text"><h4>Investasi Peralatan</h4></span>
                                    <span class="accordion-header-indicator"></span>
                                </div>
                                <div id="a_3" class="accordion__body collapse" aria-labelledby="a_3" style="">
                                    <div style="border: 0.5px solid #ddd; border-radius: 20px; padding: 20px">
                                        <table class="table table-bordered table-responsive-sm">
                                            <tr>
                                                <th>Item</th>
                                                <td>Harga Satuan</td>
                                                <td>Jumlah ( Unit )</td>
                                                <td>Total Harga</td>
                                            </tr>
                                            <tr style="background-color: yellow" class="text-black">
                                                <th colspan="4">Gudang Penyimpanan</th>
                                            </tr>
                                            <tr>
                                                <th>Rak</th>
                                                <td> Rp8,000,000</td>
                                                <td>11</td>
                                                <td> Rp88,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Forklift</th>
                                                <td> Rp322,000,000</td>
                                                <td>1</td>
                                                <td> Rp322,000,000</td>
                                            </tr>
                                            <tr style="background-color: yellow" class="text-black">
                                                <th colspan="4">Bengkel Persiapan</th>
                                            </tr>
                                            <tr>
                                                <th>Straightening Machine</th>
                                                <td> Rp1,703,000,000</td>
                                                <td>1</td>
                                                <td> Rp1,703,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Shot Blasting Machine</th>
                                                <td> Rp1,965,000,000</td>
                                                <td>1</td>
                                                <td> Rp1,965,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Overhead Crane 5 ton</th>
                                                <td> Rp435,000,000</td>
                                                <td>1</td>
                                                <td> Rp435,000,000</td>
                                            </tr>
                                            <tr style="background-color: yellow" class="text-black">
                                                <th colspan="4">Bengkel Fabrikasi</th>
                                            </tr>
                                            <tr>
                                                <th>CNC Plasma Cutting Machine</th>
                                                <td> Rp2,096,000,000</td>
                                                <td>1</td>
                                                <td> Rp2,096,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Flame Planner</th>
                                                <td> Rp1,048,000,000</td>
                                                <td>1</td>
                                                <td> Rp1,048,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Bending Machine</th>
                                                <td> Rp1,179,000,000</td>
                                                <td>2</td>
                                                <td> Rp2,358,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Overhead Crane 5 ton</th>
                                                <td> Rp435,000,000</td>
                                                <td>1</td>
                                                <td> Rp435,000,000</td>
                                            </tr>
                                            <tr style="background-color: yellow" class="text-black">
                                                <th colspan="4">Bengkel Sub Assembly</th>
                                            </tr>
                                            <tr>
                                                <th>SAW Welding Machine</th>
                                                <td> Rp88,000,000</td>
                                                <td>1</td>
                                                <td> Rp88,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>FCAW Welding Machine</th>
                                                <td> Rp20,075,000</td>
                                                <td>3</td>
                                                <td> Rp60,225,000</td>
                                            </tr>
                                            <tr>
                                                <th>Mobile Crane 25 ton</th>
                                                <td> Rp2,175,000,000</td>
                                                <td>1</td>
                                                <td> Rp2,175,000,000</td>
                                            </tr>
                                            <tr style="background-color: yellow" class="text-black">
                                                <th colspan="4">Bengkel Assembly</th>
                                            </tr>
                                            <tr>
                                                <th>SAW Welding Machine</th>
                                                <td> Rp88,000,000</td>
                                                <td>1</td>
                                                <td> Rp88,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>FCAW Welding Machine</th>
                                                <td> Rp20,075,000</td>
                                                <td>3</td>
                                                <td> Rp60,225,000</td>
                                            </tr>
                                            <tr>
                                                <th>Mobile Crane 50 ton</th>
                                                <td> Rp3,088,500,000</td>
                                                <td>1</td>
                                                <td> Rp3,088,500,000</td>
                                            </tr>
                                            <tr style="background-color: yellow" class="text-black">
                                                <th colspan="4">Erection Area</th>
                                            </tr>
                                            <tr>
                                                <th>SAW Welding Machine</th>
                                                <td> Rp88,000,000</td>
                                                <td>1</td>
                                                <td> Rp88,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>FCAW Welding Machine</th>
                                                <td> Rp20,075,000</td>
                                                <td>3</td>
                                                <td> Rp60,225,000</td>
                                            </tr>
                                            <tr>
                                                <th>Mobile Crane 50 ton</th>
                                                <td> Rp3,088,500,000</td>
                                                <td>1</td>
                                                <td> Rp3,088,500,000</td>
                                            </tr>
                                            <tr>
                                                <th>Transporter</th>
                                                <td> Rp4,350,000,000</td>
                                                <td>1</td>
                                                <td> Rp4,350,000,000</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td></td>
                                                <td>Total =</td>
                                                <td> Rp23,596,675,000</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <div class="accordion-header rounded-lg collapsed" data-bs-toggle="collapse"
                                     data-bs-target="#a_4" aria-controls="a_4" aria-expanded="false" role="button">
                                    <span class="accordion-header-text"><h4>Investasi Persiapan</h4></span>
                                    <span class="accordion-header-indicator"></span>
                                </div>
                                <div id="a_4" class="accordion__body collapse" aria-labelledby="a_4" style="">
                                    <div style="border: 0.5px solid #ddd; border-radius: 20px; padding: 20px">
                                        <table class="table table-bordered table-responsive-sm">
                                            <tr>
                                                <th>Item</th>
                                                <td>Jumlah</td>
                                                <td>Harga Satuan</td>
                                                <td> Total Harga</td>
                                            </tr>
                                            <tr>
                                                <th>Generator ( 100 KVA )</th>
                                                <td>4</td>
                                                <td> Rp450,000,000</td>
                                                <td> Rp1,800,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Geberator ( 80 KVA )</th>
                                                <td>2</td>
                                                <td> Rp325,000,000</td>
                                                <td> Rp650,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Generator ( 60 KVA )</th>
                                                <td>2</td>
                                                <td> Rp215,000,000</td>
                                                <td> Rp430,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Instalasi Air Bersih dan Listrik</th>
                                                <td>1</td>
                                                <td> Rp50,000,000</td>
                                                <td> Rp50,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>IPAL</th>
                                                <td>1</td>
                                                <td> Rp40,000,000</td>
                                                <td> Rp40,000,000</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td></td>
                                                <td>Total =</td>
                                                <td> Rp2,970,000,000</td>
                                            </tr>
                                        </table>
                                        <hr class="my-5">
                                        <table class="table table-bordered table-responsive-sm mt-5">
                                            <tr>
                                                <th>Item</th>
                                                <td>Biaya</td>
                                            </tr>
                                            <tr>
                                                <th>Investasi Tanah</th>
                                                <td> Rp14,608,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Investasi Bangunan</th>
                                                <td> Rp46,135,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Investasi Peralatan</th>
                                                <td> Rp23,596,675,000</td>
                                            </tr>
                                            <tr>
                                                <th>Investasi Persiapan</th>
                                                <td> Rp2,970,000,000</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>Total Investasi =</th>
                                                <td> Rp87,309,675,000</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <h3 class="card-title text-dark">Rekayasa Pengalaman 2</h3>
                        </div>
                        <div class="card-body">
                            <div class="accordion-item">
                                <div class="accordion-header rounded-lg collapsed" data-bs-toggle="collapse"
                                     data-bs-target="#b_init" aria-controls="b_init" aria-expanded="false"
                                     role="button">
                                    <span class="accordion-header-text"><h4>Pengenalan Proyek</h4></span>
                                    <span class="accordion-header-indicator"></span>
                                </div>
                                <div id="b_init" class="accordion__body " aria-labelledby="b_init" style="">
                                    <div style="border: 0.5px solid #ddd; border-radius: 20px; padding: 20px">
                                        <ul style="font-size: larger">
                                            <li><span class="text-dark"> Lokasi Galangan : </span>
                                                Berlokasi di Lamongan
                                            </li>
                                            <li><span class="text-dark"> Luasan Tanah : </span>
                                                Luasan Tanah 210 x 130 m2
                                            </li>
                                            <li><span class="text-dark">Kedalaman Perairan : </span>
                                                2.5 m
                                            </li>
                                            <li>
                                                Tenaga Kerja diambil dari lulusan SMA/SMK dan perguruan tinggi yang ada
                                                di Lamongan
                                            </li>
                                            <li><span class="text-dark">Ukuran Kapal : </span>
                                                Kapal Tanker 5200 DWT dengan dimensi utama :<br>
                                                L : 92.41 m<br>
                                                B : 16.11 m<br>
                                                H : 7.94 m<br>
                                                T actual : 5.8 m <br>
                                                Berat Baja Kapal (Wst) sebesar 1411.07 Ton
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <div class="accordion-header rounded-lg collapsed" data-bs-toggle="collapse"
                                     data-bs-target="#b_1" aria-controls="b_1" aria-expanded="false" role="button">
                                    <span class="accordion-header-text"><h4>Investasi Tanah</h4></span>
                                    <span class="accordion-header-indicator"></span>
                                </div>
                                <div id="b_1" class="accordion__body collapse" aria-labelledby="b_1" style="">
                                    <div style="border: 0.5px solid #ddd; border-radius: 20px; padding: 20px">
                                        <table class="table table-bordered table-responsive-sm">
                                            <tr>
                                                <th>Uraian</th>
                                                <td>Ukuran</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Harga / Unit</td>
                                                <td>Total Harga</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Panjang (m)</td>
                                                <td>Lebar (m)</td>
                                                <td>Tinggi (m)</td>
                                                <td>Luas (m2)</td>
                                                <td>Volume (m3)</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>Tanah</th>
                                                <td>210</td>
                                                <td>130</td>
                                                <td></td>
                                                <td>27300</td>
                                                <td></td>
                                                <td> Rp650,000</td>
                                                <td> Rp17,745,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Land Clearing</th>
                                                <td>210</td>
                                                <td>130</td>
                                                <td></td>
                                                <td>27300</td>
                                                <td></td>
                                                <td> Rp20,000</td>
                                                <td> Rp546,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Pengurugan Tanah</th>
                                                <td>210</td>
                                                <td>130</td>
                                                <td></td>
                                                <td>27300</td>
                                                <td></td>
                                                <td> Rp120,000</td>
                                                <td> Rp3,276,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Pemadatan Tanah</th>
                                                <td>210</td>
                                                <td>130</td>
                                                <td></td>
                                                <td>27300</td>
                                                <td></td>
                                                <td> Rp20,000</td>
                                                <td> Rp546,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Pengerukan Dalam Air</th>
                                                <td>100</td>
                                                <td>130</td>
                                                <td>4.3</td>
                                                <td></td>
                                                <td>55900</td>
                                                <td> Rp50,000</td>
                                                <td> Rp2,795,000,000</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Total =</td>
                                                <td> Rp24,908,000,000</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <div class="accordion-header rounded-lg collapsed" data-bs-toggle="collapse"
                                     data-bs-target="#b_2" aria-controls="b_2" aria-expanded="false" role="button">
                                    <span class="accordion-header-text"><h4>Investasi Bangunan</h4></span>
                                    <span class="accordion-header-indicator"></span>
                                </div>
                                <div id="b_2" class="accordion__body collapse" aria-labelledby="b_2" style="">
                                    <div style="border: 0.5px solid #ddd; border-radius: 20px; padding: 20px">
                                        <table class="table table-bordered table-responsive-sm">
                                            <tr>
                                                <th>Uraian</th>
                                                <td>Ukuran</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Harga / Unit</td>
                                                <td>Total Harga</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Panjang (m)</td>
                                                <td>Lebar (m)</td>
                                                <td>Tinggi (m)</td>
                                                <td>Luas (m2)</td>
                                                <td>Volume (m3)</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>Slipway</th>
                                                <td>234</td>
                                                <td>24</td>
                                                <td></td>
                                                <td>5616</td>
                                                <td>0</td>
                                                <td> Rp430,000</td>
                                                <td> Rp2,414,880,000</td>
                                            </tr>
                                            <tr>
                                                <th>Gudang Penyimpanan</th>
                                                <td>30</td>
                                                <td>20</td>
                                                <td></td>
                                                <td>600</td>
                                                <td></td>
                                                <td> Rp3,000,000</td>
                                                <td> Rp1,800,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Bengkel Persiapan</th>
                                                <td>30</td>
                                                <td>20</td>
                                                <td></td>
                                                <td>600</td>
                                                <td></td>
                                                <td> Rp3,000,000</td>
                                                <td> Rp1,800,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Bengkel Fabrikasi</th>
                                                <td>30</td>
                                                <td>20</td>
                                                <td></td>
                                                <td>600</td>
                                                <td></td>
                                                <td> Rp3,000,000</td>
                                                <td> Rp1,800,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Bengkel Sub Assembly</th>
                                                <td>30</td>
                                                <td>20</td>
                                                <td></td>
                                                <td>600</td>
                                                <td></td>
                                                <td> Rp3,000,000</td>
                                                <td> Rp1,800,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Bengkel Assembly</th>
                                                <td>30</td>
                                                <td>20</td>
                                                <td></td>
                                                <td>600</td>
                                                <td></td>
                                                <td> Rp3,000,000</td>
                                                <td> Rp1,800,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Bengkel Blasting and painting</th>
                                                <td>30</td>
                                                <td>20</td>
                                                <td></td>
                                                <td>600</td>
                                                <td></td>
                                                <td> Rp3,000,000</td>
                                                <td> Rp1,800,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Pos Keamanan</th>
                                                <td>8</td>
                                                <td>5</td>
                                                <td></td>
                                                <td>40</td>
                                                <td></td>
                                                <td> Rp5,000,000</td>
                                                <td> Rp200,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Area Parkir</th>
                                                <td>20</td>
                                                <td>40</td>
                                                <td></td>
                                                <td>800</td>
                                                <td></td>
                                                <td> Rp1,000,000</td>
                                                <td> Rp800,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Kantor</th>
                                                <td>15</td>
                                                <td>50</td>
                                                <td></td>
                                                <td>750</td>
                                                <td></td>
                                                <td> Rp5,000,000</td>
                                                <td> Rp3,750,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Mushola</th>
                                                <td>10</td>
                                                <td>10</td>
                                                <td></td>
                                                <td>100</td>
                                                <td></td>
                                                <td> Rp5,000,000</td>
                                                <td> Rp500,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Toilet</th>
                                                <td>5</td>
                                                <td>3</td>
                                                <td></td>
                                                <td>15</td>
                                                <td></td>
                                                <td> Rp5,000,000</td>
                                                <td> Rp75,000,000</td>
                                            </tr>
                                            <tr>
                                                <th>Ruangan Listrik</th>
                                                <td>5</td>
                                                <td>10</td>
                                                <td></td>
                                                <td>50</td>
                                                <td></td>
                                                <td> Rp5,000,000</td>
                                                <td> Rp250,000,000</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Total :</td>
                                                <td> Rp18,789,880,000</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <div class="accordion-header rounded-lg collapsed" data-bs-toggle="collapse"
                                     data-bs-target="#b_3" aria-controls="b_3" aria-expanded="false" role="button">
                                    <span class="accordion-header-text"><h4>Investasi Peralatan</h4></span>
                                    <span class="accordion-header-indicator"></span>
                                </div>
                                <div id="b_3" class="accordion__body collapse" aria-labelledby="b_3" style="">
                                    <div style="border: 0.5px solid #ddd; border-radius: 20px; padding: 20px">
                                        <table class="table table-bordered table-responsive-sm">

                                        <tr>
                                                <th>Item</th>
                                                <td>Harga Satuan</td>
                                                <td>Jumlah ( Unit )</td>
                                                <td>Total Harga</td>
                                            </tr>
                                            <tr>
                                                <th>Winch untuk Slipway 250 KN</th>
                                                <td> Rp187,748,400.00 </td>
                                                <td>1</td>
                                                <td> Rp187,748,400.00 </td>
                                            </tr>
                                            <tr>
                                                <th>Gudang Penyimpanan</th>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>Rak</th>
                                                <td> Rp8,000,000 </td>
                                                <td>9</td>
                                                <td> Rp72,000,000 </td>
                                            </tr>
                                            <tr>
                                                <th>Forklift</th>
                                                <td> Rp322,000,000 </td>
                                                <td>1</td>
                                                <td> Rp322,000,000 </td>
                                            </tr>
                                            <tr style="background-color: forestgreen" class="text-black">
                                                <th colspan="4">Bengkel Persiapan</th>
                                            </tr>
                                            <tr>
                                                <th>Straightening Machine</th>
                                                <td> Rp1,703,000,000 </td>
                                                <td>1</td>
                                                <td> Rp1,703,000,000 </td>
                                            </tr>
                                            <tr>
                                                <th>Shot Blasting Machine</th>
                                                <td> Rp1,965,000,000 </td>
                                                <td>1</td>
                                                <td> Rp1,965,000,000 </td>
                                            </tr>
                                            <tr>
                                                <th>Overhead Crane 5 ton</th>
                                                <td> Rp435,000,000 </td>
                                                <td>1</td>
                                                <td> Rp435,000,000 </td>
                                            </tr>
                                            <tr style="background-color: forestgreen" class="text-black">
                                                <th colspan="4">Bengkel Fabrikasi</th>
                                            </tr>
                                            <tr>
                                                <th>CNC Plasma Cutting Machine</th>
                                                <td> Rp2,096,000,000 </td>
                                                <td>1</td>
                                                <td> Rp2,096,000,000 </td>
                                            </tr>
                                            <tr>
                                                <th>Flame Planner</th>
                                                <td> Rp1,048,000,000 </td>
                                                <td>1</td>
                                                <td> Rp1,048,000,000 </td>
                                            </tr>
                                            <tr>
                                                <th>Bending Machine</th>
                                                <td> Rp1,179,000,000 </td>
                                                <td>1</td>
                                                <td> Rp1,179,000,000 </td>
                                            </tr>
                                            <tr>
                                                <th>Overhead Crane 5 ton</th>
                                                <td> Rp435,000,000 </td>
                                                <td>1</td>
                                                <td> Rp435,000,000 </td>
                                            </tr>
                                            <tr style="background-color: forestgreen" class="text-black">
                                                <th colspan="4">Bengkel Sub Assembly</th>
                                            </tr>
                                            <tr>
                                                <th>SAW Welding Machine</th>
                                                <td> Rp88,000,000 </td>
                                                <td>1</td>
                                                <td> Rp88,000,000 </td>
                                            </tr>
                                            <tr>
                                                <th>FCAW Welding Machine</th>
                                                <td> Rp20,075,000 </td>
                                                <td>3</td>
                                                <td> Rp60,225,000 </td>
                                            </tr>
                                            <tr>
                                                <th>Mobile Crane 25 ton</th>
                                                <td> Rp2,175,000,000 </td>
                                                <td>1</td>
                                                <td> Rp2,175,000,000 </td>
                                            </tr>
                                            <tr style="background-color: forestgreen" class="text-black">
                                                <th colspan="4">Bengkel Assembly</th>
                                            </tr>
                                            <tr>
                                                <th>SAW Welding Machine</th>
                                                <td> Rp88,000,000 </td>
                                                <td>1</td>
                                                <td> Rp88,000,000 </td>
                                            </tr>
                                            <tr>
                                                <th>FCAW Welding Machine</th>
                                                <td> Rp20,075,000 </td>
                                                <td>3</td>
                                                <td> Rp60,225,000 </td>
                                            </tr>
                                            <tr>
                                                <th>Mobile Crane 50 ton</th>
                                                <td> Rp3,088,500,000 </td>
                                                <td>1</td>
                                                <td> Rp3,088,500,000 </td>
                                            </tr>
                                            <tr style="background-color: forestgreen" class="text-black">
                                                <th colspan="4">Erection Area</th>
                                            </tr>
                                            <tr>
                                                <th>SAW Welding Machine</th>
                                                <td> Rp88,000,000 </td>
                                                <td>1</td>
                                                <td> Rp88,000,000 </td>
                                            </tr>
                                            <tr>
                                                <th>FCAW Welding Machine</th>
                                                <td> Rp20,075,000 </td>
                                                <td>3</td>
                                                <td> Rp60,225,000 </td>
                                            </tr>
                                            <tr>
                                                <th>Mobile Crane 50 ton</th>
                                                <td> Rp3,088,500,000 </td>
                                                <td>1</td>
                                                <td> Rp3,088,500,000 </td>
                                            </tr>
                                            <tr>
                                                <th>Transporter</th>
                                                <td> Rp4,350,000,000 </td>
                                                <td>1</td>
                                                <td> Rp4,350,000,000 </td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td></td>
                                                <td>Total =</td>
                                                <td> Rp22,401,675,000</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <div class="accordion-header rounded-lg collapsed" data-bs-toggle="collapse"
                                     data-bs-target="#b_4" aria-controls="b_4" aria-expanded="false" role="button">
                                    <span class="accordion-header-text"><h4>Investasi Persiapan</h4></span>
                                    <span class="accordion-header-indicator"></span>
                                </div>
                                <div id="b_4" class="accordion__body collapse" aria-labelledby="b_4" style="">
                                    <div style="border: 0.5px solid #ddd; border-radius: 20px; padding: 20px">
                                        <table class="table table-bordered table-responsive-sm">
                                        <tr>
                                                <th>Item</th>
                                                <td>Jumlah</td>
                                                <td>Harga Satuan</td>
                                                <td> Total Harga </td>
                                            </tr>
                                            <tr>
                                                <th>Generator ( 100 KVA )</th>
                                                <td>4</td>
                                                <td> Rp450,000,000 </td>
                                                <td> Rp1,800,000,000 </td>
                                            </tr>
                                            <tr>
                                                <th>Geberator ( 80 KVA )</th>
                                                <td>2</td>
                                                <td> Rp325,000,000 </td>
                                                <td> Rp650,000,000 </td>
                                            </tr>
                                            <tr>
                                                <th>Generator ( 60 KVA )</th>
                                                <td>2</td>
                                                <td> Rp215,000,000 </td>
                                                <td> Rp430,000,000 </td>
                                            </tr>
                                            <tr>
                                                <th>Instalasi Air Bersih dan Listrik</th>
                                                <td>1</td>
                                                <td> Rp50,000,000 </td>
                                                <td> Rp50,000,000 </td>
                                            </tr>
                                            <tr>
                                                <th>IPAL</th>
                                                <td>1</td>
                                                <td> Rp40,000,000 </td>
                                                <td> Rp40,000,000 </td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td></td>
                                                <td>Total =</td>
                                                <td> Rp2,970,000,000</td>
                                            </tr>
                                        </table>
                                        <hr class="my-5">
                                        <table class="table table-bordered table-responsive-sm">

                                        <tr>
                                                <th>Item</th>
                                                <td>Biaya</td>
                                            </tr>
                                            <tr>
                                                <th>Investasi Tanah</th>
                                                <td> Rp24,908,000,000 </td>
                                            </tr>
                                            <tr>
                                                <th>Investasi Bangunan</th>
                                                <td> Rp18,789,880,000 </td>
                                            </tr>
                                            <tr>
                                                <th>Investasi Peralatan</th>
                                                <td> Rp22,401,675,000 </td>
                                            </tr>
                                            <tr>
                                                <th>Investasi Persiapan</th>
                                                <td> Rp2,970,000,000 </td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>Total Investasi =</th>
                                                <td> Rp69,069,555,000</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-footer border-0 pt-0">
                            <div class="text-right mt-3">
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
