<div>
    <div class="py-1 "></div>
    <div class="card bg-white">
        <div class="card-body px-3" style="align-items: center">
            <h2 class="py-4"
                style="display: flex; justify-content: center; font-weight: bold; color: rgb(75, 192, 192)">
                Estadísticas de Sesiones de Apoyo</h2>
            <div class="row py-2">
                <div class="col-md-3 mb-3 ml-8">
                    <label for="start_date_sesiones">Fecha Inicio:</label>
                    <input class="form-control @error('start_date_sesiones') is-invalid @enderror"
                        wire:model="start_date_sesiones" type="date" id="start_date_sesiones" name="start_date_sesiones">
                    <div>
                        @error('start_date_sesiones')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 mb-3 ml-8">
                    <label for="end_date_sesiones">Fecha Fin:</label>
                    <input class="form-control @error('end_date_sesiones') is-invalid @enderror"
                        wire:model="end_date_sesiones" type="date" id="end_date_sesiones" name="end_date_sesiones">
                    <div>
                        @error('end_date_sesiones')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 mb-3 ml-8">
                    <label for="curso_sesiones">Curso:</label>
                    <select class="form-control" wire:model="curso_sesiones" id="curso_sesiones" name="curso_sesiones">
                        <option value="">Todo</option>
                        @foreach ($cursoOptions_sesiones as $cursoOption)
                            <option value="{{ $cursoOption }}">{{ $cursoOption }}</option>
                        @endforeach
                    </select>
                    <div>
                        @error('curso_sesiones')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 mb-3 ml-8">
                    <label for="sexo_sesiones">Sexo:</label>
                    <select class="form-control" wire:model="sexo_sesiones" id="sexo_sesiones" name="sexo_sesiones">
                        <option value="">Todo</option>
                        <!-- Opciones de sexo para sesiones de apoyo -->
                    </select>
                    <div>
                        @error('sexo_sesiones')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-start ml-8">
                <button class="btn btn-secondary bg-emerald-300 rounded-full px-4 my-2"
                    wire:click='clearDateFilters'>Limpiar Filtros de Fecha</button>
            </div>

        </div>

        <div style="justify-content: center; display: flex">
            <div style="margin-top: 20px; align-items: center; width: 40%">
                <canvas id="barChartSesiones"></canvas>
            </div>
        </div>

        <div style="display: flex; align-items: center; margin-left: 20px;">
            <div style="font-size: 15px;">
                <p style="font-weight: bold; color: rgb(16, 27, 175);">Total de Sesiones: {{ $data['data'][0] }}</p>
            </div>
        </div>
        <script>
            document.addEventListener('livewire:load', function() {

                let barChartSesiones = null;

                drawSesiones(@json($data));

                Livewire.on('draw_sesiones', function(data) {
                    drawSesiones(data);
                });

                function drawSesiones(newData) {
                    let ctx = document.getElementById('barChartSesiones').getContext('2d');

                    const data = {
                        labels: newData.labels,
                        datasets: [{
                            label: 'Nro. de sesiones',
                            data: newData.data,
                            backgroundColor: 'rgb(75, 192, 192)',
                            borderColor: 'rgb(75, 192, 192)',
                            borderWidth: 1,
                        }]
                    };

                    if (barChartSesiones) {
                        barChartSesiones.destroy()
                    }

                    barChartSesiones = new Chart(ctx, {
                        type: 'bar',
                        data: data,
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        },
                    });

                    barChartSesiones.render();
                }
            });
        </script>
    </div>
</div>
