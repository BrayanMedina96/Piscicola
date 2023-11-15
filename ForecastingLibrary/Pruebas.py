# -*- coding: utf-8 -*-
"""
Created on Tue Jun 30 09:58:49 2020

@author: Andres Zambrano
"""

#Importa librerias basicas de python
import numpy as np
import matplotlib.pyplot as plt

#Importa funciones
from Forecasting import *
#---------------------------------------------------
# Lecura Matriz de Pruebas Actual
#---------------------------------------------------
# Carga de datos para ser usado en la predicción
mat = scipy.io.loadmat('Datos2.mat')
M=mat.get("M")
Z=[]
for i in range(len(M)):
    if M[i,-1]!=0:
        Z.append(M[i,:])
Z=np.array(Z)
Z=np.delete(Z,[1,2], axis=1)
X=np.delete(Z,-1,axis=0)
X=np.delete(X,range(1,9),axis=1)
#Separación en dos matrices para predecir a partir del dato 50
X1=X[:50,:]
#Predicción
X_pred=predTotal(X1,15)
#Concateno para graficar predicciones y realidad
X_pred=np.concatenate((X1,X_pred),axis=0)
#-------------------------------------------------
#Gráficas
#-------------------------------------------------
#Temperatura Ambiente
plt.plot(X_pred[np.size(X1,0)-11:np.size(X1,0)+14,1],'c')
plt.plot(X[np.size(X1,0)-11:np.size(X1,0)+14,1],'k--')
plt.legend(('Pred','Real'))
plt.vlines(10,20,35,'r')
plt.ylim([20,35])
plt.xlim([0,24])
plt.ylabel('Temperatura Ambiente (°C)')
plt.savefig('TempAmb.pdf')
#Temperatura Estanque
plt.figure()
plt.plot(X_pred[np.size(X1,0)-11:,2],'c')
plt.plot(X[np.size(X1,0)-11:np.size(X1,0)+14,2],'k--')
plt.legend(('Pred','Real'))
plt.vlines(10,20,35,'r')
plt.ylim([25,28])
plt.xlim([0,24])
plt.ylabel('Temperatura Estanque (°C)')
plt.savefig('TempEst.pdf')
#Oxígeno Disuelto
plt.figure()
plt.plot(X_pred[np.size(X1,0)-11:np.size(X1,0)+14,3],'c')
plt.plot(X[np.size(X1,0)-11:np.size(X1,0)+14,3],'k--')
plt.legend(('Pred','Real'))
plt.vlines(10,0,10,'r')
plt.ylim([0,3])
plt.xlim([0,24])
plt.ylabel('Oxígeno Disuelto (mg/L)')
plt.savefig('OD.pdf')
#pH
plt.figure()
plt.plot(X_pred[np.size(X1,0)-11:np.size(X1,0)+14,4],'c')
plt.plot(X[np.size(X1,0)-11:np.size(X1,0)+14,4],'k--')
plt.legend(('Pred','Real'))
plt.vlines(10,0,10,'r')
plt.ylim([6,8.5])
plt.xlim([0,24])
plt.ylabel('pH')
plt.savefig('PH.pdf')
#Conductividad Eléctrica
plt.figure()
plt.plot(X_pred[np.size(X1,0)-11:np.size(X1,0)+14,5],'c')
plt.plot(X[np.size(X1,0)-11:np.size(X1,0)+14,5],'k--')
plt.legend(('Pred','Real'))
plt.vlines(10,0,200,'r')
plt.ylim([130,180])
plt.xlim([0,24])
plt.ylabel('Conductividad Eléctrica (uS/cm)')
plt.savefig('CondElec.pdf')
#Amonio sin Ionizar NH3
plt.figure()
plt.plot(X_pred[np.size(X1,0)-11:np.size(X1,0)+14,6],'c')
plt.plot(X[np.size(X1,0)-11:np.size(X1,0)+14,6],'k--')
plt.legend(('Pred','Real'))
plt.vlines(10,0,200,'r')
plt.ylim([0,1])
plt.xlim([0,24])
plt.ylabel('Amonio NH3 (mg/L)')
plt.savefig('NH3.pdf')
#Amonio Ionizado NH4
plt.figure()
plt.plot(X_pred[np.size(X1,0)-11:np.size(X1,0)+14,7],'c')
plt.plot(X[np.size(X1,0)-11:np.size(X1,0)+14,7],'k--')
plt.legend(('Pred','Real'))
plt.vlines(10,0,200,'r')
plt.ylim([0,8])
plt.xlim([0,24])
plt.ylabel('Amonio NH4 (mg/L)')
plt.savefig('NH4.pdf')
#Nitritos
plt.figure()
plt.plot(X_pred[np.size(X1,0)-11:np.size(X1,0)+14,8],'c')
plt.plot(X[np.size(X1,0)-11:np.size(X1,0)+14,8],'k--')
plt.legend(('Pred','Real'))
plt.vlines(10,0,200,'r')
plt.ylim([0,10])
plt.xlim([0,24])
plt.ylabel('Nitritos (mg/L)')
plt.savefig('Nit.pdf')
#Alcalinidad
plt.figure()
plt.plot(X_pred[np.size(X1,0)-11:np.size(X1,0)+14,9],'c')
plt.plot(X[np.size(X1,0)-11:np.size(X1,0)+14,9],'k--')
plt.legend(('Pred','Real'))
plt.vlines(10,0,200,'r')
plt.ylim([65,85])
plt.xlim([0,24])
plt.ylabel('Alcalinidad (mg/L)')
plt.savefig('Alk.pdf')

