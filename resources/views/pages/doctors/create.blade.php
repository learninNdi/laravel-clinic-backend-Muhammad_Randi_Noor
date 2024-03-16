@extends('layouts.app')

@section('title', 'Create Form')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Create Form</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Doctors</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Doctors</h2>



                <div class="card">
                    <form action="{{ route('doctors.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h4>Input Text</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text"
                                    class="form-control @error('doctor_name')
                                is-invalid
                            @enderror"
                                    name="doctor_name">
                                @error('doctor_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Specialist</label>
                                <input type="text"
                                    class="form-control @error('doctor_specialist')
                                is-invalid
                            @enderror"
                                    name="doctor_specialist">
                                @error('doctor_specialist')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="number" class="form-control" name="doctor_phone">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email"
                                    class="form-control @error('doctor_email')
                                is-invalid
                            @enderror"
                                    name="doctor_email">
                                @error('doctor_email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- field buat photo --}}

                            <div class="form-group">
                                <label for="photo" class="form-label">Doctor Photo</label>
                                <img class="img-preview img-fluid mb-3 col-sm-5" style="max-height: 300px; max-width: 200px;">
                                <input class="form-control @error('photo')
                                    is-invalid @enderror" type="file" id="photo" name="photo"
                                    onchange="previewImage()">
                                @error('photo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Address</label>
                                <input type="text"
                                    class="form-control @error('address')
                                is-invalid
                            @enderror"
                                    name="address">
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>SIP</label>
                                <input type="text" class="form-control" name="sip"
                                class="form-control @error('sip') is-invalid @enderror">
                                @error('sip')
                                    <div class="invalid-feedback">
                                        {{  $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>ID IHS</label>
                                <input type="text" class="form-control" name="id_ihs"
                                class="form-control @error('id_ihs') is-invalid @enderror">
                                @error('id_ihs')
                                    <div class="invalid-feedback">
                                        {{  $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>NIK</label>
                                <input type="text" class="form-control" name="nik"
                                class="form-control @error('nik') is-invalid @enderror">
                                @error('nik')
                                    <div class="invalid-feedback">
                                        {{  $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        function previewImage() {
            const photo = document.getElementById('photo');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(photo.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endpush
