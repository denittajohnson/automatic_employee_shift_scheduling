import cv2
import pickle
import datetime
import os

label=list(os.listdir('database'))
 
def face_recognize():
	f=open('out.txt','w')
	f.write('invalid')
	f.close()
			
	base_dir=""
    # create objects
	cam = cv2.VideoCapture(0)
	model = cv2.face.LBPHFaceRecognizer_create()
	faceD = cv2.CascadeClassifier(base_dir+"haarcascade_frontalface_default.xml")

	i=0
	flag=0


	with open(base_dir+'model.pkl', 'rb') as f:
			ids = pickle.load(f)
	model.read(base_dir+'model.xml')
	cnt=0
	
	while (cam.isOpened()):
		ret, frame = cam.read()
		if not(ret):
			continue
		gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
		faces = faceD.detectMultiScale(gray, 1.3, 5)
		for (x,y,w,h) in faces:
			cv2.rectangle(frame,(x,y),(x+w,y+h),(255,0,0),2)
			face = gray[y:y+h,x:x+w]
			face = cv2.resize(face,(130,100))
			result = model.predict(face)
			print(label)
			print(result)
			print("prediction:",label[int(result[0])])
			cv2.rectangle(frame, (x, y), (x + w, y + h), (0, 255, 0), 2)
          
			if result[1]<80:
				print(label[int(result[0])])
				f=open('out.txt','w')
				f.write(label[int(result[0])])
				f.close()
				                
				#flag=1
			else:
				f=open('out.txt','w')
				f.write('invalid')
				f.close()
			

      
		cnt+=1
		if flag==1 or cnt>30:
           
			cam.release()
			cv2.destroyAllWindows()
			
			break


face_recognize()

