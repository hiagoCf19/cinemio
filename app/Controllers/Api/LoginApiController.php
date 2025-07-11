<?php

namespace App\Controllers\Api;

class LoginWebController extends BaseController
{

  public function login()
  {
    echo "teste";
      $data = $this->request->getJSON(true);
      $email = $data['email'] ?? '';
      $password = $data['password'] ?? '';
  
      $user = (new AuthService())->authenticate($email, $password);
  
      if ($user) {
          $token = JWTService::generateToken($user);
          return $this->respond(['token' => $token, 'user' => $user]);
      }
  
      return $this->failUnauthorized('Invalid credentials');
  }
  
    
}
