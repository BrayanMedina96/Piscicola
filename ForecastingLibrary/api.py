from flask import Flask, request, jsonify
from flask_restful import Resource, Api
from sqlalchemy import create_engine
from flask_cors import CORS

import numpy as np
import matplotlib.pyplot as plt
from Forecasting import *
import json
import logging
#import Pruebas.py

app = Flask(__name__)
api = Api(app)
cors = CORS(app, resources={r"/api/*": {"origins": "*"}})

class Prediccion(Resource):
      def get(self):
          mat = scipy.io.loadmat('Datos2.mat')
          logging.warning(mat);
          M=mat.get("M")
          Z=[]

          for i in range(len(M)):
                if M[i,-1]!=0:
                   Z.append(M[i,:])
          
          Z=np.array(Z)
          Z=np.delete(Z,[1,2], axis=1)
          X=np.delete(Z,-1,axis=0)
          X=np.delete(X,range(1,9),axis=1)
          X1=X[:50,:]
          X_pred=predTotal(X1,15)
          data=[]
          
          for i in X_pred:
              data.append(  {"data":[ i[0],i[1],i[2],i[3],i[4],i[5],i[6],i[7],i[8],i[9] ]}  )
                 
          return {'data':data}


api.add_resource(Prediccion, '/prediccion')  # Route_1


if __name__ == '__main__':
     app.run(port='5000')