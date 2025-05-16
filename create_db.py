import cv2
import os

def create_data(contents):
    base_dir = os.path.dirname(os.path.abspath(__file__))  # Get the script's directory
    cascade_path = os.path.join(base_dir, "haarcascade_frontalface_default.xml")

    if not os.path.exists(cascade_path):
        print(f"Error: Haarcascade file not found at {cascade_path}")
        return

    print(f"Using Haarcascade at: {cascade_path}")

    database = os.path.join(base_dir, "database")
    dataset = contents
    path = os.path.join(database, dataset)

    if not os.path.isdir(path):
        os.makedirs(path)

    cam = cv2.VideoCapture(0)
    faceD = cv2.CascadeClassifier(cascade_path)

    count = 1
    while cam.isOpened():
        ret, frame = cam.read()
        if not ret:
            continue

        gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
        faces = faceD.detectMultiScale(gray, 1.3, 5)

        for (x, y, w, h) in faces:
            cv2.rectangle(frame, (x, y), (x + w, y + h), (255, 0, 0), 2)
            face = gray[y:y + h, x:x + w]
            face = cv2.resize(face, (130, 100))
            cv2.imwrite(os.path.join(path, f"{count}.png"), face)
            count += 1

            if count == 31:
                cam.release()
                cv2.destroyAllWindows()
                return

        cv2.imshow("video", frame)

        if cv2.waitKey(1) & 0xFF == ord("q"):
            break

    cam.release()
    cv2.destroyAllWindows()

with open("userid.txt", "r") as file:
    data = file.read()

# Run the function
#create_data("1")
create_data(data)
