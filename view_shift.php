<?php
include('header.php');
include('connection.php');

$sel = mysqli_query($con, "SELECT * FROM employee WHERE id='$_SESSION[uid]'");
$cc = mysqli_fetch_array($sel);
?>

<style>
    .calendar-container {
        display: flex;
        gap: 20px;
    }
    .calendar {
        width: 550px;
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }
    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 18px;
        margin-bottom: 10px;
    }
    .days {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 5px;
        text-align: center;
        font-weight: bold;
    }
    .dates {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 5px;
    }
    .day, .date {
        padding: 10px;
        border-radius: 5px;
    }
    .date {
        background: #e3e3e3;
        cursor: pointer;
    }
    .date:hover {
        background: #007bff;
        color: white;
    }
    .btn {
        cursor: pointer;
        background: none;
        border: none;
        font-size: 18px;
        font-weight: bold;
    }
    .shift-details {
        width: 50%;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background: #f8f9fa;
    }
    .morning {
        background-color: #28a745 !important;
        color: white;
    }
    .noon {
        background-color: #fd7e14 !important;
        color: white;
    }
    .night {
        background-color: #007bff !important;
        color: white;
    }
</style>

	        <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
            <div class="row py-5">
                <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-4 text-white animated zoomIn">Shift Details</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-12">
                <div class="section-title position-relative pb-3 mb-5">
                    <h5 class="fw-bold text-primary text-uppercase">Employee</h5>
                    <h1 class="mb-0">Shift Details</h1>
                </div>
                <div class="calendar-container">
                    <div class="calendar">
                        <div class="calendar-header">
                            <button class="btn" onclick="prevMonth()">&#9665;</button>
                            <span id="month-year"></span>
                            <button class="btn" onclick="nextMonth()">&#9655;</button>
                        </div>
                        <div class="days">
                            <div class="day">Sun</div>
                            <div class="day">Mon</div>
                            <div class="day">Tue</div>
                            <div class="day">Wed</div>
                            <div class="day">Thu</div>
                            <div class="day">Fri</div>
                            <div class="day">Sat</div>
                        </div>
                        <div class="dates" id="dates"></div>
                    </div>
                    <div class="shift-details">
                        <h3>Shift Details</h3>
                        <p id="shift-info">Click on a date to see shift details.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let currentMonth = new Date().getMonth();
    let currentYear = new Date().getFullYear();

    function generateCalendar(month, year) {
        const datesContainer = document.getElementById("dates");
        const monthYear = document.getElementById("month-year");
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        monthYear.innerText = new Date(year, month).toLocaleString('default', { month: 'long', year: 'numeric' });
        datesContainer.innerHTML = '';

        for (let i = 0; i < firstDay; i++) {
            let emptyDiv = document.createElement("div");
            emptyDiv.classList.add("date");
            datesContainer.appendChild(emptyDiv);
        }

        for (let day = 1; day <= daysInMonth; day++) {
            let dateDiv = document.createElement("div");
            dateDiv.classList.add("date");
            dateDiv.innerText = day;
            dateDiv.dataset.date = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;

            fetch(`load_shifts.php?date=${dateDiv.dataset.date}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        data.forEach(shift => {
                            if (shift.extendedProps.shift_name === 'Morning') dateDiv.classList.add("morning");
                            if (shift.extendedProps.shift_name === 'Noon') dateDiv.classList.add("noon");
                            if (shift.extendedProps.shift_name === 'Night') dateDiv.classList.add("night");
                        });
                    }
                });
/*
            dateDiv.addEventListener("click", function() {
			let selectedDate = this.dataset.date; // Store date separately
			fetch(`load_shifts.php?date=${selectedDate}`)
				.then(response => response.json())
				.then(data => {
					let shiftInfo = document.getElementById("shift-info");
					if (data.length > 0) {
						shiftInfo.innerHTML = "<strong>📅 " + selectedDate + "</strong><br>";
						data.forEach(function(shift) {
							if (shift.extendedProps) { // Ensure extendedProps exists
								shiftInfo.innerHTML += "🕒 Shift: " + shift.extendedProps.shift_name + "<br>" +
													   "👨‍💼 Assigned By: " + shift.extendedProps.assigned_by + "<br>" +
													   "📌 Status: " + shift.extendedProps.status + "<br><br>";
							} else {
								shiftInfo.innerHTML += "No shift details available.<br><br>";
							}
						});
					} else {
						shiftInfo.innerHTML = "No shifts assigned for this date.";
					}
				})
				.catch(error => console.error("Error fetching shifts:", error));
		});
		*/
dateDiv.addEventListener("click", function () {
    let selectedDate = this.dataset.date;

    fetch("load_shifts.php?date=" + selectedDate)
        .then(response => response.json())
        .then(data => {
            let shiftInfo = document.getElementById("shift-info");
            let normalShifts = "";
            let reassignedShifts = "";

            if (data.length > 0) {
                data.forEach(shift => {
                    if (shift.extendedProps) { // Ensure extendedProps exists
                        let shiftDetails = "🕒 Shift: " + shift.extendedProps.shift_name + "<br>" +
                                           "👨‍💼 Assigned By: " + shift.extendedProps.assigned_by + "<br>" +
                                           "📌 Status: " + shift.extendedProps.status + "<br><br>";

                        // Check if the shift is reassigned or normal
                        if (shift.extendedProps.shift_type === "reassigned") {
                            reassignedShifts += shiftDetails;
                        } else {
                            normalShifts += shiftDetails;
                        }
                    }
                });

                shiftInfo.innerHTML = "<strong>📅 " + selectedDate + "</strong><br>";

                if (normalShifts) {
                    shiftInfo.innerHTML += "<h6>📌 Normal Shifts</h6>" + normalShifts;
                }
                if (reassignedShifts) {
                    shiftInfo.innerHTML += "<h6>🔄 Reassigned Shifts</h6>" + reassignedShifts;
                }
            } else {
                shiftInfo.innerHTML = "No shifts assigned for this date.";
            }
        })
        .catch(error => console.error("Error fetching shifts:", error));
});




		
		


            datesContainer.appendChild(dateDiv);
        }
    }

    function prevMonth() {
        if (currentMonth === 0) {
            currentMonth = 11;
            currentYear--;
        } else {
            currentMonth--;
        }
        generateCalendar(currentMonth, currentYear);
    }

    function nextMonth() {
        if (currentMonth === 11) {
            currentMonth = 0;
            currentYear++;
        } else {
            currentMonth++;
        }
        generateCalendar(currentMonth, currentYear);
    }

    document.addEventListener("DOMContentLoaded", function () {
        generateCalendar(currentMonth, currentYear);
    });
</script>

<?php
include('footer.php');
?>
