@extends('layouts.app')

@section('title', 'Contact')

@push('styles')
    @vite(['resources/css/contact.css'])
@endpush

@section('content')
<div class="container" style="margin-top: 2rem; margin-bottom: 2rem; max-width: 1200px; margin-left: auto; margin-right: auto; padding: 0 15px;">
    
    @if(session('success'))
        <div style="background-color: #d1fae5; color: #065f46; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #34d399; display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="header-section" style="text-align: center; margin-bottom: 3rem;">
        <h1 style="color: #1f2937; margin-bottom: 10px;">Contactez-nous</h1>
        <p style="color: #6b7280;">Notre équipe est à votre écoute pour répondre à toutes vos questions</p>
    </div>

    <div class="content-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
        
        <div class="contact-info">
            <div class="info-card" style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px; padding: 20px; background: white; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                <div class="icon-wrapper" style="width: 40px; height: 40px; background: #eff6ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #3b82f6;">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="info-content">
                    <h3 style="margin: 0; font-size: 1.1rem; color: #374151;">Email</h3>
                    <p style="margin: 5px 0 0; color: #6b7280;">contact@gmail.com</p>
                </div>
            </div>

            <div class="info-card" style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px; padding: 20px; background: white; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                <div class="icon-wrapper" style="width: 40px; height: 40px; background: #eff6ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #3b82f6;">
                    <i class="fas fa-phone"></i>
                </div>
                <div class="info-content">
                    <h3 style="margin: 0; font-size: 1.1rem; color: #374151;">Téléphone</h3>
                    <p style="margin: 5px 0 0; color: #6b7280;">+237 677788876</p>
                </div>
            </div>

            <div class="info-card" style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px; padding: 20px; background: white; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                <div class="icon-wrapper" style="width: 40px; height: 40px; background: #eff6ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #3b82f6;">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="info-content">
                    <h3 style="margin: 0; font-size: 1.1rem; color: #374151;">Adresse</h3>
                    <p style="margin: 5px 0 0; color: #6b7280;">École Nationale Supérieure Polytechnique, Yaoundé, Cameroun</p>
                </div>
            </div>
        </div>

        <div class="form-card" style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            
            <form action="{{ route('contact.submit') }}" method="POST"> 
                @csrf
                
                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="name" style="display: block; margin-bottom: 8px; font-weight: 500; color: #374151;">Nom complet</label>
                    <input type="text" id="name" name="name" placeholder="Votre nom" required 
                           style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; outline: none; transition: border-color 0.3s;">
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="email" style="display: block; margin-bottom: 8px; font-weight: 500; color: #374151;">Email</label>
                    <input type="email" id="email" name="email" placeholder="votre@email.com" required 
                           style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; outline: none;">
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="message" style="display: block; margin-bottom: 8px; font-weight: 500; color: #374151;">Message</label>
                    <textarea id="message" name="message" required 
                              style="width: 100%; padding: 12px; height: 120px; border: 1px solid #d1d5db; border-radius: 8px; outline: none; resize: vertical;"></textarea>
                </div>

                <button type="submit" class="btn-submit" 
                        style="width: 100%; background-color: #4f9cf9; color: white; padding: 12px 20px; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; font-size: 1rem; transition: background 0.3s;">
                    Envoyer le message
                </button>
            </form>
        </div>
    </div>
    
    <div class="map-container" style="margin-top: 3rem; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3980.666275813359!2d11.499596314757393!3d3.863116997188737!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x108bcf7a309a7977%3A0x7f54bad35e693c51!2sNational%20Advanced%20School%20of%20Engineering%20Yaounde!5e0!3m2!1sen!2scm!4v1689600000000!5m2!1sen!2scm" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
</div>
@endsection