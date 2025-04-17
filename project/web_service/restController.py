import datetime
from flask import request, jsonify
import mysql.connector
from _config import *
from mysql.connector import Error
from geopy.distance import geodesic
from app import app

# FUNZIONE PER CREARE LA CONNESSIONE AL DATABASE
def create_connection():
    # connessione
    connection = None
    try:
        # creo connessione
        connection = mysql.connector.connect(
            host=MYSQL_CONFIG['host'],
            user=MYSQL_CONFIG['user'],
            password=MYSQL_CONFIG['password'],
            database=MYSQL_CONFIG['database']
        )
        
        # controllo la connessione
        if connection.is_connected():
            print("Connesso a MySQL Database")
    except Error as e:
        # errore
        print(f"Errore: '{e}'")
    
    # return connessione
    return connection


# FUNZIONE PER ESEGUIRE UNA QUERY
def execute_query(query, params=None):
    # connessione al database
    conn = create_connection()
    
    # controllo connesssione
    if conn is None:
        return None
    
    # cursore
    cursor = conn.cursor(dictionary=True)  # dictionary=True per ottenere i risultati come dizionari
    try:
        # eseguo query
        cursor.execute(query, params)
        
        # controllo il tipo di query
        query_type = query.strip().split()[0].upper()
        if query_type == 'SELECT':
            # ritorno i risultati trovati
            results = cursor.fetchall()
            return results
        elif query_type == 'INSERT':
            # ritorno id nuovo elemento
            conn.commit()
            last_id = cursor.lastrowid
            return last_id
        elif query_type in ('UPDATE', 'DELETE'):
            # ritorno numero di righe modificate o eliminate
            conn.commit()
            row_count = cursor.rowcount
            return row_count
        else:
            # non ritorno nulla (query come la create table, BEGIN TRANSACTION, ...)
            conn.commit()
            return None
    except Error as e:
        # errore
        print(f"Errore durante l'esecuzione della query: '{e}'")
        return None
    finally:
        # chiudo connessione
        cursor.close()
        conn.close()


###########################à


# ENDPOINT PER INSERIRE UN OPERAZIONE
@app.route('/insertOperazione', methods=['GET'])
def insert_operazione():
    # prendo i parametri
    tipo = request.args.get('tipo')
    data_ora = request.args.get('data_ora')
    km_percorsi = request.args.get('km_percorsi')
    tariffa = request.args.get('tariffa')
    cliente_id = request.args.get('cliente_id')
    stazione_id = request.args.get('stazione_id')
    bicicletta_id = request.args.get('bicicletta_id')
    codiceTessera = request.args.get('codiceTessera')
    
    # dati non passati
    if not tipo or not data_ora or not km_percorsi or not tariffa or not cliente_id or not stazione_id or not bicicletta_id or not codiceTessera:
        return jsonify({'message': "ERRORE! Parametri non passati"})
    
    # operazione non valida
    '''
    if tipo != "noleggio" or tipo != "riconsegna":
        return jsonify({'message': "ERRORE! Tipo di operazione non valido"})
    '''
    
    # data non valida
    data_ora_parsed = datetime.datetime.strptime(data_ora, '%Y-%m-%d %H:%M:%S')
    if data_ora_parsed > datetime.datetime.now():
        return jsonify({'message': "ERRORE! Data e ora non valide"}), 400
    
    # converto i parametri per evitare SQL injection
    km_percorsi = float(km_percorsi) if km_percorsi else None
    tariffa = float(tariffa) if tariffa else None
    cliente_id = int(cliente_id)
    stazione_id = int(stazione_id)
    bicicletta_id = int(bicicletta_id)
    codiceTessera = int(codiceTessera)
    
    # km percorsi non validi
    if km_percorsi <= 0:
        return jsonify({'message': "ERRORE! Km percorsi non validi"}), 400
    
    # tariffa non valida
    if tariffa <= 0:
        return jsonify({'message': "ERRORE! Tariffa non valida"}), 400
    
    # id cliente non valido
    if cliente_id <= 0:
        return jsonify({'message': "ERRORE! Id cliente non valido"}), 400
    
    # id stazione non valido
    if stazione_id <= 0:
        return jsonify({'message': "ERRORE! Id stazione non valido"}), 400
    
    # id bicicletta non valido
    if bicicletta_id <= 0:
        return jsonify({'message': "ERRORE! Id bicicletta non valido"}), 400
    
    # codice tessera non valido
    if codiceTessera <= 0 or len(str(codiceTessera)) != 4:
        return jsonify({'message': "ERRORE! Codice tessera non valido"}), 400
        
    # controllo il codice della tessera
    query = "SELECT tesseraSmarrita FROM clienti WHERE codiceTessera = %s"
    params = (codiceTessera,)
    
    # eseguo query
    result = execute_query(query, params)
    if result is None:
        return jsonify({"message": "ERRORE! Bicicletta non trovata"}), 404

    tesseraSmarrita= result[0]['tesseraSmarrita']
    
    # tessera bloccata
    if tesseraSmarrita == 1:
        return jsonify({'message': "ERRORE! Questa tessera è bloccata"}), 400

    # query per inserire operazione
    query = " INSERT INTO operazioni \
        (tipo, data_ora, km_percorsi, tariffa, cliente_id, stazione_id, bicicletta_id) \
        VALUES (%s, %s, %s, %s, %s, %s, %s); "
    params = (tipo, data_ora, km_percorsi, tariffa, cliente_id, stazione_id, bicicletta_id,)
    
    # eseguo query
    id = execute_query(query, params)
    
    # errore
    if not id > 0:
        return jsonify({'message': "ERRORE! Operazione non eseguita"})
        
    # invio transazione
    return jsonify({'message': "Operazione eseguita con successo"})

# FUZNIONE PER CONTROLLARE LE COORDINATE
def is_valid_coordinate(lat, lon):
    return -90 <= lat <= 90 and -180 <= lon <= 180

# FUNZIONE PER CONTROLLARE L'ID DELLA BICICLETTA
def is_valid_codice(codice):
    return isinstance(codice, int) and codice > 0

# ENDPOINT PER CALCOLARE I KM PERCORSI NELLA TRATTA
@app.route('/aggiornaCoordinateBicicletta', methods=['GET'])
def aggiornaCoordinateBicicletta():
    # prendo i parametri
    codice = request.args.get('codice')
    new_lat = request.args.get('latitudine')
    new_lon = request.args.get('longitudine')

    # controllo presenza parametri
    if codice is None or new_lat is None or new_lon is None:
        return jsonify({"error": "ERRORE! Parametri mancanti"}), 400

    # controllo coordinate
    try:
        new_lat = float(new_lat)
        new_lon = float(new_lon)
    except ValueError:
        return jsonify({"error": "ERRORE! Coordinate non valide"}), 400

    if not is_valid_coordinate(new_lat, new_lon):
        return jsonify({"error": "ERRORE! Coordinate non valide"}), 400

    # controllo codice
    try:
        codice = int(codice)
    except ValueError:
        return jsonify({"error": "ERRORE! Codice bicicletta non valido"}), 400

    if not is_valid_codice(codice):
        return jsonify({"error": "ERRORE! Codice bicicletta non valido"}), 400

    # prendo vecchie coordinate
    query = "SELECT latitudine, longitudine FROM biciclette WHERE codice = %s"
    result = execute_query(query, (codice,))
    if result is None:
        return jsonify({"message": "ERRORE! Bicicletta non trovata"}), 404

    old_lat= result[0]['latitudine']
    old_lon = result[0]['longitudine']

    # calcolo distanza tra le coordainte
    distance = geodesic((old_lat, old_lon), (new_lat, new_lon)).kilometers

    # aggiorno coordinate e km percorsi nel database
    update_query = "UPDATE biciclette SET latitudine = %s, longitudine = %s, km_percorsi = km_percorsi + %s WHERE codice = %s"
    execute_query(update_query, (new_lat, new_lon, distance, codice))
    
    # controllo se devo mettere la bici in manutezione
    checkManutezioneBicicletta(codice)
    
    return jsonify({"message": "Coordinate e km percorsi aggiornati con successo"}), 200

# FUNZIONE PER METTERE LA BICI IN MANUTENZIONE, SE NECESSARIO
def checkManutezioneBicicletta(codice):
    # non controllo il codice perche' e' di sicuro corretto
    # i controlli vengono fatti dalla funzione chiamante
    
    # prendo i km percorsi dalla bicicletta
    query = "SELECT km_percorsi, numero_manutenzioni FROM biciclette WHERE codice = %s"
    result = execute_query(query, (codice,))
    
    km_percorsi = result[0]['km_percorsi']
    numero_manutenzioni = result[0]['numero_manutenzioni']
    
    # bici da mettere in manutenzione
    if km_percorsi > ((numero_manutenzioni+1) * 1000):
        update_query = "UPDATE biciclette SET in_manutenzione = 1, numero_manutenzioni = numero_manutenzioni + 1 WHERE codice = %s"
        execute_query(update_query, (codice,))

    
    return