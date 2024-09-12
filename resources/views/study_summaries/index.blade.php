<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-app-layout>

    <body>
  <h1>円グラフ</h1>
  
        <div id="app">
          <div>
            集計：
            <button id="prevMonth">前の月</button>
            <span id="currentMonth"></span>
            <button id="nextMonth">次の月</button>
            <div id="eventList"></div>
          </div>
      </div>
  <canvas id="myPieChart"></canvas>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
  
<script>
    let currentDate = new Date();
    let titles = [];
    let hours = [];
    let myPieChart;
    function updateEvents() {
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth() + 1; // JavaScript's months are 0-indexed
        fetch(`/events/${year}/${month}`)
            .then(response => response.json())
            .then(events => {
                titles = events.map(event => event.event_title);
                hours = events.map(event => event.hour);
                const eventList = document.getElementById('eventList');
                eventList.innerHTML = '';
                events.forEach(event => {
                    eventList.innerHTML += `<p>${event.event_title} - ${event.hour}時</p>`;
                });
                if (myPieChart) {
                    myPieChart.destroy();
                }
                var ctx = document.getElementById("myPieChart");
                myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: titles,
                        datasets: [{
                            backgroundColor: [
                                "#BB5179",
                                "#FAFF67",
                                "#58A27C",
                                "#3C00FF"
                            ],
                            data: hours,
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: '科目別勉強時間 統計'
                        }
                    }
                });
                console.log(titles);
            });
        document.getElementById('currentMonth').textContent = `${year}年${month}月`;
    }
    document.getElementById('prevMonth').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        updateEvents();
    });
    document.getElementById('nextMonth').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        updateEvents();
    });
    // 初期表示
    updateEvents();
</script>
    </body>
    <script src="https://unpkg.com/chartjs-plugin-colorschemes"></script>
    </x-app-layout>
</html>