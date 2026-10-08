<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="wa-theme-default wa-palette-default wa-brand-blue">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="https://ka-f.webawesome.com/webawesome@3.0.0/styles/webawesome.css">
        <script type="module" src="https://ka-f.webawesome.com/webawesome@3.0.0/webawesome.loader.js"></script>

        <style>
            main {
                width: min(100% - 2rem, 1000px);
                margin: 2rem auto;
            }

            .table-wrap {
                overflow: hidden;
                border: 1px solid #e5e7eb;
                border-radius: 6px;
            }
        </style>
    </head>
    <body>
        <main>
            <section>
                <h1>
                    Simple WebAwesome Page
                </h1>

                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vitae nibh vel augue finibus luctus.
                </p>

                <p>
                    Sed posuere, neque nec facilisis luctus, justo risus cursus eros, vitae tincidunt urna justo at ipsum.
                </p>
            </section>

            <section>
                <div class="table-wrap">
                    <table class="wa-native">
                        <thead>
                            <tr>
                                <th scope="col">Item</th>
                                <th scope="col">Status</th>
                                <th scope="col">Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Alpha</td>
                                <td><wa-badge variant="success">Ready</wa-badge></td>
                                <td>12</td>
                            </tr>
                            <tr>
                                <td>Beta</td>
                                <td><wa-badge variant="warning">Pending</wa-badge></td>
                                <td>8</td>
                            </tr>
                            <tr>
                                <td>Gamma</td>
                                <td><wa-badge variant="neutral">Draft</wa-badge></td>
                                <td>5</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </body>
</html>
