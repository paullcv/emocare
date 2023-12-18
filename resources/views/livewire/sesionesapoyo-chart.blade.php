<div>
    <div class="py-1">
        <div class="card bg-white mt-8 ml-8 mr-8">
            <div class="card-body px-3">
                <h2 class="py-4"
                    style="display: flex; justify-content: center; font-weight: bold; color: rgb(45,206,137)">
                    Cantidad de Sesiones de Apoyo - {{ $data['data'] ? array_sum($data['data']) : 0 }}
                </h2>

                <div class="form-group">
                    <label for="filtro" class="form-label">Selecciona:</label>
                    <select class="form-control" id="filtro" wire:model="filtro_sesiones" style="width: 15%">
                        <option value="curso">Por Curso</option>
                        <option value="edad">Por Edad</option>
                        <option value="sexo">Por Sexo</option>
                    </select>
                </div>

                <div style="width: 100%; margin: 0 auto; max-width: 800px; padding: 0 20px 25px">
                    <canvas id="verticalBarChart" width="100%"></canvas>
                </div>

                <script>
                    document.addEventListener('livewire:load', function() {
                        let verticalBarChart = null;

                        draw(@json($data));
                        Livewire.on('draw_sesiones', function(data) {
                            draw(data);
                        });

                        function draw(newData) {
                            var ctx = document.getElementById('verticalBarChart').getContext('2d');
                            var chartData = {
                                labels: newData.labels,
                                datasets: [{
                                    label: 'Cantidad de Sesiones de Apoyo',
                                    data: newData.data,
                                    backgroundColor: 'rgb(45,206,137)',
                                    borderColor: 'rgb(176,176,176)',
                                    borderWidth: 1
                                }]
                            };

                            var chartOptions = {
                                indexAxis: 'x',
                                scales: {
                                    x: {
                                        beginAtZero: true
                                    }
                                }
                            };

                            if (verticalBarChart) {
                                verticalBarChart.destroy()
                            }

                            verticalBarChart = new Chart(ctx, {
                                type: 'bar',
                                data: chartData,
                                options: chartOptions
                            });

                            verticalBarChart.render();
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</div>
