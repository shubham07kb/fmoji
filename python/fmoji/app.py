from flask import Flask, send_file #pip install flask
from flask import request
import requests #pip install requests
import json
import cv2 #pip install opencv-python, pip install opencv-contrib-python
import numpy as np #pip install numpy
import os
import sys
from deepface import DeepFace #pip install deepface
from fer import FER #pip install fer
app=Flask(__name__)
@app.route('/')
def hello_world():
    script_dir = sys.path[0]
    img_path = os.path.join(script_dir, '../y/img1.png')
    return script_dir+"hello"
@app.route('/downloadimg')
def download():
    imgname = request.args['imgname']
    return send_file('store/'+imgname, as_attachment=True)
@app.route('/del')
def hello_del():
    imgname = request.args['imgname']
    os.remove('come/'+imgname)
    os.remove('store/'+imgname)
    return "del"
@app.route('/fmojihc')
def hello_fmojihc():
    url = request.args['url']
    imgname = request.args['imgname']
    upname = request.args['upname']
    arrofdata="Done/"
    r = requests.get(url)
    if r.status_code == 200:
        with open("come/"+imgname, 'wb') as f:
            f.write(r.content)
    recognizer = cv2.face.LBPHFaceRecognizer_create()
    recognizer.read('facial_expressions/trainer/trainer.yml')
    cascadePath = "facial_expressions/haarcascade_frontalface_default.xml"
    faceCascade = cv2.CascadeClassifier(cascadePath);
    font = cv2.FONT_HERSHEY_SIMPLEX
    id = 0
    names = ['Anger', 'Happy', 'Neutral', 'Sad', 'Surprise', 'None'] 
    cam = cv2.VideoCapture(0)
    cam.set(3, 640)
    cam.set(4, 480)
    minW = 0.1*cam.get(3)
    minH = 0.1*cam.get(4)
    img = cv2.imread("come/"+imgname)
    gray = cv2.cvtColor(img,cv2.COLOR_BGR2GRAY)
    faces = faceCascade.detectMultiScale(gray, scaleFactor = 1.2, minNeighbors = 5, minSize = (int(minW), int(minH)),)
    for(x,y,w,h) in faces:
        cv2.rectangle(img, (x,y), (x+w,y+h), (0,255,0), 2)
        id, confidence = recognizer.predict(gray[y:y+h,x:x+w])
        if (confidence < 100):
            id = names[id]
            justper = "{0}".format(round(100 - confidence))
        else:
            id = "unknown"
            justper = "{0}".format(round(100 - confidence))
            arrofdata="Done,"+id+","+justper
        ap=id+','
        bp=justper+','
        cv2.putText(img, str(id), (x+5,y-5), font, 1, (255,255,255), 2)
        cv2.putText(img, str(justper+"%"), (x+5,y+h-5), font, 1, (255,255,0), 1)
    ap=ap[:-1]
    bp=bp[:-1]
    arrofdata=arrofdata+ap+'/'+bp
    cv2.imwrite("store/"+upname+".png",img)
    print("\n [INFO] Done detecting and Image is saved")
    cam.release()
    cv2.destroyAllWindows()
    return arrofdata
@app.route('/fmojidf')
def hello_fmojidf():
    url = request.args['url']
    imgname = request.args['imgname']
    upname = request.args['upname']
    arrofdata="Done/"
    r = requests.get(url)
    if r.status_code == 200:
        with open("come/"+imgname, 'wb') as f:
            f.write(r.content)
    cascadePath = "facial_expressions/haarcascade_frontalface_default.xml"
    faceCascade = cv2.CascadeClassifier(cascadePath);
    font = cv2.FONT_HERSHEY_SIMPLEX
    cam = cv2.VideoCapture(0)
    cam.set(3, 640)
    cam.set(4, 480)
    minW = 0.1*cam.get(3)
    minH = 0.1*cam.get(4)
    img = cv2.imread("come/"+imgname)
    gray = cv2.cvtColor(img,cv2.COLOR_BGR2GRAY)
    faces = faceCascade.detectMultiScale(gray, scaleFactor = 1.2, minNeighbors = 5, minSize = (int(minW), int(minH)),)
    r=DeepFace.analyze(img, actions = ['emotion'])
    r=json.dumps(r)
    rr = json.loads(r)
    id=rr['dominant_emotion']
    justper=round(rr['emotion'][id])
    for(x,y,w,h) in faces:
        cv2.rectangle(img, (x,y), (x+w,y+h), (0,255,0), 2)
        cv2.putText(img, str(id), (x+5,y-5), font, 1, (255,255,255), 2)
        cv2.putText(img, str(str(justper)+"%"), (x+5,y+h-5), font, 1, (255,255,0), 1) 
    cv2.imwrite("store/"+upname+".png",img)
    arrofdata=arrofdata+id+'/'+str(justper)
    print("\n [INFO] Done detecting and Image is saved")
    cam.release()
    cv2.destroyAllWindows()
    return arrofdata
@app.route('/fmojifer')
def hello_fmojifer():
    url = request.args['url']
    imgname = request.args['imgname']
    upname = request.args['upname']
    arrofdata="Done/"
    r = requests.get(url)
    if r.status_code == 200:
        with open("come/"+imgname, 'wb') as f:
            f.write(r.content)
    cascadePath = "facial_expressions/haarcascade_frontalface_default.xml"
    faceCascade = cv2.CascadeClassifier(cascadePath);
    font = cv2.FONT_HERSHEY_SIMPLEX
    id = 0
    names = ['Anger', 'Happy', 'Neutral', 'Sad', 'Surprise', 'None'] 
    cam = cv2.VideoCapture(0)
    cam.set(3, 640)
    cam.set(4, 480)
    minW = 0.1*cam.get(3)
    minH = 0.1*cam.get(4)
    img = cv2.imread("come/"+imgname)
    gray = cv2.cvtColor(img,cv2.COLOR_BGR2GRAY)
    ferr=FER(mtcnn=True)
    faces = faceCascade.detectMultiScale(gray, scaleFactor = 1.2, minNeighbors = 5, minSize = (int(minW), int(minH)),)
    r=ferr.detect_emotions(img)
    pi=len(r)
    emolist=["meow"]
    vallist=[0]
    stremo=""
    valemo=""
    name= ['angry', 'disgust', 'fear', 'happy', 'sad', 'surprise', 'neutral']
    for pii in range(0,pi):
        rol=r[pii]
        rrrr=0
        rrra='none'
        for pki in name:
            ap=rol["emotions"][pki]
            if(ap>rrrr):
                rrrr=ap
                rrra=pki
        emolist.append(rrra)
        vallist.append(int(rrrr*100))
        stremo=stremo+rrra+','
        valemo=valemo+str(int(rrrr*100))+','
    stremo=stremo[:-1]
    valemo=valemo[:-1]
    pika=0
    for(x,y,w,h) in faces:
        cv2.rectangle(img, (x,y), (x+w,y+h), (0,255,0), 2)
        pika=pika+1
        id=emolist[pika]
        justper=vallist[pika]
        cv2.putText(img, str(id), (x+5,y-5), font, 1, (255,255,255), 2)
        cv2.putText(img, str(str(justper)+"%"), (x+5,y+h-5), font, 1, (255,255,0), 1)
    cv2.imwrite("store/"+upname+".png",img)
    print("\n [INFO] Done detecting and Image is saved")
    arrofdata=arrofdata+stremo+'/'+valemo
    cam.release()
    cv2.destroyAllWindows()
    return arrofdata
if(__name__=='__main__'):
    app.run(debug=True)