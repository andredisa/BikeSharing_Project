// LOGIN
function doLogin()
{
    // prendo i parametri
    let mail_username = $("#mail_username").val();
    let password = $("#password").val();

    // parametri mancanti
    if(mail_username == "" || password == "")
    {
        alert("ERRORE! Inserire mail e password!");
        return;
    }

    // richiestra di login al db
    callDB_login({mail_username: mail_username, password: password});
}

// CHIAMATA AL DB PER LA LOGIN
function callDB_login(params)
{
    // chiamata al db
    $.get("../services/login.php",params,function(isLogged)
    {
        // reindirizzamento
        reindizzamento(isLogged);
    });
}

// REINDIRIZZAMENTO
function reindizzamento(isLogged)
{
    // login corretta
    if(isLogged)
        window.location.href = "mappa.php";
    else
        alert("ERRORE! Credenziali di accesso errate!");
}