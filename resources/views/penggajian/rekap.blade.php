@extends('layouts.main')

@section('container')

<div class="container-fluid">
        <div class="mt-5">
            <h3>{{$pengajuan_penggajian->keterangan}}</h3>
            <h3>Periode {{$pengajuan_penggajian->periode_start}} S/D {{$pengajuan_penggajian->periode_end}}</h3>
            

            <div class="mt-3 table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="bg-white">
                        <tr>
                            <th rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;">No</th>
                            <th rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;">Nama</th>
                            <th rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;">No rekening</th>
                            <th rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;">Pokok</th>
                            <th rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;">Hari</th>
                            <th colspan="2" class="text-center">Lembur</th>
                            <th colspan="2" class="text-center">Transport</th>
                            <th rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;">Rembes</th>
                            <th rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;">Potong Hutang</th>
                            <th rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;">Total</th>
                        </tr>
                        <tr>
                            <th width="5">Jam</th>
                            <th></th>
                            <th width="45"></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @if(!empty($listing_karyawan))
                        @foreach($listing_karyawan as $get_listing_karyawan)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td>{{ $get_listing_karyawan->karyawan->nama_karyawan }}</td>
                            <td>{{ $get_listing_karyawan->karyawan->no_rekening }}</td>
                            <td class="text-right">{{ number_format($get_listing_karyawan->gaji_pokok) }}</td>
                            <td class="text-right">
                                @if($get_listing_karyawan->status_karyawan == 0)
                                {{ $get_listing_karyawan->jumlah_hari }}
                                @else
                                -
                                @endif
                            </td>
                            <td class="text-right">{{ $get_listing_karyawan->jumlah_lembur }}</td>
                            <td class="text-right">
                                @php
                                    $gaji_pokok = $get_listing_karyawan->gaji_pokok;
                                    $jumlah_lembur = $get_listing_karyawan->jumlah_lembur;

                                    $total_lembur = $gaji_pokok / 8 * $jumlah_lembur;

                                    echo number_format($total_lembur);
                                @endphp
                            </td>
                            <td></td>
                            <td class="text-right">Rp. {{ number_format($get_listing_karyawan->nominal_transport) }}</td>
                            <td class="text-right">Rp. {{ number_format($get_listing_karyawan->nominal_rembes) }}</td>
                            <td class="text-right">Rp. {{ number_format($get_listing_karyawan->nominal_hutang) }}</td>
                            <td class="d-none total">
                                
                                @php 
                                    $gaji_pokok = $get_listing_karyawan->gaji_pokok;
                                    $jumlah_hari = $get_listing_karyawan->jumlah_hari;

                                    $total = $gaji_pokok * $jumlah_hari;

                                    $sub_total = $total + $total_lembur + $get_listing_karyawan->nominal_rembes + $get_listing_karyawan->nominal_transport;
                                    echo $sub_total - $get_listing_karyawan->nominal_hutang
                                @endphp
                            </td>
                            <td class="text-right">
                                @php 
                                    $gaji_pokok = $get_listing_karyawan->gaji_pokok;
                                    $jumlah_hari = $get_listing_karyawan->jumlah_hari;

                                    $total = $gaji_pokok * $jumlah_hari;

                                    $sub_total = $total + $total_lembur + $get_listing_karyawan->nominal_rembes + $get_listing_karyawan->nominal_transport;
                                    echo number_format($sub_total - $get_listing_karyawan->nominal_hutang)
                                @endphp
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                    <tbody>
                        <tr>
                            <td colspan="2"></td>
                            <td></td>
                            <td></td>
                            <td class="text-right"></td>
                            <td></td>
                            <td></td>
                            
                            <td></td>
                            <td class="text-right"></td>
                            <td colspan="2" class="text-center fw-bold">TOTAL</td>
                            <td class="text-right" id="grand_total"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
    
    <!-- Template Main JS File -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        var cells = document.getElementsByClassName("total");

        var total = 0;
        for (var i = 0; i < cells.length; i++) {
            var cellValue = parseInt(cells[i].textContent);
            total += cellValue;
        }

        var formatted = total.toLocaleString("id-ID").replace(/\./g, ',');;

        var element_grand_total = document.getElementById('grand_total').innerHTML = formatted;
    </script>
@endsection