<h2>Login</h2>
<form method="POST" action="processa_login.php">
    E-mail: <input type="email" name="email" value="<?php echo $_COOKIE['email_salvo'] ?? ''; ?>"><br>
    Senha: <input type="password" name="senha"><br>
    <label><input type="checkbox" name="lembrar_email"> Lembrar e-mail</label><br>
    <button type="submit">Entrar</button>
</form>
