@extends('168_template')
@include('168_component.util.wyswyig')


@section("header_name")
    Evaluasi
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
            const correctValues = [
                '', //1
                '19500', //1
                '43900', //2
                '104',   //3
                '25',  //4
                '8',  //5
                '20800',  //6
                '239',  //7
                '24',  //8
                '5736',  //9
                '15',  //10
                '250',  //11
                '40',  //12
                '20',  //13
                '800',  //14
                '9',  //15
                '1',  //16
                '1',  //17
                '1',  //18
                '1',  //19
                '2',  //20
                '9',  //21
                '3',  //22
            ];
            // add correct values for all 14 input fields
            var isScoreSaved = false;
            for (let i = 1; i <= 23; i++) {
                $('#isian' + i).on('input', function () {
                    const value = $(this).val();
                    $('#isian' + i).removeClass('is-invalid');
                    $('#isian' + i + 'e').toggleClass('d-none', true);
                });
            }


            $("#prev1").click(function () {
                window.location.href = ("{{url("/learn/rekayasa-pengalaman")}}");
            });
            $("#next1").click(function () {
                if(isScoreSaved){
                    window.location.href = ("{{url("/learn/evaluasi-driving-parameter?case=2")}}");
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Silakan isi dan simpan jawaban sebelum melanjutkan!',
                    });
                }
            });

            $('#simul').click(function () {
                for (let i = 1; i <= 23; i++) {
                    $('#isian' + i).val(correctValues[i - 1]);
                }
            });

            $('#save-answer').click(function () {
                let correct = true;
                var correctAnswer = 0;
                var wrongAnswer = 0;
                for (let i = 1; i <= 23; i++) {
                    const value = $('#isian' + i).val();
                    if (correctValues[i - 1] !== value && i!==1) {
                        correct = false;
                        wrongAnswer++;
                        $('#isian' + i).addClass('is-invalid');
                        $('#isian' + i + 'e').toggleClass('d-none', false);
                    } else {
                        correctAnswer++;
                        $('#isian' + i).removeClass('is-invalid');
                        $('#isian' + i + 'e').toggleClass('d-none', true);
                    }
                }

                var percentage = (correctAnswer / 23) * 100;
                var roundedPercentage = percentage.toFixed(1);
                console.log(roundedPercentage); // Outputs 43.5

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
                isScoreSaved=true;
            });


            $('#reset').click(function () {
                for (let i = 1; i <= 23; i++) {
                    $('#isian' + i).val("");
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
                    <li class="breadcrumb-item active"><a href="{{url("")}}">Evaluasi Driving Parameter</a></li>
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
                            <h4>Evaluasi driving parameter merupakan evaluasi pemahaman mengenai hubungan antara kondisi
                                yang diketahui dengan ukuran yang tersedia.
                                <br>Di bawah ini akan ditampilkan ukuran dari setiap komponen yang tersedia, kemudian
                                user akan mencocokannya dengan kondisi yang diketahui, yaitu kondisi lokasi dan ukuran
                                kapal
                                <br><br><br><span>AKAN DILAKUKAN EVALUASI BERKALI - KALI SAMPAI USER PAHAM ( MINIMAL 3 KALI) </span>
                                <br>SETIAP SETELAH SETELAH SELESAI MELAKUKAN EVALUASI, USER AKAN DIBERITAHU KEBUTUHAN
                                KOMPONEN YANG BELUM SESUAI
                                <br>ISILAH KEBUTUHAN KOMPONEN SESUAI DENGAN UKURAN YANG DISEDIAKAN
                            </h4>
                            <div class="text-center">
                                <img src="{{url("/")}}/agsa/Picture5.png" alt=""
                                     class="img-fluid mt-4 mb-4">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <table class="table text-black table-bordered table-responsive-sm">
                                        <tr>
                                            <td>Graving Dock</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>L (m)</td>
                                            <td>B (m)</td>
                                            <td>H (m)</td>
                                            <td>Volume (m3)</td>
                                        </tr>
                                        <tr>
                                            <td>102</td>
                                            <td>24</td>
                                            <td>8</td>
                                            <td>19584</td>
                                        </tr>
                                        <tr>
                                            <td>103</td>
                                            <td>25</td>
                                            <td>8</td>
                                            <td>20600</td>
                                        </tr>
                                        <tr>
                                            <td>104</td>
                                            <td>25</td>
                                            <td>8</td>
                                            <td>20800</td>
                                        </tr>
                                        <tr>
                                            <td>105</td>
                                            <td>25</td>
                                            <td>8</td>
                                            <td>21000</td>
                                        </tr>
                                        <tr>
                                            <td>106</td>
                                            <td>25</td>
                                            <td>8</td>
                                            <td>21200</td>
                                        </tr>
                                        <tr>
                                            <td>107</td>
                                            <td>25</td>
                                            <td>8</td>
                                            <td>21400</td>
                                        </tr>
                                        <tr>
                                            <td>108</td>
                                            <td>25</td>
                                            <td>8</td>
                                            <td>21600</td>
                                        </tr>
                                        <tr>
                                            <td>109</td>
                                            <td>26</td>
                                            <td>9</td>
                                            <td>25506</td>
                                        </tr>
                                        <tr>
                                            <td>110</td>
                                            <td>26</td>
                                            <td>9</td>
                                            <td>25740</td>
                                        </tr>
                                        <tr>
                                            <td>111</td>
                                            <td>26</td>
                                            <td>9</td>
                                            <td>25974</td>
                                        </tr>
                                        <tr>
                                            <td>112</td>
                                            <td>26</td>
                                            <td>9</td>
                                            <td>26208</td>
                                        </tr>
                                        <tr>
                                            <td>113</td>
                                            <td>26</td>
                                            <td>9</td>
                                            <td>26442</td>
                                        </tr>
                                        <tr>
                                            <td>113</td>
                                            <td>26</td>
                                            <td>9</td>
                                            <td>26442</td>
                                        </tr>
                                        <tr>
                                            <td>114</td>
                                            <td>26</td>
                                            <td>9</td>
                                            <td>26676</td>
                                        </tr>
                                        <tr>
                                            <td>115</td>
                                            <td>27</td>
                                            <td>9</td>
                                            <td>27945</td>
                                        </tr>
                                        <tr>
                                            <td>116</td>
                                            <td>27</td>
                                            <td>9</td>
                                            <td>28188</td>
                                        </tr>
                                        <tr>
                                            <td>117</td>
                                            <td>27</td>
                                            <td>9</td>
                                            <td>28431</td>
                                        </tr>
                                        <tr>
                                            <td>117</td>
                                            <td>27</td>
                                            <td>9</td>
                                            <td>28431</td>
                                        </tr>
                                        <tr>
                                            <td>118</td>
                                            <td>27</td>
                                            <td>9</td>
                                            <td>28674</td>
                                        </tr>
                                        <tr>
                                            <td>119</td>
                                            <td>27</td>
                                            <td>9</td>
                                            <td>28917</td>
                                        </tr>
                                        <tr>
                                            <td>120</td>
                                            <td>27</td>
                                            <td>9</td>
                                            <td>29160</td>
                                        </tr>
                                        <tr>
                                            <td>120</td>
                                            <td>27</td>
                                            <td>9</td>
                                            <td>29160</td>
                                        </tr>
                                        <tr>
                                            <td>121</td>
                                            <td>28</td>
                                            <td>9</td>
                                            <td>30492</td>
                                        </tr>
                                        <tr>
                                            <td>122</td>
                                            <td>28</td>
                                            <td>9</td>
                                            <td>30744</td>
                                        </tr>
                                        <tr>
                                            <td>123</td>
                                            <td>28</td>
                                            <td>9</td>
                                            <td>30996</td>
                                        </tr>
                                        <tr>
                                            <td>123</td>
                                            <td>28</td>
                                            <td>10</td>
                                            <td>34440</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="col-2"></div>

                                <div class="col-5">
                                    <table class="table text-black table-bordered table-responsive-sm">
                                        <tr>
                                            <td>Slipway</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Panjang Slipway (m)</td>
                                            <td>Lebar Slipway (m)</td>
                                            <td>Luas Slipway (m2)</td>
                                        </tr>
                                        <tr>
                                            <td>231</td>
                                            <td>23</td>
                                            <td>5313</td>
                                        </tr>
                                        <tr>
                                            <td>234</td>
                                            <td>24</td>
                                            <td>5616</td>
                                        </tr>
                                        <tr>
                                            <td>237</td>
                                            <td>24</td>
                                            <td>5688</td>
                                        </tr>
                                        <tr>
                                            <td>239</td>
                                            <td>24</td>
                                            <td>5736</td>
                                        </tr>
                                        <tr>
                                            <td>241</td>
                                            <td>24</td>
                                            <td>5784</td>
                                        </tr>
                                        <tr>
                                            <td>243</td>
                                            <td>24</td>
                                            <td>5832</td>
                                        </tr>
                                        <tr>
                                            <td>246</td>
                                            <td>24</td>
                                            <td>5904</td>
                                        </tr>
                                        <tr>
                                            <td>248</td>
                                            <td>25</td>
                                            <td>6200</td>
                                        </tr>
                                        <tr>
                                            <td>250</td>
                                            <td>25</td>
                                            <td>6250</td>
                                        </tr>
                                        <tr>
                                            <td>252</td>
                                            <td>25</td>
                                            <td>6300</td>
                                        </tr>
                                        <tr>
                                            <td>254</td>
                                            <td>25</td>
                                            <td>6350</td>
                                        </tr>
                                        <tr>
                                            <td>256</td>
                                            <td>25</td>
                                            <td>6400</td>
                                        </tr>
                                        <tr>
                                            <td>258</td>
                                            <td>25</td>
                                            <td>6450</td>
                                        </tr>
                                        <tr>
                                            <td>260</td>
                                            <td>25</td>
                                            <td>6500</td>
                                        </tr>
                                        <tr>
                                            <td>262</td>
                                            <td>26</td>
                                            <td>6812</td>
                                        </tr>
                                        <tr>
                                            <td>263</td>
                                            <td>26</td>
                                            <td>6838</td>
                                        </tr>
                                        <tr>
                                            <td>265</td>
                                            <td>26</td>
                                            <td>6890</td>
                                        </tr>
                                        <tr>
                                            <td>267</td>
                                            <td>26</td>
                                            <td>6942</td>
                                        </tr>
                                        <tr>
                                            <td>269</td>
                                            <td>26</td>
                                            <td>6994</td>
                                        </tr>
                                        <tr>
                                            <td>270</td>
                                            <td>26</td>
                                            <td>7020</td>
                                        </tr>
                                        <tr>
                                            <td>272</td>
                                            <td>26</td>
                                            <td>7072</td>
                                        </tr>
                                        <tr>
                                            <td>274</td>
                                            <td>26</td>
                                            <td>7124</td>
                                        </tr>
                                        <tr>
                                            <td>275</td>
                                            <td>27</td>
                                            <td>7425</td>
                                        </tr>
                                        <tr>
                                            <td>277</td>
                                            <td>27</td>
                                            <td>7479</td>
                                        </tr>
                                        <tr>
                                            <td>279</td>
                                            <td>27</td>
                                            <td>7533</td>
                                        </tr>
                                        <tr>
                                            <td>280</td>
                                            <td>27</td>
                                            <td>7560</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-4">
                                    <table class="table text-black table-bordered table-responsive-sm">
                                        <tr>
                                            <td>Luasan Gudang dan Perbengkelan</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>luas gudang yang digunakan (m2)</td>
                                            <td>Panjang (m)</td>
                                            <td>Lebar (m)</td>
                                        </tr>
                                        <tr>
                                            <td>600</td>
                                            <td>30</td>
                                            <td>20</td>
                                        </tr>
                                        <tr>
                                            <td>800</td>
                                            <td>40</td>
                                            <td>20</td>
                                        </tr>
                                        <tr>
                                            <td>1000</td>
                                            <td>40</td>
                                            <td>25</td>
                                        </tr>
                                        <tr>
                                            <td>1200</td>
                                            <td>40</td>
                                            <td>30</td>
                                        </tr>
                                        <tr>
                                            <td>1400</td>
                                            <td>40</td>
                                            <td>35</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Data Kondisi Untuk Evaluasi</h3>

                        </div>

                        <div class="card-body">
                            <table class="table table-bordered table-responsive-sm">
                                <tr>
                                    <th>Kondisi 1</th>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Lokasi :</th>
                                    <td>Lamongan</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Kedalaman Perairan :</th>
                                    <td>2.5</td>
                                    <td>m</td>
                                </tr>
                                <tr>
                                    <th>Ukuran Tanah :</th>
                                    <td>195 x 100</td>
                                    <td>m2</td>
                                </tr>
                                <tr>
                                    <th>DWT Kapal :</th>
                                    <td>5400</td>
                                    <td>DWT</td>
                                </tr>
                                <tr>
                                    <th>L :</th>
                                    <td>93.48</td>
                                    <td>m</td>
                                </tr>
                                <tr>
                                    <th>B :</th>
                                    <td>16.28</td>
                                    <td>m</td>
                                </tr>
                                <tr>
                                    <th>H :</th>
                                    <td>8.08</td>
                                    <td>m</td>
                                </tr>
                                <tr>
                                    <th>T actual :</th>
                                    <td>5.89</td>
                                    <td>m</td>
                                </tr>
                                <tr>
                                    <th>Wst :</th>
                                    <td>1467.25</td>
                                    <td>ton</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 ">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <h3 class="card-title text-dark">Evaluasi Kondisi <span id="label_kondisi">1</span></h3>
                            <h4 class="card-subtitle text-black">Gunakan data pada kondisi yang sesuai</h4>
                        </div>
                        <div class="card-body">
                            <span class="current_status badge badge-xl light badge-primary">Kondisi 1</span>

                            <table class="table">
                                <tr>
                                    <td>Tanah</td>
                                    <td class="">
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Luasan Tanah :</td>
                                    <td class="">
                                        <input id="isian2" type="text" class="form-control bgl-warning "
                                               placeholder="Isian 2">
                                        <small id="isian2e" class="text-danger d-none">
                                            isian seharusnya adalah '19500',
                                        </small>
                                    </td>
                                    <td>m2</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Volume Pengerukan :</td>
                                    <td class="">
                                        <input id="isian3" type="text" class="form-control bgl-warning "
                                               placeholder="Isian 3">
                                        <small id="isian3e" class="text-danger d-none">
                                            isian seharusnya adalah '43900',
                                        </small>
                                    </td>
                                    <td>m3</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Bangunan</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Volume Graving Dock :</td>
                                    <td class="">
                                        <input id="isian4" type="text" class="form-control bgl-warning "
                                               placeholder="Isian 4">
                                        <small id="isian4e" class="text-danger d-none">
                                            isian seharusnya adalah '104',
                                        </small>
                                    </td>
                                    <td class="text-center">x</td>
                                    <td class="">
                                        <input id="isian5" type="text" class="form-control bgl-warning "
                                               placeholder="Isian 5">
                                        <small id="isian5e" class="text-danger d-none">
                                            isian seharusnya adalah '25',
                                        </small>
                                    </td>
                                    <td class="text-center">x</td>
                                    <td class="">
                                        <input id="isian6" type="text" class="form-control bgl-warning "
                                               placeholder="Isian 6">
                                        <small id="isian6e" class="text-danger d-none">
                                            isian seharusnya adalah '8',
                                        </small>
                                    </td>
                                    <td class="text-center">=</td>
                                    <td class="">
                                        <input id="isian7" type="text" class="form-control bgl-warning "
                                               placeholder="Isian 7">
                                        <small id="isian7e" class="text-danger d-none">
                                            isian seharusnya adalah '20800',
                                        </small>
                                    </td>
                                    <td class="text-center">m3</td>
                                </tr>
                                <tr>
                                    <td>Luasan Slipway :</td>
                                    <td class="">
                                        <input id="isian8" type="text" class="form-control bgl-warning "
                                               placeholder="Isian 8">
                                        <small id="isian8e" class="text-danger d-none">
                                            isian seharusnya adalah '239',
                                        </small>
                                    </td>
                                    <td class="text-center">x</td>
                                    <td class="">
                                        <input id="isian9" type="text" class="form-control bgl-warning "
                                               placeholder="Isian 9">
                                        <small id="isian9e" class="text-danger d-none">
                                            isian seharusnya adalah '24',
                                        </small>
                                    </td>
                                    <td class="text-center">=</td>
                                    <td class="">
                                        <input id="isian10" type="text" class="form-control bgl-warning "
                                               placeholder="Isian 10">
                                        <small id="isian10e" class="text-danger d-none">
                                            isian seharusnya adalah '5736',
                                        </small>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jumlah Airbag :</td>
                                    <td class="">
                                        <input id="isian11" type="text" class="form-control bgl-warning "
                                               placeholder="Isian 11">
                                        <small id="isian11e" class="text-danger d-none">
                                            isian seharusnya adalah '15',
                                        </small>
                                    </td>
                                    <td>unit</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Winch :</td>
                                    <td class="">
                                        <input id="isian12" type="text" class="form-control bgl-warning "
                                               placeholder="Isian 12">
                                        <small id="isian12e" class="text-danger d-none">
                                            isian seharusnya adalah '250',
                                        </small>
                                    </td>
                                    <td>KN</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Luasan Gudang dan Perbengkelan :</td>
                                    <td class="">
                                        <input id="isian13" type="text" class="form-control bgl-warning "
                                               placeholder="Isian 13">
                                        <small id="isian13e" class="text-danger d-none">
                                            isian seharusnya adalah '40',
                                        </small>
                                    </td>
                                    <td class="text-center">x</td>
                                    <td class="">
                                        <input id="isian14" type="text" class="form-control bgl-warning "
                                               placeholder="Isian 14">
                                        <small id="isian14e" class="text-danger d-none">
                                            isian seharusnya adalah '20',
                                        </small>
                                    </td>
                                    <td class="text-center">=</td>
                                    <td class="">
                                        <input id="isian15" type="text" class="form-control bgl-warning "
                                               placeholder="Isian 15">
                                        <small id="isian15e" class="text-danger d-none">
                                            isian seharusnya adalah '80',
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
                                </tr>
                                <tr>
                                    <td>Peralatan</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Rak :</td>
                                    <td class="">
                                        <input id="isian16" type="text" class="form-control bgl-warning "
                                               placeholder="Isian 16">
                                        <small id="isian16e" class="text-danger d-none">
                                            isian seharusnya adalah '9',
                                        </small>
                                    </td>
                                    <td>unit</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Straightening Machine :</td>
                                    <td class="">
                                        <input id="isian17" type="text" class="form-control bgl-warning "
                                               placeholder="Isian 17">
                                        <small id="isian17e" class="text-danger d-none">
                                            isian seharusnya adalah '1',
                                        </small>
                                    </td>
                                    <td>unit</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Shot Blasting Machine :</td>
                                    <td class="">
                                        <input id="isian18" type="text" class="form-control bgl-warning "
                                               placeholder="Isian 18">
                                        <small id="isian18e" class="text-danger d-none">
                                            isian seharusnya adalah '1',
                                        </small>
                                    </td>
                                    <td>unit</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>CNC Plasma Cutting Machine :</td>
                                    <td class="">
                                        <input id="isian19" type="text" class="form-control bgl-warning "
                                               placeholder="Isian 19">
                                        <small id="isian19e" class="text-danger d-none">
                                            isian seharusnya adalah '1',
                                        </small>
                                    </td>
                                    <td>unit</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Flame Planner :</td>
                                    <td class="">
                                        <input id="isian20" type="text" class="form-control bgl-warning "
                                               placeholder="Isian 20">
                                        <small id="isian20e" class="text-danger d-none">
                                            isian seharusnya adalah '1',
                                        </small>
                                    </td>
                                    <td>unit</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Bending Machine :</td>
                                    <td class="">
                                        <input id="isian21" type="text" class="form-control bgl-warning "
                                               placeholder="Isian 21">
                                        <small id="isian21e" class="text-danger d-none">
                                            isian seharusnya adalah '2',
                                        </small>
                                    </td>
                                    <td>unit</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>SAW Welding Machine :</td>
                                    <td class="">
                                        <input id="isian22" type="text" class="form-control bgl-warning "
                                               placeholder="Isian 22">
                                        <small id="isian22e" class="text-danger d-none">
                                            isian seharusnya adalah '9',
                                        </small>
                                    </td>
                                    <td>unit</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>FCAW Welding Machine :</td>
                                    <td class="">
                                        <input id="isian23" type="text" class="form-control bgl-warning "
                                               placeholder="Isian 23">
                                        <small id="isian23e" class="text-danger d-none">
                                            isian seharusnya adalah '3',
                                        </small>
                                    </td>
                                    <td>unit</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <span class="current_status badge badge-xl light badge-primary">Kondisi 1</span><br>
                            KOMPONEN YANG TIDAK ADA PADA DAFTAR DIASUMSIKAN SAMA PADA SEMUA KONDISI
                        </div>
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-footer border-0 pt-0">
                            <div class="text-left mt-4">
                                <div id="reset" class="btn btn-outline-danger btn-sm col-3">Reset</div>
                                <div id="simul" class="btn btn-outline-secondary btn-sm col-3">Simulasi</div>
                                <div id="save-answer" class="btn btn-outline-secondary btn-sm col-3">Simpan Jawaban</div>
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
