@extends('layouts.main_layout')

@section('content')
<div class="main_content" id="content-bnb">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-4 d-flex justify-content-center align-items-center flex-column col-scale">
                <div class="profile-container mb-2 profile-marco">
                    
                </div>
                <div class="caption text-center">
                    <h3>Marco Petrini</h3>
                    <h5>Full-stack Developer</h5>
                </div>
            </div>
            <div class="col-md-4 d-flex justify-content-center align-items-center flex-column col-scale">
                <div class="profile-container mb-2 profile-riccardo">
                    
                </div>
                <div class="caption text-center">
                    <h3>Riccardo Belli</h3>
                    <h5>Full-stack Developer</h5>
                </div>
            </div>
            <div class="col-md-4 d-flex justify-content-center align-items-center flex-column col-scale">
                <div class="profile-container mb-2 profile-gianmarco">
                    
                </div>
                <div class="caption text-center">
                    <h3>Gianmarco Montanari</h3>
                    <h5>Full-stack Developer</h5>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-md-4 d-flex justify-content-center align-items-center flex-column col-scale">
                <div class="profile-container mb-2 profile-alessandro">
                    
                </div>
                <div class="caption text-center">
                    <h3>Alessandro Fraternali</h3>
                    <h5>Full-stack Developer</h5>
                </div>
            </div>
            <div class="col-md-4 d-flex justify-content-center align-items-center flex-column col-scale">
                <div class="profile-container mb-2 profile-umberto">
                    
                </div>
                <div class="caption text-center">
                    <h3>Umberto Del Piano</h3>
                    <h5>Full-stack Developer</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

    <script src="{{ asset('js/chiSiamo.js') }}"></script>
    
@endsection