import numpy as np
import scipy.io
import json
from Forecasting import *
import pandas as pd


df = pd.read_excel("C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/data.xlsx", sheet_name='Hoja1',  header=None)

X1=np.array([df.iloc[0].values,
df.iloc[1].values,
df.iloc[2].values,
df.iloc[3].values])

X_pred=predTotal(X1,15)
data=[]

for i in X_pred:
    data.append(  {"data":[ i[0],i[1],i[2],i[3],i[4],i[5],i[6],i[7],i[8],i[9] ]}  )
                 
print(json.dumps( {"data":data} ))