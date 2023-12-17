<div>
    <div class="py-1 "></div>
    <div class="card bg-white">
        <div class="card-body px-3" style="align-items: center">
            <h2 class="py-4"
                style="display: flex; justify-content: center; font-weight: bold; color: rgb(75, 192, 192)">
                Estadísticas de Respuestas</h2>
            <div class="row py-2">
                <div class="col-md-3 mb-3 ml-8">
                    <label for="start_date">Fecha Inicio:</label>
                    <input class="form-control @error('start_date') is-invalid @enderror" wire:model="start_date"
                        type="date" id="start_date" name="start_date">
                    <div>
                        @error('start_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 mb-3 ml-8">
                    <label for="end_date">Fecha Fin:</label>
                    <input class="form-control @error('end_date') is-invalid @enderror" wire:model="end_date"
                        type="date" id="end_date" name="end_date">
                    <div>
                        @error('end_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 mb-3 ml-8">
                    <label for="edad">Edad:</label>
                    <select class="form-control" wire:model="edad" id="edad" name="edad">
                        <option value="">Todo</option>
                        @foreach ($edadOptions as $edadOption)
                            <option value="{{ $edadOption }}">{{ $edadOption }}</option>
                        @endforeach
                    </select>
                    <div>
                        @error('edad')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 mb-3 ml-8">
                    <label for="sexo">Sexo:</label>
                    <select class="form-control" wire:model="sexo" id="sexo" name="sexo">
                        <option value="">Todo</option>
                        @foreach ($sexoOptions as $sexoOption)
                            <option value="{{ $sexoOption }}">{{ $sexoOption }}</option>
                        @endforeach
                    </select>
                    <div>
                        @error('sexo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-start ml-8">
                <button class="btn btn-secondary bg-emerald-300 rounded-full px-4 my-2" wire:click='clearDateFilters'>Limpiar Filtros de Fecha</button>
            </div>
            
        </div>

        <div style="justify-content: center; display: flex">
            <div style="margin-top: 20px; align-items: center; width: 40%">
                <canvas id="pieChart"></canvas>
            </div>
        </div>

        <div style="display: flex; align-items: center; margin-left: 20px;">
            <div style="font-size: 15px;">
                <p style="font-weight: bold; color: rgb(16, 27, 175);">Total de respuestas: {{ $totalRespuestas }}</p>
                <p style="font-weight: bold; color: rgb(141, 187, 37);">Porcentaje de respuestas positivas: {{ $porcentajeRespuestasPositivas }} %</p>
                <p style="font-weight: bold; color: rgb(245, 54, 92);">Porcentaje de respuestas negativas: {{ $porcentajeRespuestasNegativas }} %</p>
                <p style="font-weight: bold; color: rgb(75, 192, 192);">Porcentaje de respuestas neutrales: {{ $porcentajeRespuestasNeutrales }} %</p>
            </div>
        </div>
        <script>
            document.addEventListener('livewire:load', function() {

                let pieChart = null;

                draw(@json($data));

                Livewire.on('draw', function(data) {
                    draw(data);
                });

                function draw(newData) {
                    let ctx = document.getElementById('pieChart').getContext('2d');

                    const data = {
                        labels: newData.labels,
                        datasets: [{
                            label: 'Nro. de respuestas',
                            data: newData.data,
                            borderColor: 'rgb(176,176,176)',
                            borderWidth: 2,
                            backgroundColor: [
                                'rgb(141,187,37)', // Positivas
                                'rgb(245,54,92)', // Negativas
                                'rgb(75, 192, 192)', // Neutrales
                            ],
                            fill: false
                        }]
                    };

                    if (pieChart) {
                        pieChart.destroy()
                    }

                    pieChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: data,
                    });

                    pieChart.render();
                }
            });
        </script>
    </div>
</div>
</div>
