import sys, json

import streamlit as st
import pickle 
import matplotlib.pyplot as plt
from dataclasses import field

import pandas as pd





# Load the data that PHP sent us




# Generate some data to send to PHP


data = sys.argv[1]

# Send it to stdout (to PHP)


print(json.dumps(data))


    
