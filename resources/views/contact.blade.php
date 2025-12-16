@extends('layouts.app')

@section('title', 'Contact')

@push('styles')
    @vite(['resources/css/contact.css'])
@endpush

@section('content')
<div class="container" style="margin-top: 2rem; margin-bottom: 2rem;">
    <div class="header-section">
        <h1>Contactez-nous</h1>
        <p>Notre équipe est à votre écoute pour répondre à toutes vos questions</p>
    </div>

    <div class="content-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
        <div class="contact-info">
            <div class="info-card">
                <div class="icon-wrapper"><i class="fas fa-envelope"></i></div>
                <div class="info-content">
                    <h3>Email</h3>
                    <p>contact@gmail.com</p>
                </div>
            </div>
            <div class="info-card">
                <div class="icon-wrapper"><i class="fas fa-phone"></i></div>
                <div class="info-content">
                    <h3>Téléphone</h3>
                    <p>+237 677788876</p>
                </div>
            </div>
            <div class="info-card">
                <div class="icon-wrapper"><i class="fas fa-map-marker-alt"></i></div>
                <div class="info-content">
                    <h3>Adresse</h3>
                    <p>École Nationale Supérieure Polytechnique, Yaoundé, Cameroun</p>
                </div>
            </div>
        </div>

        <div class="form-card">
            <form action="#" method="POST"> @csrf
                <div class="form-group">
                    <label for="name">Nom complet</label>
                    <input type="text" id="name" name="name" placeholder="Votre nom" required style="width: 100%; padding: 10px; margin-bottom: 10px;">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="votre@email.com" required style="width: 100%; padding: 10px; margin-bottom: 10px;">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" required style="width: 100%; padding: 10px; height: 100px;"></textarea>
                </div>
                <button type="submit" class="btn-submit" style="background-color: #4f9cf9; color: white; padding: 10px 20px; border: none; cursor: pointer;">Envoyer</button>
            </form>
        </div>
    </div>
    
    <div class="map-container" style="margin-top: 2rem;">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3980.6947239894956!2d11.487944075337524!3d3.8702378962819837!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x108bcf2a4d612123%3A0x1c8f0ca3e5ee2906!2sEcole%20Nationale%20Sup%C3%A9rieure%20Polytechnique%20de%20Yaound%C3%A9!5e0!3m2!1sfr!2scm!4v1731422000000!5m2!1sfr!2scm" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
</div>
@endsection