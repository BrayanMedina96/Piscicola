# -*- coding: utf-8 -*-
"""
Created on Tue Jun 30 11:45:55 2020

@author: Andres Zambrano
"""

import scipy.io
import numpy as np
from sklearn.model_selection import train_test_split
from sklearn.ensemble import RandomForestRegressor
from sklearn.preprocessing import StandardScaler
import xlsxwriter
from sklearn.linear_model import ElasticNet
import pickle

#Considerar anterior
ant=2
#Variable a  predecir, de 10 a 17
var=17
# Carga de datos
mat = scipy.io.loadmat('Datos2.mat')
M=mat.get("M")
Z=[]
for i in range(len(M)):
    if M[i,-1]!=0:
        Z.append(M[i,:])
Z=np.array(Z)
Z=np.delete(Z,[1,2], axis=1)
y=Z[:,var]
RMSE=[]
MAE=[]
NRMSE=[]
sc=[]
FI=[]
X=np.delete(Z,-1,axis=0)
y=np.delete(y,0)
X=np.delete(X,range(1,9),axis=1)
for i in range(ant):
    X2=np.delete(X[:,-9:],0,axis=0)
    X=np.delete(X,-1,axis=0)
    X=np.concatenate((X,X2),axis=1)
    y=np.delete(y,0)
if ant%2==0:
    for i in range(np.size(X,0)):
        if i%2==0:
            X[i,0]=17
        else:
            X[i,0]=8
    
for i in range(1000):
    X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.3)
    scaler = StandardScaler()
    regressor=RandomForestRegressor(n_estimators=1000,criterion='mse',random_state=0)
    #regressor=ElasticNet(alpha=0.3)
    regressor.fit(scaler.fit_transform(X_train),y_train)
    y_pred=regressor.predict(scaler.transform(X_test))
    MAE.append(sum(abs(y_test-y_pred))/len(y_pred))
    RMSE.append((sum((y_test-y_pred)**2)/len(y_pred))**0.5)
    NRMSE.append((sum((y_test-y_pred)**2)/len(y_pred))**0.5/(max(y_test)-min(y_test)))
    sc.append(regressor.score(scaler.transform(X_test),y_test))
    FI.append(regressor.feature_importances_)
    #FI.append(regressor.coef_)

FI=np.mean(FI,axis=0)
FIM=[FI[0]]
for i in range(1,10):
    prom=[]
    for j in range(ant+1):
        prom.append(FI[9*j+i])
    FIM.append(np.sum(abs(np.array(prom))))

FIM=np.array(FIM)/sum(FIM)

print(np.mean(MAE))
print(np.mean(RMSE))
print(np.mean(sc))
print(np.mean(NRMSE))
print(FIM)
workbook = xlsxwriter.Workbook('Data.xlsx')
worksheet = workbook.add_worksheet()
for i in range(0,len(FIM)):
    worksheet.write('A1',"FI")
    worksheet.write('A'+str(i+2),FIM[i])
workbook.close()

#Save Models
regressor.fit(scaler.fit_transform(X),y)
if var==10:
    pickle.dump(regressor, open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/modelTempEst.sav', 'wb'))
elif var==11:
    pickle.dump(regressor, open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/modelOD.sav', 'wb'))
elif var==12:
    pickle.dump(regressor, open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/modelPH.sav', 'wb'))
elif var==13:
    pickle.dump(regressor, open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/modelCondElec.sav', 'wb'))
elif var==14:
    pickle.dump(regressor, open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/modelNH3.sav', 'wb'))
elif var==15:
    pickle.dump(regressor, open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/modelNH4.sav', 'wb'))
elif var==16:
    pickle.dump(regressor, open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/modelNit.sav', 'wb'))
elif var==17:
    pickle.dump(regressor, open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/modelAlk.sav', 'wb'))
elif var==9:
    pickle.dump(regressor, open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/modelTempAmb.sav', 'wb'))
    
if ant==0:
    pickle.dump(scaler, open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/scaler1.sav', 'wb'))
elif ant==1:
    pickle.dump(scaler, open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/scaler2.sav', 'wb'))
elif ant==2:
    pickle.dump(scaler, open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/scaler3.sav', 'wb'))
elif ant==3:
    pickle.dump(scaler, open('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/scaler4.sav', 'wb'))