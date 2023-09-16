<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income outcome</title>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/argon-design-system-free@1.2.0/assets/css/argon-design-system.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success text-white">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card card-body">
                    <form action="{{ route('index.store') }}" method="post"
                        class="d-flex justify-content space-between">
                        @csrf
                        <input type="text" class="btn btn-dark text-white" name="about" />
                        <input type="number" class="btn btn-dark text-white" name="amount" />
                        <input type="date" class="btn btn-dark text-white" name="date" />
                        <select id="" name="type" class="btn btn-dark text-white">
                            <option value="in">income</option>
                            <option value="out">outcome</option>
                        </select>
                        <input type="submit" class="btn btn-success text-white" value="report">
                    </form>
                </div>
            </div>
            <div class="col-6">
                <ul class="list-group mt-3">
                    @foreach ($data as $d)
                        <li class="list-group-item d-flex justify-content-between">
                            <div class="">
                                {{ $d->about }} <br>
                                <small class="text-muted">{{ $d->date }}</small>
                            </div>
                            @if ($d->type === 'in')
                                <small class="text-success">+{{ $d->amount }} kyats</small>
                            @else
                                <small class="text-danger">-{{ $d->amount }}kyats</small>
                            @endif
                        </li>
                    @endforeach;

                </ul>
            </div>
            <div class="col-6">
                <div class="card card-body">
                    <div class="d-flex justify-content-between">
                        <h5>Today Chart</h5>
                        <div>
                            <small class="text-success"> Income: +{{ $total_income }}kyats</small>
                            <small class="ml-4 text-danger"> Outcome: -{{ $total_outcome }}kyats</small>
                        </div>
                    </div>
                    <hr class="p-0 m-0">
                    <div class="mt-3">
                        <canvas id="inout"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('inout');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($day_arr),
                datasets: [{
                        label: 'income',
                        data: @json($income_amount),
                        borderWidth: 1,
                        backgroundColor: '#2dce89'
                    },
                    {
                        label: 'outcome',
                        data: @json($outcome_amount),
                        borderWidth: 1,
                        backgroundColor: '#f5365c'
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>
