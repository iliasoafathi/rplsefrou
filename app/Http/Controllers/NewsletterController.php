<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'name' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Veuillez fournir une adresse email valide.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $newsletter = Newsletter::firstOrCreate(
                ['email' => $request->email],
                [
                    'name' => $request->name,
                    'is_active' => true,
                    'subscribed_at' => now(),
                ]
            );

            if ($newsletter->wasRecentlyCreated) {
                return response()->json([
                    'success' => true,
                    'message' => 'Merci ! Vous êtes maintenant abonné à notre newsletter.'
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => 'Vous êtes déjà abonné à notre newsletter.'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue. Veuillez réessayer.'
            ], 500);
        }
    }

    public function unsubscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Veuillez fournir une adresse email valide.',
            ], 422);
        }

        $newsletter = Newsletter::where('email', $request->email)->first();

        if ($newsletter) {
            $newsletter->update([
                'is_active' => false,
                'unsubscribed_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Vous avez été désabonné de notre newsletter.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cette adresse email n\'est pas abonnée à notre newsletter.'
            ], 404);
        }
    }
}
