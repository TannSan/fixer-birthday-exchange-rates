<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Fixer Birthday Exchange Rates</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="card">
                <img class="card-img-top" src="..." alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            @if($birthdays->count() > 0)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-0">Previous Results</h5>
                </div>
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Birthday</th>
                            <th class="text-center">Currency</th>
                            <th class="text-right">Exchange Rate</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($birthdays as $birthday)
                        <tr>
                            <td>{{ date_format(DateTime::createFromFormat('Y-m-d', $birthday->birthday), 'jS F Y') }}</td>
                            <td class="text-center">{{ $birthday->currency_code }}</td>
                            <td class="text-right">{{ $birthday->exchange_rate }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </body>
</html>
