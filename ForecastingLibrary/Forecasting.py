# -*- coding: utf-8 -*-
"""
Created on Tue Jun 30 09:57:39 2020

@author: Andres Zambrano
"""

#Importa librerias basicas de python
import scipy.io
import numpy as np
from sklearn.model_selection import train_test_split
from sklearn.ensemble import RandomForestRegressor
from sklearn.preprocessing import StandardScaler
import pickle

#Función que predice temperatura del estanque
def predTempEst(X):
    #Ventana de tiempo además de la última necesarias
    ant=0
    #Selecciona datos necesarios para predecir
    X_pred=X[-1-ant:,:].ravel()
    if ant>0:
        X_pred=np.delete(X_pred,range(10,1+10*(ant),10))
    if ant%2==0 and X_pred[0]==8:
        X_pred[0]=17
    elif ant%2==0 and X_pred[0]==17:
        X_pred[0]=8
    X_pred=X_pred.reshape(-1,1).transpose()
    #Carga modelo de regresión y de estandarización
    regressor = pickle.load(open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/modelTempEst.sav', 'rb'))
    scaler = pickle.load(open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/scaler1.sav','rb'))
    #Predice la medición para la ventana especificada en parámetro v
    y_pred=regressor.predict(scaler.transform(X_pred))
    #Entrega resultado
    return y_pred[0]

#Función que predice Oxigeno Disuelto
def predOD(X):
    #Ventana de tiempo además de la última necesarias
    ant=3
    #Selecciona datos necesarios para predecir
    X_pred=X[-1-ant:,:].ravel()
    if ant>0:
        X_pred=np.delete(X_pred,range(10,1+10*(ant),10))
    if ant%2==0 and X_pred[0]==8:
        X_pred[0]=17
    elif ant%2==0 and X_pred[0]==17:
        X_pred[0]=8
    X_pred=X_pred.reshape(-1,1).transpose()
    #Carga modelo de regresión y de estandarización
    regressor = pickle.load(open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/modelOD.sav', 'rb'))
    scaler = pickle.load(open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/scaler4.sav','rb'))
    #Predice la medición para la ventana especificada en parámetro v
    y_pred=regressor.predict(scaler.transform(X_pred))
    #Entrega resultado
    return y_pred[0]

#Función que predice pH
def predPH(X):
    #Ventana de tiempo además de la última necesarias
    ant=1
    #Selecciona datos necesarios para predecir
    X_pred=X[-1-ant:,:].ravel()
    if ant>0:
        X_pred=np.delete(X_pred,range(10,1+10*(ant),10))
    if ant%2==0 and X_pred[0]==8:
        X_pred[0]=17
    elif ant%2==0 and X_pred[0]==17:
        X_pred[0]=8
    X_pred=X_pred.reshape(-1,1).transpose()
    #Carga modelo de regresión y de estandarización
    regressor = pickle.load(open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/modelPH.sav', 'rb'))
    scaler = pickle.load(open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/scaler2.sav','rb'))
    #Predice la medición para la ventana especificada en parámetro v
    y_pred=regressor.predict(scaler.transform(X_pred))
    #Entrega resultado
    return y_pred[0]

#Función que predice Conductividad Eléctrica
def predCondElec(X):
    #Ventana de tiempo además de la última necesarias
    ant=0
    #Selecciona datos necesarios para predecir
    X_pred=X[-1-ant:,:].ravel()
    if ant>0:
        X_pred=np.delete(X_pred,range(10,1+10*(ant),10))
    if ant%2==0 and X_pred[0]==8:
        X_pred[0]=17
    elif ant%2==0 and X_pred[0]==17:
        X_pred[0]=8
    X_pred=X_pred.reshape(-1,1).transpose()
    #Carga modelo de regresión y de estandarización
    regressor = pickle.load(open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/modelCondElec.sav', 'rb'))
    scaler = pickle.load(open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/scaler1.sav','rb'))
    #Predice la medición para la ventana especificada en parámetro v
    y_pred=regressor.predict(scaler.transform(X_pred))
    #Entrega resultado
    return y_pred[0]

#Función que predice Amonio sin ionizar NH3
def predNH3(X):
    #Ventana de tiempo además de la última necesarias
    ant=3
    #Selecciona datos necesarios para predecir
    X_pred=X[-1-ant:,:].ravel()
    if ant>0:
        X_pred=np.delete(X_pred,range(10,1+10*(ant),10))
    if ant%2==0 and X_pred[0]==8:
        X_pred[0]=17
    elif ant%2==0 and X_pred[0]==17:
        X_pred[0]=8
    X_pred=X_pred.reshape(-1,1).transpose()
    #Carga modelo de regresión y de estandarización
    regressor = pickle.load(open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/modelNH3.sav', 'rb'))
    scaler = pickle.load(open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/scaler4.sav','rb'))
    #Predice la medición para la ventana especificada en parámetro v
    y_pred=regressor.predict(scaler.transform(X_pred))
    #Entrega resultado
    return y_pred[0]

#Función que predice Amonio ionizado NH4
def predNH4(X):
    #Ventana de tiempo además de la última necesarias
    ant=3
    #Selecciona datos necesarios para predecir
    X_pred=X[-1-ant:,:].ravel()
    if ant>0:
        X_pred=np.delete(X_pred,range(10,1+10*(ant),10))
    if ant%2==0 and X_pred[0]==8:
        X_pred[0]=17
    elif ant%2==0 and X_pred[0]==17:
        X_pred[0]=8
    X_pred=X_pred.reshape(-1,1).transpose()
    #Carga modelo de regresión y de estandarización
    regressor = pickle.load(open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/modelNH4.sav', 'rb'))
    scaler = pickle.load(open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/scaler4.sav','rb'))
    #Predice la medición para la ventana especificada en parámetro v
    y_pred=regressor.predict(scaler.transform(X_pred))
    #Entrega resultado
    return y_pred[0]

#Función que predice Nitritos
def predNit(X):
    #Ventana de tiempo además de la última necesarias
    ant=1
    #Selecciona datos necesarios para predecir
    X_pred=X[-1-ant:,:].ravel()
    if ant>0:
        X_pred=np.delete(X_pred,range(10,1+10*(ant),10))
    if ant%2==0 and X_pred[0]==8:
        X_pred[0]=17
    elif ant%2==0 and X_pred[0]==17:
        X_pred[0]=8
    X_pred=X_pred.reshape(-1,1).transpose()
    #Carga modelo de regresión y de estandarización
    regressor = pickle.load(open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/modelNit.sav', 'rb'))
    scaler = pickle.load(open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/scaler2.sav','rb'))
    #Predice la medición para la ventana especificada en parámetro v
    y_pred=regressor.predict(scaler.transform(X_pred))
    #Entrega resultado
    return y_pred[0]

#Función que predice alcalinidad
def predAlk(X):
    #Ventana de tiempo además de la última necesarias
    ant=2
    #Selecciona datos necesarios para predecir
    X_pred=X[-1-ant:,:].ravel()
    if ant>0:
        X_pred=np.delete(X_pred,range(10,1+10*(ant),10))
    if ant%2==0 and X_pred[0]==8:
        X_pred[0]=17
    elif ant%2==0 and X_pred[0]==17:
        X_pred[0]=8
    X_pred=X_pred.reshape(-1,1).transpose()
    #Carga modelo de regresión y de estandarización
    regressor = pickle.load(open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/modelAlk.sav', 'rb'))
    scaler = pickle.load(open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/scaler3.sav','rb'))
    #Predice la medición para la ventana especificada en parámetro v
    y_pred=regressor.predict(scaler.transform(X_pred))
    #Entrega resultado
    return y_pred[0]

#Función que predice temperatura del ambiente (Necesaria para ampliar ventana)
def predTempAmb(X):
    #Ventana de tiempo además de la última necesarias
    ant=3
    #Selecciona datos necesarios para predecir
    X_pred=X[-1-ant:,:].ravel()
    if ant>0:
        X_pred=np.delete(X_pred,range(10,1+10*(ant),10))
    if ant%2==0 and X_pred[0]==8:
        X_pred[0]=17
    elif ant%2==0 and X_pred[0]==17:
        X_pred[0]=8
    X_pred=X_pred.reshape(-1,1).transpose()
    #Carga modelo de regresión y de estandarización
    regressor = pickle.load(open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/modelTempAmb.sav', 'rb'))
    scaler = pickle.load(open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/scaler4.sav','rb'))
    #Predice la medición para la ventana especificada en parámetro v
    y_pred=regressor.predict(scaler.transform(X_pred))
    #Entrega resultado
    return y_pred[0]

#Función que permite predecir todo al tiempo con ventana hacia el futuro como parámetro
def predTotal(X,v):
    #Calcula primera predicción
    y_pred=np.array([X[-1,0],predTempAmb(X),predTempEst(X),predOD(X),predPH(X),predCondElec(X),predNH3(X),predNH4(X),predNit(X),predAlk(X)]).reshape(-1,1).transpose()
    #Actualiza hora en la que se predijo
    if y_pred[-1,0]==8:
        y_pred[-1,0]=17
    elif y_pred[-1,0]==17:
        y_pred[-1,0]=8
    #Inicializa Salida
    y_out=[y_pred]
    #Predicción para toda la ventana
    for i in range(v-1):
        X=np.concatenate((X,y_pred),axis=0)
        y_pred=np.array([X[-1,0],predTempAmb(X),predTempEst(X),predOD(X),predPH(X),predCondElec(X),predNH3(X),predNH4(X),predNit(X),predAlk(X)]).reshape(-1,1).transpose()
        #Actualiza hora en la que se predijo
        if y_pred[-1,0]==8:
            y_pred[-1,0]=17
        elif y_pred[-1,0]==17:
            y_pred[-1,0]=8
        y_out.append(y_pred)
    return np.squeeze(y_out)

