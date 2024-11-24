<h5 class="text-xl font-bold leading-none text-dark-500 dark:text-light-500 mb-4">Upcoming Schedule</h5>
<div id="calendar" class="text-dark-500 dark:text-light-500"></div>

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const calendarEl = document.getElementById('calendar');

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridWeek',
            events: function(fetchInfo, successCallback, failureCallback) {
                fetch("{{ route('fetchUpcomingSchedule') }}")
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            failureCallback(data.error);
                        } else {
                            const events = [{
                                title: `Doctor: ${data.doctor_name}`,
                                start: `${data.date}T${data.time}`,
                                description: `Status: ${data.status}`
                            }];
                            successCallback(events);
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching upcoming schedule:", error);
                        failureCallback("Error loading schedule.");
                    });
            },
        });

        calendar.render();
    });
</script>