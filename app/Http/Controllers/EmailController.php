<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    /**
     * Valida um endereço de e-mail.
     *
     * @param string $email
     * @return bool
     */
    public function validEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Envia um e-mail para a API.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendEmail(Request $request)
    {



      
        $email = $request->input('email');

       
        if (!$this->validEmail($email)) {
            return response()->json(['mensagem' => 'invalid_email'], 200);
        }

        
        $existingEmail = DB::table('emails')->where('email', $email)->exists();

        if ($existingEmail) {
            return response()->json(['mensagem' => 'registered_email'], 200);
        } else {
            DB::table('emails')->insert(['email' => $email]);
            return response()->json(['mensagem' => 'email_added'], 200);
        }
    }
}
