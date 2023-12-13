<div>
    <div class="py-1"></div>
    <div class="card">
        <!-- ... (Encabezado de la tarjeta) ... -->

        <div class="card-body px-3" style="align-items: center">
            <h2 class="py-4"
                style="display: flex; justify-content: center ; font-weight: bold; color: rgb(75, 192, 192)">
                Sentimiento de Respuestas</h2>

            <!-- Gráfico de Sentimiento de Respuestas -->
            <div style="justify-content: center; display: flex">
                <div style="margin-top: 20px; align-items: center; width: 40%">
                    <canvas id="sentimientoChart"></canvas>
                </div>
            </div>

            <!-- Script JavaScript -->
            <script>
                document.addEventListener('livewire:load', function() {
                    let sentimientoChart = null;

                    draw(@json($data));

                    Livewire.on('draw', function(data) {
                        draw(data);
                    });

                    function draw(newData) {
                        let ctx = document.getElementById('sentimientoChart').getContext('2d');

                        const data = {
                            labels: newData.labels,
                            datasets: [{
                                data: newData.data,
                                backgroundColor: [
                                    'rgb(141,187,37)', // Positivo
                                    'rgba(255, 0, 0, 0.9)', // Negativo
                                    'rgb(33,150,243)', // Neutral
                                ],


                                hoverOffset: 4
                            }]
                        };

                        if (sentimientoChart) {
                            sentimientoChart.destroy()
                        }

                        sentimientoChart = new Chart(ctx, {
                            type: 'doughnut',
                            data: data,
                        });

                        sentimientoChart.render();
                    }
                });
            </script>
        </div>
    </div>
</div>
