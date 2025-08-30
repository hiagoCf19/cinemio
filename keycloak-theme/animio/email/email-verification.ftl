<#-- email-verification.ftl -->

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Verifique seu e-mail</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 600px;
      margin: 40px auto;
      background-color: #ffffff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    h1 {
      color: #333333;
    }
    p {
      color: #555555;
      line-height: 1.5;
    }
    .btn {
      display: inline-block;
      margin: 20px 0;
      padding: 12px 24px;
      background-color: #4CAF50;
      color: #ffffff !important;
      text-decoration: none;
      font-weight: bold;
      border-radius: 5px;
    }
    .footer {
      margin-top: 30px;
      font-size: 12px;
      color: #888888;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <img src="https://upload.wikimedia.org/wikipedia/commons/1/11/Test-Logo.svg" alt="Animio" style="max-width: 150px; display: block; margin: 0 auto 20px;">
    
    <h1>Olá ${user.firstName}!</h1>
    
    <p>Você recebeu este e-mail porque solicitou a verificação do seu endereço de e-mail no realm <strong>${realmName}</strong>.</p>
    
    <p>Clique no botão abaixo para confirmar seu e-mail e ativar sua conta:</p>
    
    <a href="${link}" class="btn">Verificar e-mail</a>
    
    <p>Este link expira em 12 horas. Se você não solicitou essa ação, apenas ignore este e-mail.</p>
    
    <p>Para gerenciar sua conta, acesse: <a href="${adminUrl}">${adminUrl}</a></p>
    
    <div class="footer">
      &copy; ${now?string("yyyy")} Animio. Todos os direitos reservados.
    </div>
  </div>
</body>
</html>
