<h5 class="text-xl font-bold leading-none text-dark-500 dark:text-light-500 mb-4">Upcoming Schedule</h5>
<div id="calendar" class="text-dark-500 dark:text-light-500"></div>

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
    <style>
        .fc-event-title, .fc-event-time {
            white-space: normal !important;
        }
    </style>
@endpush

@push('scripts')
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
                                const events = data.map(schedule => ({
                                    title: `${schedule.doctor_name}`,
                                    start: `${schedule.date}T${schedule.time}`,
                                    description: `Status: ${schedule.status}`
                                }));
                                successCallback(events);
                            }
                        })
                        .catch(error => {
                            console.error("Error fetching upcoming schedule:", error);
                            failureCallback("Error loading schedule.");
                        });
                },
                eventContent: function(arg) {
                    let time = document.createElement('div');
                    time.classList.add('fc-event-time');
                    time.innerHTML = arg.event.start.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

                    let doctorName = document.createElement('div');
                    doctorName.classList.add('fc-event-title');
                    doctorName.innerHTML = arg.event.title;

                    let arrayOfDomNodes = [ time, doctorName ];

                    return { domNodes: arrayOfDomNodes };
                }
            });

            calendar.render();
        });
    </script>
@endpush