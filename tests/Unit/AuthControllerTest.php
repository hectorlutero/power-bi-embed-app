<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Requests\Api\AuthRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Mail\UserRegistered;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AuthControllerTest extends TestCase
{
    public function testLogin()
    {
        $controller = new AuthController();
        $user = User::factory()->create([
            'password' => Hash::make('password')
        ]);
        $request = new AuthRequest([
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response = $controller->login($request);
        $userResponse = $response->getData('array');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotNull(response()->json($response));
        $this->assertEquals($user->id, $userResponse['user']['id']);
    }

    public function testLogout()
    {
        $controller = new AuthController();
        $user = User::factory()->create();
        $request = Request::create('/logout', 'GET');
        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        $response = $controller->logout($request);
        $data = (array) $response->getData();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Logged out successfully', $data['message']);
    }

    public function testProfile()
    {
        $controller = new AuthController();
        $user = User::factory()->create();
        $request = Request::create('/profile', 'GET');
        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        $response = $controller->profile($request);
        $data = $response->getOriginalContent();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($user->id, $data['user']['id']);
    }

    public function testRegister()
    {
        Mail::fake();
        $controller = new AuthController();
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password'
        ];
        $request = new RegisterRequest($userData);

        $response = $controller->register($request);
        $data = $response->getOriginalContent();
        $user = User::where('email', 'test@example.com')->first();

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertNotNull($data['token']);
        $this->assertEquals($userData['name'], $data['user']['name']);
        $this->assertEquals($userData['email'], $data['user']['email']);

        Mail::assertSent(UserRegistered::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }
}
