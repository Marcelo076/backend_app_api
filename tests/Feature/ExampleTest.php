<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\EmailController;

class EmailTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa se o aplicativo retorna um status 200 para a rota /enviar-email.
     *
     * @return void
     */
    public function test_application_returns_successful_response_for_enviar_email_route()
    {
        $response = $this->post('api/email/check', ['email' => 'test@example.com']);

        $response->assertStatus(200);
    }

    /**
     * Testa se o aplicativo retorna uma mensagem 'E-mail já cadastrado' se o e-mail já estiver cadastrado.
     *
     * @return void
     */
    public function test_application_returns_message_if_email_already_registered()
    {
    
        DB::table('emails')->insert(['email' => 'existing@example.com']);

      
        $response = $this->post('api/email/check', ['email' => 'existing@example.com']);

      
        $response->assertExactJson(['mensagem' => 'registered_email']);
    }

    /**
     * Testa se o aplicativo retorna um status 200 se o e-mail for adicionado com sucesso.
     *
     * @return void
     */
    public function test_application_returns_200_if_email_added_successfully()
    {
        // Tenta adicionar um e-mail que não está no banco de dados
        $response = $this->post('api/email/check', ['email' => 'new@example.com']);

        $response->assertStatus(200);
    }
    /**
     * Testa se a função de validação de e-mail retorna verdadeiro para e-mails válidos.
     *
     * @return void
     */
    public function test_email_validation_returns_true_for_valid_emails()
    {
        $emailController = new EmailController();

        $validEmails = [
            'test@example.com',
            'user123@gmail.com',
            'john.doe@example.co.uk'
        ];

        foreach ($validEmails as $email) {
            $this->assertTrue($emailController->validEmail($email));
        }
    }

    /**
     * Testa se a função de validação de e-mail retorna falso para e-mails inválidos.
     *
     * @return void
     */
    public function test_email_validation_returns_false_for_invalid_emails()
    {
        $emailController = new EmailController();

        $invalidEmails = [
            'invalid_email',
            'user@example',
            'john.doe@example.',
            'test@@example.com'
        ];

        foreach ($invalidEmails as $email) {
            $this->assertFalse($emailController->validEmail($email));
        }
    }
}
