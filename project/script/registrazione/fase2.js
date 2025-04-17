let nome = null;
let congome = null;

// DOCUMENTO CARICATO
$(document).ready(function()
{
    // controllo i dati della fase precedente
    getDatiFasePrecedente();

    // fase 1 non fatta
    if(nome == null || cognome == null)
        // reindirizzamento
        window.location.href = "fase1.php";
    else
        // inserisco i dati  nella pagina
        visualizzaDati();

});

// FUNZIONE PER PRENDERE I DATI DELLA FASE PRECEDENTE
function getDatiFasePrecedente()
{
    nome = localStorage.getItem('nome');
    cognome = localStorage.getItem('cognome');
}

// FUNZIONE PER INSERIRE I DATI DELLA FASE PRECEDENTE NELLA PAGINA
function visualizzaDati()
{
    $("#nome").text("nome: " + nome);
    $("#cognome").text("cognome: " + cognome);
}

let username = null;
let mail = null;
let password = null;

// PROCEDO CON LA REGISTRAZIONE
async function avanti()
{
    // prendo i parametri
    username = $("#username").val();
    mail = $("#mail").val();
    password = $("#password").val();
    confermaPassword = $("#confermaPassword").val();

    // eseguo i controlli
    let stato = await doControlli(confermaPassword);

    // reindirizzo
    reindizzamento(stato);
}

// RICHIESTA SERVIZIO
function richiesta(page, params)
{
    return new Promise(function(resolve)
    {
        $.get(page, params, function(phpData)
        {
            resolve(phpData);
        });
    });
}

// CONTROLLI SUI PARAMETRI IN INPUT
async function doControlli(confermaPassword)
{
    // parametri mancanti
    if(username == "" || mail == "" || password == "" || confermaPassword == "")
        return "ERRORE! Inserire tutti i campi!";

    // password non corrispondono
    if(password != confermaPassword)
        return "ERRORE! Le password non corrispondono!";

    // username già utilizzato
    let usernameUsed = await callDB_checkUsername({username: username});
    if(usernameUsed == true)
        return "ERRORE! Username già associato ad un altro account!";

    // mail già utilizzata
    let mailUsed = await callDB_checkMail({mail: mail});
    if(mailUsed == true)
        return "ERRORE! Mail già associata ad un altro account!";

    // tutto ok
    return true;
}

// CHIAMATA AL DB PER CONTROLLARE L'USERNAME
async function callDB_checkUsername(params)
{
    // chiamata al db
    let result = await richiesta("../../services/checkUsername.php", params);

    if(result == 1)
        return true;

    return false;
}

// CHIAMATA AL DB PER CONTROLLARE LA MAIL
async function callDB_checkMail(params)
{
    // chiamata al db
    let result = await richiesta("../../services/checkMail.php", params);

    if(result == 1)
        return true;

    return false;
}

// REINDIRIZZAMENTO
function reindizzamento(stato)
{
    // controlli ok
    if(stato == true)
    {
        // salvo dati
        salvaDati();

        // reindirizzo
        window.location.href = "fase3.php";
    }
    else
        alert(stato);
}

// FUNZIONE PER SALVARE I DATI DELLA FASE
function salvaDati()
{
    localStorage.setItem('username', username);
    localStorage.setItem('mail', mail);
    localStorage.setItem('password', password);
}