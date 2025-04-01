<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#registerForm").submit(function(event) {
            event.preventDefault();
            var formData = {
                email: $("#email").val(),
                password: $("#password").val(),
                nome: $("#nome").val(),
                cognome: $("#cognome").val(),
                numero_tessera: $("#numero_tessera").val(),
                numero_carta_credito: $("#numero_carta_credito").val(),
                via: $("#via").val(),
                città: $("#città").val(),
                provincia: $("#provincia").val(),
                regione: $("#regione").val(),
                CAP: $("#CAP").val()
            };

            $.post("../ajax/registrazione_process.php", formData, function(response) {
                if (response.status === true) {
                    alert("Registrazione avvenuta con successo!");
                    window.location = "clientPage.php";
                } else {
                    alert("Errore durante la registrazione: " + response.message);
                }
            }, "json").fail(function() {
                alert("Errore di comunicazione con il server.");
            });
        });

        $("#home").click(function() {
            window.location.href = "../index.html";
        });
    });
</script>

</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-body">
                        <h2 class="card-title text-center">Registrazione</h2>
                        <form id="registerForm">
                            <div class="form-group">
                                <label for="email">E-Mail</label>
                                <input type="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" id="nome" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="cognome">Cognome</label>
                                <input type="text" id="cognome" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="numero_tessera">Numero Tessera</label>
                                <input type="number" id="numero_tessera" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="numero_carta_credito">Numero Carta di Credito</label>
                                <input type="number" id="numero_carta_credito" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="via">Via</label>
                                <input type="text" id="via" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="città">Città</label>
                                <input type="text" id="città" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="provincia">Provincia</label>
                                <input type="text" id="provincia" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="regione">Regione</label>
                                <input type="text" id="regione" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="CAP">CAP</label>
                                <input type="number" id="CAP" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Registrati</button>
                            <button id="home" type="button" class="btn btn-secondary btn-block">Homepage</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
