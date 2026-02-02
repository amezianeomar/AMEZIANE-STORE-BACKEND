@extends('layouts.app') @section('content')
<style>
    /* Force le style Cyberpunk spécifique à cette page */
    .cyber-card {
        background: rgba(20, 20, 35, 0.85);
        backdrop-filter: blur(10px);
        border: 1px solid #333;
        box-shadow: 0 0 20px rgba(0, 243, 255, 0.1);
    }
    .cyber-input {
        background-color: #050510;
        border: 1px solid #333;
        color: #00f3ff;
        font-family: 'Rajdhani', sans-serif;
    }
    .cyber-input:focus {
        border-color: #00f3ff;
        box-shadow: 0 0 10px #00f3ff;
        outline: none;
    }
    .cyber-btn {
        background: linear-gradient(45deg, #bc13fe, #7a00cc);
        border: none;
        color: white;
        font-family: 'Orbitron', sans-serif;
        text-transform: uppercase;
        letter-spacing: 2px;
    }
    .cyber-btn:hover {
        box-shadow: 0 0 15px #bc13fe;
    }
</style>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card cyber-card p-4" style="width: 100%; max-width: 500px;">
        <h2 class="text-center mb-4" style="font-family: 'Orbitron'; color: #00f3ff;">
            SECURE UPLINK
        </h2>

        @if(session('success'))
            <div class="alert alert-success" style="background: transparent; border: 1px solid #00f3ff; color: #00f3ff;">
                ✅ {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('transmission.send') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label style="color: #bc13fe; font-family: 'Orbitron'; font-size: 0.8rem;">SOURCE (EMAIL)</label>
                <input type="email" name="email" class="form-control cyber-input" required>
            </div>

            <div class="mb-3">
                <label style="color: #bc13fe; font-family: 'Orbitron'; font-size: 0.8rem;">OBJECTIVE (SUBJECT)</label>
                <input type="text" name="subject" class="form-control cyber-input" required>
            </div>

            <div class="mb-4">
                <label style="color: #bc13fe; font-family: 'Orbitron'; font-size: 0.8rem;">DATA PAYLOAD (MESSAGE)</label>
                <textarea name="message" rows="5" class="form-control cyber-input" required></textarea>
            </div>

            <button type="submit" class="btn cyber-btn w-100 py-2">
                INITIATE UPLOAD
            </button>
        </form>
    </div>
</div>
@endsection