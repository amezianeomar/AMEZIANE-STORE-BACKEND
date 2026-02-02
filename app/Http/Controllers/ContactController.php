<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TransmissionMail;

class ContactController extends Controller
{
    public function showContact()
    {
        return view('ContactMail'); // Affiche le formulaire
    }

    public function sendTransmission(Request $request)
    {
        // 1. Validation des données
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        // 2. Préparation du package
        $data = [
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
        ];

        // 3. Envoi vers l'Admin (Toi)
        // Remplace par ton email d'admin réel
        Mail::to('imorafid@gmail.com')->send(new TransmissionMail($data));

        // 4. Retour avec succès
        return back()->with('success', 'TRANSMISSION UPLOADED SUCCESSFULLY.');
    }
}