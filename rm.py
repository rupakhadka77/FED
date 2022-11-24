import sys, json

from asyncio.windows_events import NULL
import pickle
import streamlit as st
import requests
import os



data = sys.argv[1]
# print("data")
data=data.replace('_',' ')

data = data.split(',')

# data='Atom'
# data = data.split(',')



# Send it to stdout (to PHP)







def recommend(Topic):
    index = Topics[Topics['Topic_Name'] == Topic].index[0]
    distances = sorted(list(enumerate(similarity[index])), reverse=True, key=lambda x: x[1])
    recommended_Topic_Names = []
    
    for i in distances[1:6]:
        # fetch the movie poster
        recommended_Topic_Names.append(Topics.iloc[i[0]].Id)

    return recommended_Topic_Names



Topics= pickle.load(open('Topics_list.pkl','rb'))
similarity = pickle.load(open('similarity.pkl','rb'))

Topics_list = Topics['Topic_Name'].values

if data:
    for i in data:
        recommended_Topic_Names= recommend(i)
        col1, col2, col3, col4, col5 = st.columns(5)
        with col1:
            print((recommended_Topic_Names[0]))
            print(',')
        with col2:
            print(recommended_Topic_Names[1])
            print(',')
        
        with col3:
            print(recommended_Topic_Names[2])
            print(',')
            





       
        





