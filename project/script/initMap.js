let map;
let markers = [];

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 45.465454, lng: 9.186516 },
        zoom: 9,
    });
    loadStations();
}

function loadStations() {
    $.ajax({
        url: 'ajax/getStations.php',
        type: 'GET',
        dataType: 'json',
        success: function(stazioni) {
            clearMarkers();
            stazioni.forEach(function(stazione) {
                let marker = new google.maps.Marker({
                    position: { lat: parseFloat(stazione.lat), lng: parseFloat(stazione.lng) },
                    map: map,
                    title: stazione.nome
                });
                markers.push(marker);
            });
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
            alert('Errore durante il caricamento delle stazioni.');
        }
    });
}

function clearMarkers() {
    for (let i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
    }
    markers = [];
}
