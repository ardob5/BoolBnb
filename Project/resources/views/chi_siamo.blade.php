@extends('layouts.main_layout')

@section('content')
<div class="main_content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="profile-marco">
                    
                </div>
            </div>
            <div class="col-md-9">
                <div class="caption">
                    <h3>Marco Petrini</h3>
                    <h5>Full-stack Developer</h5>
                    <p>

                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="caption">
                    <h3>Riccardo Belli</h3>
                    <h5>Full-stack Developer</h5>
                </div>
            </div>
            <div class="col-md-3">
                <div class="profile-container">
                    <img src="" alt="profile-riccardo">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="profile-container">
                    <img src="{{ asset('img/gianmarco-profile.jpg') }}" alt="profile-gianmarco">
                </div>
            </div>
            <div class="col-md-9">
                <div class="caption">
                    <h3>Gianmarco Montanari</h3>
                    <h5>Full-stack Developer</h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="caption">
                    <h3>Alessandro Fraternali</h3>
                    <h5>Full-stack Developer</h5>
                </div>
            </div>
            <div class="col-md-3">
                <div class="profile-container">
                    <img src="" alt="profile-alessandro">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="profile-container">
                    <img src="" alt="profile-umberto">
                </div>
            </div>
            <div class="col-md-9">
                <div class="caption">
                    <h3>Umberto Del Piano</h3>
                    <h5>Full-stack Developer</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection