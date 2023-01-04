@extends('168_template')
@include('168_component.util.wyswyig')


@section("header_name")
    UNDERSTANDING OF INVESTMENTS COST ESTIMATION METHODS
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
            $("#prev1").click(function () {
                window.location.href = ("{{url("/learn/rekayasa-pengalaman")}}");
            });

            $("#next1").click(function () {
                window.location.href = ("{{url("/learn/evaluasi-driving-parameter?case=1")}}");
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
                    <li class="breadcrumb-item active"><a href="{{url("")}}">UNDERSTANDING OF INVESTMENTS COST
                            ESTIMATION METHODS</a></li>
                </ol>
            </div>
            <!-- row -->

            <div class="row">
                <div class="col-xl-12 ">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <h5 class="card-title text-dark">Driving Parameter

                            </h5>
                        </div>
                        <div class="card-body">
                            <h4>Pola hubungan data yang diketahui dengan komponen pembentuk biaya investasi yang akan
                                membentuk nilai biaya investasi galangan kapal bangunan baru</h4>
                            <div class="text-center">
                                <img src="http://feylabs.my.id/fm/agsa/Picture5.png" alt=""
                                     class="img-fluid mt-4 mb-4">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 ">
                    <div class="card">
                        <div class="card-body">
                            <img style="max-height: 70px;" src="http://feylabs.my.id/fm/agsa/Picture6.png" alt=""
                                 class="img-fluid mt-4 mb-4">
                            <h4>Dari Kondisi Geografis dan Topografi Tanah, dapat diketahui Biaya :</h4>
                            <table class="table-borderless" border="0">
                                <tr>
                                    <th>1. Harga Tanah</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>2. Biaya Pengerjaan Tanah :</th>
                                    <td>Biaya Land Clearing</td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>Biaya Pengurugan Tanah</td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>Biaya Pemadatan Tanah</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 ">
                    <div class="card">
                        <div class="card-body">
                            <img style="max-height: 70px;" src="http://feylabs.my.id/fm/agsa/Picture8.png" alt=""
                                 class="img-fluid mt-4 mb-4">
                            <h5>Syarat dilakukan pengerukan adalah Sarat kapal kosong > kedalaman perairan <br>
                                Biaya Pengerukan dapat diketahui dengan mengkalikan Volume dengan Biaya pengerukan per
                                volume
                            </h5>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 ">
                    <div class="card">
                        <div class="card-body">
                            <img style="max-height: 70px;" src="http://feylabs.my.id/fm/agsa/Picture7.png" alt=""
                                 class="img-fluid mt-4 mb-4">
                            <h5>
                                Dari DWT Kapal dapat diketahui dimesi kapal, kemudian dari dimensi kapal akan diketahui
                                Ukuran Sarana Peluncuran.<br>
                                Sarana Peluncuran :<br>
                                Graving Dock<br>
                                Slipway<br>
                                Airbag System<br><br>

                                Winch dibutuhkan dalam Slipway dan Airbag System.

                            </h5>

                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <img src="http://feylabs.my.id/fm/agsa/Picture9.png" alt=""
                                         class="img-fluid mt-4 mb-4">
                                </div>
                                <div class="col-md-6 col-12">
                                    <img src="http://feylabs.my.id/fm/agsa/Picture10.png" alt=""
                                         class="img-fluid mt-4 mb-4">
                                </div>
                                <div class="col-md-6 col-12">
                                    <img src="http://feylabs.my.id/fm/agsa/Picture11.png" alt=""
                                         class="img-fluid mt-4 mb-4">
                                </div>
                                <div class="col-md-6 col-12">
                                    <img src="http://feylabs.my.id/fm/agsa/Picture12.png" alt=""
                                         class="img-fluid mt-4 mb-4">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-12 ">
                    <div class="card">
                        <div class="card-body">
                            <img style="max-height: 70px;" src="http://feylabs.my.id/fm/agsa/Picture13.png" alt=""
                                 class="img-fluid mt-4 mb-4">
                            <h5>
                                Dari DWT Kapal didapatkan Berat Baja yang dibutuhkan (Wst) Kapal, lalu akan didapatkan
                                Biaya :
                            </h5>
                            <div class="text-center">
                                <img style="max-height: 350px" src="http://feylabs.my.id/fm/agsa/Picture14.png" alt=""
                                     class="img-fluid mt-4 mb-4">
                            </div>

                            <h5 class="mt-3">
                                1.Gudang dan Perbengkelan
                                <br>Dari Wst Kapal akan didapatkan kebutuhan plat dan profil, lalu dari kebutuhan pelat
                                dan profil akan didapatkan luas gudang.
                                <br>Luas perbengkelan mengikuti luas gudang.
                            </h5>

                            <div class="text-center">
                                <img style="max-height: 350px" src="http://feylabs.my.id/fm/agsa/Picture15.png" alt=""
                                     class="img-fluid mt-4 mb-4">
                            </div>


                            <h5 class="mt-3">
                                2.Peralatan Produksi
                                <br>Dari Wst Kapal akan didapatkan kebutuhan plat dan profil, lalu dari kebutuhan pelat
                                dan profil akan didapatkan luas gudang.
                                <br>Luas perbengkelan mengikuti luas gudang.
                                <br><br>
                                Dari Wst akan didapatkan Beban Kerja Mesin per hari setiap bengkel. Diasumiskan sebagai berikut :
                            </h5>

                            <h5 class="mt-3">
                                Material Handling
                                <br>Untuk material handling yang digunakan pada aplikasi ini diasumsikan sama pada setiap kapal karena perbedaan berat baja kapal (Wst) antara kapal tidak jauh.
                                <br>namun pada kenyataanya, kebutuhan material handling sangat tergantung dengan ukuran kapal karena jika ukuran kapal makin besar, maka berat baja kapal juga akan semakin berat dan kapasitas material handling pun akan meningkat.
                                <br><br>
                                Berikut adalah material handling yang akan digunakan :
                                <br>1.	Forklift 3 Ton
                                <br>2.	Overhead Crane 5 Ton
                                <br>3.	Mobile Crane 25 Ton
                                <br>4.	Mobile Crane 50 Ton
                                <br>5.	Transporter
                            </h5>

                            <table class="table table-bordered table-responsive-sm">
                                <tr>
                                    <th>Tahap</th>
                                    <td>Waktu pengerjaan ( Bulan )</td>
                                </tr>
                                <tr>
                                    <th>Preparation</th>
                                    <td>6</td>
                                </tr>
                                <tr>
                                    <th>Fabrication</th>
                                    <td>8</td>
                                </tr>
                                <tr>
                                    <th>Sub Assembly</th>
                                    <td>9</td>
                                </tr>
                                <tr>
                                    <th>Assembly</th>
                                    <td>9</td>
                                </tr>
                                <tr>
                                    <th>Erection</th>
                                    <td>9</td>
                                </tr>
                            </table>

                            <h5>Dari Waktu Pengerjaan di atas didapatkan kebutuhan peralatan sebagai berikut :</h5>
                            <div class="text-center">
                                <img style="max-height: 350px" src="http://feylabs.my.id/fm/agsa/Picture16.png" alt=""
                                     class="img-fluid mt-4 mb-4">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-12 ">
                    <div class="card">
                        <div class="card-body">
                            <h5>Pada flowchart deiving parameter, biaya bangunan pendukung dan biaya investasi persiapan tidak memiliki hubungan dengan kondisi yang diketahui.
                                Itu menandakan bahwa komponen - komponen ini jumlah dan ukurannya sama besar di setiap kondisi seperti yang sudah dipaparkan pada laman rekayasa pengalaman.
                            </h5>

                            <h5>Perhitungan Estimasi Biaya
                                Setelah driving parameter dijelaskan, perhitungan biaya estimasi per komponen sudah dopat dihitung.
                                berikut adalah perhitungan estimasi biaya sesuai dengan rekayasa pengalaman di laman sebelumnya :
                            </h5>

                            <table class="table table-bordered table-responsive-sm">
                            <tr>
                                    <th>Komponen Biaya</th>
                                    <td></td>
                                    <td>Keterangan Mencari Biaya</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Investasi Tanah</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Tanah</th>
                                    <td></td>
                                    <td>Luasan Tanah x Harga Tanah /m2</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Land Clearing</th>
                                    <td></td>
                                    <td>Luasan Tanah x Biaya Land Clearing /m2</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Pengurugan Tanah</th>
                                    <td></td>
                                    <td>Luasan Tanah x Biaya Pengurugan Tanah /m2</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Pemadatan Tanah</th>
                                    <td></td>
                                    <td>Luasan Tanah x Biaya Pemadatan Tanah /m2</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Pengerukan Dalam Air</th>
                                    <td></td>
                                    <td>Volume Pengerukan x Biaya Pengerukan /m3</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td></td>
                                    <td>- Volume Pengerukan = Lebar Tanah x 100 x (Sarat Kapal Kosong - Kedalaman Air)</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td></td>
                                    <td>- 100 = Asumsi Panjang Pengerukan di perairan 100 m dari bibir pantai</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td></td>
                                    <td>- Jika Kedalaman Perairan &gt; Sarat Kapal Kosong, maka tidak ada pengerukan</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Investasi Bangunan</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Graving Dock</th>
                                    <td></td>
                                    <td>Volume Graving Dock x Biaya Graving Dock /m3</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Slipway</th>
                                    <td></td>
                                    <td>Luasan Slipway x Biaya Slipway /m2 + Harga Winch yang Dibutuhkan</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Airbag System</th>
                                    <td></td>
                                    <td>Jumlah Airbag x Harga Airbag /pcs + Harga Winch yang Dibutuhkan</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Gudang Penyimpanan dan Perbengkelan</th>
                                    <td></td>
                                    <td>Luasan Gudang x Biaya Bangunan Semi Tertutup /m2</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Pos Keamanan</th>
                                    <td></td>
                                    <td>Luasan masing - masing komponen sesuai dengan lama rekayasa pengalaman x Biaya Bangunan Tertutup /m2</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Kantor</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Mushola</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Toilet </th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Ruangan Elektrik</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Area Parkir</th>
                                    <td></td>
                                    <td>Luasan area parkir sesuai dengan lama rekayasa pengalaman x Biaya Bangunan terbuka /m2</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Investasi Peralatan</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Gudang Penyimpanan</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Rak</th>
                                    <td></td>
                                    <td>Jumlah rak profil yang diperlukan x Harga satuan rak</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Forklift</th>
                                    <td></td>
                                    <td>Harga Forklift</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Bengkel Persiapan</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Straightening Machine</th>
                                    <td></td>
                                    <td>Jumlah Straightening Machine yang dibutuhkan x Harga satuan Straightening Machine</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Shot Blasting Machine</th>
                                    <td></td>
                                    <td>Jumlah Shot Blasting Machine yang dibutuhkan x Harga satuan Shot Blasting Machine</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Overhead Crane</th>
                                    <td></td>
                                    <td>Harga Overhead Crane</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Bengkel Fabrikasi</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Cutting Machine</th>
                                    <td></td>
                                    <td>Jumlah Cutting Machine yang dibutuhkan x Harga satuan Cutting Machine</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Flame Planner</th>
                                    <td></td>
                                    <td>Jumlah Flame Planner  yang dibutuhkan x Harga satuan Flame Planner</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Bending Machine</th>
                                    <td></td>
                                    <td>Jumlah Bending Machine yang dibutuhkan x Harga satuan Bending Machine</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Overhead Crane</th>
                                    <td></td>
                                    <td>Harga Overhead Crane</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Bengkel Sub Assembly</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>SAW Welding Machine</th>
                                    <td></td>
                                    <td>Jumlah SAW Welding Machine yang dibutuhkan x Harga satuan SAW Welding Machine</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>FCAW Welding Machine</th>
                                    <td></td>
                                    <td>Jumlah FCAW Welding Machine yang dibutuhkan x Harga satuan FCAW Welding Machine</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Overhead Crane</th>
                                    <td></td>
                                    <td>Harga Overhead Crane</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Bengkel Assemby</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th> SAW Welding Machine</th>
                                    <td></td>
                                    <td>Jumlah SAW Welding Machine yang dibutuhkan x Harga satuan SAW Welding Machine</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th> FCAW Welding Machine</th>
                                    <td></td>
                                    <td>Jumlah FCAW Welding Machine yang dibutuhkan x Harga satuan FCAW Welding Machine</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Overhead Crane</th>
                                    <td></td>
                                    <td>Harga Overhead Crane</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Erection Area</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th> SAW Welding Machine</th>
                                    <td></td>
                                    <td>Jumlah SAW Welding Machine yang dibutuhkan x Harga satuan SAW Welding Machine</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th> FCAW Welding Machine</th>
                                    <td></td>
                                    <td>Jumlah FCAW Welding Machine yang dibutuhkan x Harga satuan FCAW Welding Machine</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Mobile Crane</th>
                                    <td></td>
                                    <td>Harga Mobile Crane</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Gantry crane</th>
                                    <td></td>
                                    <td>Harga Gantry Crane</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Investasi Persiapan</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Generator ( 100 KVA )</th>
                                    <td></td>
                                    <td>Jumlah generator yang dibutuhkan x Harga Generator (100 KVA)</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Geberator ( 80 KVA )</th>
                                    <td></td>
                                    <td>Jumlah generator yang dibutuhkan x Harga Generator (80 KVA)</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Generator ( 60 KVA )</th>
                                    <td></td>
                                    <td>Jumlah generator yang dibutuhkan x Harga Generator (60 KVA)</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Instalasi Air Bersih</th>
                                    <td></td>
                                    <td>Biaya Instalasi Air Bersih</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>IPAL</th>
                                    <td></td>
                                    <td>Biaya IPAL</td>
                                </tr>
                            </table>
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
@endsection
