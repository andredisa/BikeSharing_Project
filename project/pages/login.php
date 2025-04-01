<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-body">
                        <h2 class="card-title text-center">Login</h2>
                        <form id="loginForm">
                            <div class="form-group">
                                <label for="email">E-Mail</label>
                                <input type="text" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" class="form-control">
                            </div>
                            <button id="invia" type="submit" class="btn btn-primary btn-block">Login</button>
                            <button id="home" type="button" class="btn btn-secondary btn-block">Homepage</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $("#loginForm").submit(function(event) {
            event.preventDefault();
            var email = $("#email").val();
            var password = $("#password").val();

            $.ajax({
                type: "POST",
                url: "../ajax/login_process.php",
                data: { email: email, password: password },
                dataType: "json",
                success: function(response) {
                    if (response.status === false) {
                        alert("Credenziali errate");
                    } else if (response.status === "admin") {
                        window.location.href = "adminPage.php";
                    } else if (response.status === "cliente") {
                        window.location.href = "clientPage.php";
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Errore durante la richiesta: ", error);
                    alert("Errore durante la richiesta. Si prega di riprovare.");
                }
            });
        });
        $("#home").click(function() {
                window.location = "../index.html";
        });
    });
</script>

</body>
</html>
