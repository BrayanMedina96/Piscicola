import numpy as np
import scipy.io
import json
from Forecasting import *
import pandas as pd
import psycopg2

conexion = psycopg2.connect(host="localhost", database="postgres", user="aqua", password="aqua123*2021")
cur = conexion.cursor()
cur.execute( "SELECT horaregistro, temperaturaambiente, temperaturaestanque, oxigenodisuelto,ph, conductividadelectrica, amonionh3, amonionh4, nitrito, alcalinidad FROM temporal_data ")
rows =cur.fetchall()
result=[]

for row in rows:
        result.append(np.asarray(row))
        
X1=np.array(result)

X_pred=predTotal(X1,15)
data=[]

for i in X_pred:
    data.append(  {"data":[ i[0],i[1],i[2],i[3],i[4],i[5],i[6],i[7],i[8],i[9] ]}  )
                 
print(json.dumps( {"data":data} ))