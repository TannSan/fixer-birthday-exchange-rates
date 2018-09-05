<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    </head>
    <body>
        <div class="container">
            <div class="card my-3">
                <div class="card-body">
                    <h5 class="card-title">{{ config('app.name', 'Laravel') }}</h5>
                    <p class="card-text">Select the date of your previous birthday to discover the historical EUR to {{ config('app.EXCHANGE_CURRENCY', 'SEK') }} exchange rate.  Please note that the date range is limited to the last year.</p>
                    <div class="form-group mt-4">
                        <label for="datetimepicker" class="sr-only">Date</label>
                        <div id="datetimepicker"></div>
                    </div>
                    <button type="button" class="btn btn-primary btn-block" id="btn_exchange_rate">Get Birthday Exchange Rate</button>
                </div>
            </div>
            <div class="card my-3">
                <div class="card-body">
                    <h5 class="card-title mb-0">Previous Results</h5>
                </div>
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Birthday</th>
                            <th class="text-right">Exchange Rate</th>
                        </tr>
                    </thead>
                    <tbody id="rates">
                        @if($birthdays->count() == 0)
                        <tr id="empty-row">
                            <td colspan="2" class="text-center">There are currently no saved exchange rates</td>
                        </tr>
                        @endif
                        @foreach ($birthdays as $birthday)
                        <tr>
                            <td data-date="{{ $birthday->birthday }}">{{ date_format(DateTime::createFromFormat('Y-m-d', $birthday->birthday), 'jS F Y') }}@if($birthday->search_count > 1) <span class="badge badge-success">{{ $birthday->search_count }}</span>@endif</td>
                            <td class="text-right">{{ $birthday->exchange_rate }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment-with-locales.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
        <script type="text/javascript" src="{{ asset('js/hullabaloo.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
