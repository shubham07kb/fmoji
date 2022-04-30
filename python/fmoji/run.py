import cv2 #pip install opencv-python, pip install opencv-contrib-python
import numpy as np #pip install numpy
from PIL import Image #pip install pillow
import os 
with open('facial_expressions/anger.txt','r') as fa:
    imganger = [line.strip() for line in fa]
for image in imganger:
    loadedImage = cv2.imread("facial_expressions/images/"+image)
    cv2.imwrite("facial_expressions/data_set/anger/"+image,loadedImage)
print("done writing for anger")
with open('facial_expressions/happy.txt','r') as fh:
    imghappy = [line.strip() for line in fh]
for image in imghappy:
    loadedImage = cv2.imread("facial_expressions/images/"+image)
    cv2.imwrite("facial_expressions/data_set/happy/"+image,loadedImage)
print("done writing for happy")
with open('facial_expressions/neutral.txt','r') as fn:
    imgneutral = [line.strip() for line in fn]
for image in imgneutral:
    loadedImage = cv2.imread("facial_expressions/images/"+image)
    cv2.imwrite("facial_expressions/data_set/neutral/"+image,loadedImage)
print("done writing for neutral")
with open('facial_expressions/sad.txt','r') as fs:
    imgsad = [line.strip() for line in fs]
for image in imgsad:
    loadedImage = cv2.imread("facial_expressions/images/"+image)
    cv2.imwrite("facial_expressions/data_set/sad/"+image,loadedImage)
print("done writing for sad")
with open('facial_expressions/surprise.txt','r') as fsp:
    imgsurprise = [line.strip() for line in fsp]
for image in imgsurprise:
    loadedImage = cv2.imread("facial_expressions/images/"+image)
    cv2.imwrite("facial_expressions/data_set/surprise/"+image,loadedImage)
print("done writing for surprise")
with open('facial_expressions/anger.txt','r') as faa:
    imagesaa = [line.strip() for line in faa]
face_detector = cv2.CascadeClassifier('facial_expressions/haarcascade_frontalface_default.xml')
face_id = "0"
count = 0
for image in imagesaa:
    img = cv2.imread("facial_expressions/data_set/anger/"+image)
    gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
    faces = face_detector.detectMultiScale(gray, 1.3, 5)
    for (x,y,w,h) in faces:
        cv2.rectangle(img, (x,y), (x+w,y+h), (255,0,0), 2)     
        count += 1
        cv2.imwrite("facial_expressions/dataset/User." + str(face_id) + '.' + str(count) + ".jpg", gray[y:y+h,x:x+w])
print("\n Done creating face data for anger")
with open('facial_expressions/happy.txt','r') as fhh:
    imageshh = [line.strip() for line in fhh]
face_detector = cv2.CascadeClassifier('facial_expressions/haarcascade_frontalface_default.xml')
face_id = "1"
count = 0
for image in imageshh:
    img = cv2.imread("facial_expressions/data_set/happy/"+image)
    gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
    faces = face_detector.detectMultiScale(gray, 1.3, 5)
    for (x,y,w,h) in faces:
        cv2.rectangle(img, (x,y), (x+w,y+h), (255,0,0), 2)     
        count += 1
        cv2.imwrite("facial_expressions/dataset/User." + str(face_id) + '.' + str(count) + ".jpg", gray[y:y+h,x:x+w])
print("\n Done creating face data for happy")
with open('facial_expressions/neutral.txt','r') as fnn:
    imagesnn = [line.strip() for line in fnn]
face_detector = cv2.CascadeClassifier('facial_expressions/haarcascade_frontalface_default.xml')
face_id = "2"
count = 0
for image in imagesnn:
    img = cv2.imread("facial_expressions/data_set/neutral/"+image)
    gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
    faces = face_detector.detectMultiScale(gray, 1.3, 5)
    for (x,y,w,h) in faces:
        cv2.rectangle(img, (x,y), (x+w,y+h), (255,0,0), 2)     
        count += 1
        cv2.imwrite("facial_expressions/dataset/User." + str(face_id) + '.' + str(count) + ".jpg", gray[y:y+h,x:x+w])
print("\n Done creating face data for neutral")
with open('facial_expressions/sad.txt','r') as fss:
    imagesss = [line.strip() for line in fss]
face_detector = cv2.CascadeClassifier('facial_expressions/haarcascade_frontalface_default.xml')
face_id = "3"
count = 0
for image in imagesss:
    img = cv2.imread("facial_expressions/data_set/sad/"+image)
    gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
    faces = face_detector.detectMultiScale(gray, 1.3, 5)
    for (x,y,w,h) in faces:
        cv2.rectangle(img, (x,y), (x+w,y+h), (255,0,0), 2)     
        count += 1
        cv2.imwrite("facial_expressions/dataset/User." + str(face_id) + '.' + str(count) + ".jpg", gray[y:y+h,x:x+w])
print("\n Done creating face data for sad")
with open('facial_expressions/surprise.txt','r') as fspp:
    imagesspp = [line.strip() for line in fspp]
face_detector = cv2.CascadeClassifier('facial_expressions/haarcascade_frontalface_default.xml')
face_id = "4"
count = 0
for image in imagesspp:
    img = cv2.imread("facial_expressions/data_set/surprise/"+image)
    gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
    faces = face_detector.detectMultiScale(gray, 1.3, 5)
    for (x,y,w,h) in faces:
        cv2.rectangle(img, (x,y), (x+w,y+h), (255,0,0), 2)     
        count += 1
        cv2.imwrite("facial_expressions/dataset/User." + str(face_id) + '.' + str(count) + ".jpg", gray[y:y+h,x:x+w])
print("\n Done creating face data for surprise")
path = 'facial_expressions/dataset'
recognizer = cv2.face.LBPHFaceRecognizer_create()
detector = cv2.CascadeClassifier("facial_expressions/haarcascade_frontalface_default.xml");
def getImagesAndLabels(path):
    imagePaths = [os.path.join(path,f) for f in os.listdir(path)]     
    faceSamples=[]
    ids = []
    for imagePath in imagePaths:
        PIL_img = Image.open(imagePath).convert('L')
        img_numpy = np.array(PIL_img,'uint8')
        id = int(os.path.split(imagePath)[-1].split(".")[1])
        faces = detector.detectMultiScale(img_numpy)
        for (x,y,w,h) in faces:
            faceSamples.append(img_numpy[y:y+h,x:x+w])
            ids.append(id)
    return faceSamples,ids
print ("\n [INFO] Training faces....")
faces,ids = getImagesAndLabels(path)
recognizer.train(faces, np.array(ids))
recognizer.write('facial_expressions/trainer/trainer.yml')
print("\n [INFO] {0} Emotions trained. Exiting Program".format(len(np.unique(ids))))
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
img = cv2.imread("facial_expressions/elon.jpg")
gray = cv2.cvtColor(img,cv2.COLOR_BGR2GRAY)
faces = faceCascade.detectMultiScale( 
    gray,
    scaleFactor = 1.2,
    minNeighbors = 5,
    minSize = (int(minW), int(minH)),
    )
for(x,y,w,h) in faces:
    cv2.rectangle(img, (x,y), (x+w,y+h), (0,255,0), 2)
    id, confidence = recognizer.predict(gray[y:y+h,x:x+w]) 
    if (confidence < 100):
        id = names[id]
        confidence = "  {0}%".format(round(100 - confidence))
    else:
        id = "unknown"
        confidence = "  {0}%".format(round(100 - confidence))
    cv2.putText(img, str(id), (x+5,y-5), font, 1, (255,255,255), 2)
    cv2.putText(img, str(confidence), (x+5,y+h-5), font, 1, (255,255,0), 1)  
cv2.imwrite("facial_expressions/elon_musk.jpg",img) 
print("\n [INFO] Done detecting and Image is saved")
print("\n [INFO] Done Successfully")
cam.release()
cv2.destroyAllWindows()