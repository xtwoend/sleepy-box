#!/usr/bin/env python

import cv2
import requests
import numpy as np
from pyzbar.pyzbar import decode

# live capture QR Code
cap = cv2.VideoCapture(0)
cap.set(3, 640)
cap.set(4, 480)

while True:
	success, img = cap.read()
	if not success:
		break
	for barcode in decode(img):
		qrCode = barcode.data.decode("utf-8")
		device = 'deviceIDforRegister'
		print(qrCode)
		r = requests.post('https://httpbin.org/post', data={'code': qrCode, 'device': device})
		print(r.text)
