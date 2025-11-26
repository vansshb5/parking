<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
</head>
<body>

<h2>Create Account</h2>

<form action="signup_process.php" method="POST">

    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <label>Role:</label><br>
    <select name="role" required>
        <option value="customer">Customer</option>
        <option value="owner">Owner</option>
    </select><br><br>

    <button type="submit">Signup</button>
</form>

<p>Already have an account? <a href="login.html">Login</a></p>

</body>
</html>
