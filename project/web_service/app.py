from flask import Flask
from flask_cors import CORS
from _config import *

# web service con Flask per gestire le richieste di stazioni e biciclette
app = Flask(__name__)
CORS(app)

from restController import *

# AVVIO SERVER FLASK IN MODALIRA' DEBUG
if __name__ == '__main__':    
    app.run(debug=True)