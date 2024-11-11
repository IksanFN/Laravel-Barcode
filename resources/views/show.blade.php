<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>Laravel Barcode Generator</title>
    </head>
    <body>
        <div class="container py-5">
            <div class="row justify-content-center my-auto">
                <div class="col-md-12 my-auto">
                    <div class="card border-0 shadow p-3">
                        <div class="card-body">
                            {{-- <h1 class="text-center my-auto">{!! QrCode::size(256)->generate($product->description) !!}</h1> --}}
                            <h3>{{ $product->name }}</h3>
                            <h4>{{ number_format($product->price) }}</h4>
                            <p>{{ $product->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>