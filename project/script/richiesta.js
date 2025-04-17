// RICHIESTA SERVIZIO CON RITORNO IN JSON
function richiestaJSON(page, params)
{
    return new Promise(function(resolve)
    {
        $.get(page, params, function(phpData)
        {
            resolve(phpData);
        }, "json");
    });
}

// RICHIESTA SERVIZIO CON RITORNO IN JSON
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