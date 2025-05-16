<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
        }
        .calendar {
            width: 350px;
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
    </style>
</head>
<body>
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
    <script>
        let currentDate = new Date();

        function renderCalendar() {
            const monthYear = document.getElementById("month-year");
            const datesContainer = document.getElementById("dates");
            datesContainer.innerHTML = "";

            let year = currentDate.getFullYear();
            let month = currentDate.getMonth();
            monthYear.textContent = new Date(year, month).toLocaleString("default", { month: "long" }) + " " + year;

            let firstDay = new Date(year, month, 1).getDay();
            let lastDate = new Date(year, month + 1, 0).getDate();

            for (let i = 0; i < firstDay; i++) {
                datesContainer.innerHTML += "<div></div>";
            }
            
            for (let i = 1; i <= lastDate; i++) {
                datesContainer.innerHTML += "<div class='date'>" + i + "</div>";
            }
        }

        function prevMonth() {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        }
        
        function nextMonth() {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        }
        
        renderCalendar();
    </script>
</body>
</html>
