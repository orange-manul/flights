<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Information</title>
    <!-- Подключение Bootstrap для красивой таблицы -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Flight Information</h1>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Airline Name</th>
            <th>Flight IATA</th>
            <th>Departure Airport</th>
            <th>Arrival Airport</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($flights as $flight)
            <tr>
                <td>{{ $flight['airline_name'] }}</td>
                <td>{{ $flight['flight_iata'] }}</td>
                <td>{{ $flight['departure_airport'] }}</td>
                <td>{{ $flight['arrival_airport'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @if (empty($flights))
        <div class="alert alert-info">No flight data available.</div>
    @endif
</div>

<!-- Подключение JS-библиотек Bootstrap (опционально) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
