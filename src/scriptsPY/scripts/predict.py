import sys

import pandas as pd
import matplotlib.pyplot as plt 
from statsmodels.tsa.arima_model import ARIMA

def parser(x):
	return pd.datetime.strptime(x, '%Y-%m')

currency = sys.argv[1]
path = sys.argv[2]

depth = int(sys.argv[3]) 
diff = int(sys.argv[4])

if depth > 10:
	depth = 10
if diff > 2:
	diff = 2

rate = pd.read_csv(path, usecols = ['Date',currency], parse_dates=[0], index_col = 0, squeeze=True, date_parser=parser)

X = rate.values

model = ARIMA(X,order=(depth,diff,0))
model_fit = model.fit(disp=0)
predicted = model_fit.forecast(steps=12)[0]

str_result = ""
for index,item in enumerate(predicted):
	if not (index + 4) % 12 == 0:
		str_result += str((index+4)%12)
	else:
		str_result += "12"
	str_result += ":" 
	str_result += str(item)
	if not index + 1 == len(predicted):
		str_result += ";"

print(str_result)
