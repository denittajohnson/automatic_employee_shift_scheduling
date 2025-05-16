Automatic Employee Shift Scheduling
-----------------------------------

#python 3.6.5

pip install opencv-contrib-python==4.1.1.26
pip install opencv-python==4.5.5.64

Technologies Used:
Haar Cascade Classifier Algorithm and OpenCV for face detection.VSCode is used as primary code editor.HTML, CSS, JavaScript used for frontend.PHP is used for backend developing.MySQL(via XAMPP) is used for database management 

Key Features: 
	If an employee takes a normal or emergency leave, the day wise scheduling is adjusted among the remaining employees.
	When an employee takes leave, another employee may cover their shift. However, the covered shift must be returned to the original employee once they return from leave.
	Employee can view the remaining number of leaves.
	Employee can register and login using face id.
	If an employee takes an emergency leave the notification (email, call) is send to the preceding or following employee to take the shift.

Leave Application and Approval
•	Employees can apply for leave via the system, specifying the leave type (e.g., planned, emergency) and duration.
•	Leave requests are reviewed by the department head, who considers leave balance, staffing needs, and current schedules.
•	Upon approval, rescheduling takes place.
