import numpy as np
import scipy.io
import json
from Forecasting import *

mat = scipy.io.loadmat('C:/Users/PCBRAYAN/Desktop/CORHUILA/ForecastingLibrary/Datos2.mat')
M=mat.get("M")


t=[[1,2,3,4,5,6,7,8,9,10],
[1,2,3,4,5,6,7,8,9,10],
[1,2,3,4,5,6,7,8,9,10],
[1,2,3,4,5,6,7,8,9,10]]

print(t)

