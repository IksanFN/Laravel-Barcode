<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>Laravel Barcode Generator</title>
        <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.min.js"></script>
    </head>
    <body>
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Barcode</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $key => $product)
                            <tr>
                                <th scope="row">{{ ++$key }}</th>
                                {{-- <td>{!! DNS1D::getBarcodeHTML($product->link, 'C39') !!}</td> --}}
                                <td>{!! QrCode::size(150)->generate($product->link) !!}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ Str::limit($product->description, 50, '...') }}</td>
                                <td><a href="{{ route('show', $product->id) }}" class="btn btn-primary">Show</a></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No data available</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="{{ route('generate-qrcode') }}" method="POST">
                        @csrf
                        <input type="text" name="name" class="form-control mb-2" placeholder="Product Name">
                        <input type="text" name="price" class="form-control mb-2" placeholder="Price">
                        <button class="btn btn-primary" type="submit">Generate</button>
                    </form>
                </div>
            </div> --}}
            <div class="row justify-content-center">
            <div class="col-md-6 text-end">
                <div class="card border-0 shadow p-3">
                    <div class="card-body">
                        <div id="qr-reader" style="width:500px;" class="mx-auto"></div>
                        <div id="qr-reader-results"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow p-3">
                    <div class="card-body">
                        <form action="{{ route('generate-qrcode') }}" method="POST">
                            @csrf
                            <input type="text" name="name" class="form-control mb-2" placeholder="Product Name">
                            <input type="text" name="price" class="form-control mb-2" placeholder="Price">
                            <input type="text" name="description" class="form-control mb-3" placeholder="Deskripsi">
                            <button class="btn btn-primary" type="submit">Generate</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>


        {{-- <video id="video" width="300" height="200"></video>
        <canvas id="canvas" style="display: none;"></canvas>
        <div id="output"></div> --}}

        <script>

        function docReady(fn) {
        // see if DOM is already available
        if (document.readyState === "complete"
            || document.readyState === "interactive") {
            // call on next available tick
            setTimeout(fn, 1);
        } else {
                document.addEventListener("DOMContentLoaded", fn);
            }
        }

        docReady(function () {
            var resultContainer = document.getElementById('qr-reader-results');
            var lastResult, countResults = 0;
            function onScanSuccess(decodedText, decodedResult) {
                if (decodedText !== lastResult) {
                    ++countResults;
                    lastResult = decodedText;
                    // Handle on success condition with the decoded message.
                    // console.log(Scan result ${decodedText}, decodedResult);
                    // console.log(`Scan result ${decodedText, decodedResult}`);
                    window.location.href = decodedResult.decodedText;

                    // membersihkan scan area ketika sudah menjalankan 
                    // action diatas
                    html5QRCodeScanner.clear();
                    
                }
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    });


    //     const video = document.getElementById('video');
    //   const canvas = document.getElementById('canvas');
    //   const outputDiv = document.getElementById('output');
    //   const constraints = { video: { facingMode: 'environment' } };

    //   navigator.mediaDevices.getUserMedia(constraints)
    //     .then(function(stream) {
    //       video.srcObject = stream;
    //       video.setAttribute('playsinline', true);
    //       video.play();
    //       requestAnimationFrame(tick);
    //     })
    //     .catch(function(error) {
    //       console.error(error);
    //     });

    //     function tick() {
    //         if (video.readyState === video.HAVE_ENOUGH_DATA) {
    //         canvas.width = video.videoWidth;
    //         canvas.height = video.videoHeight;
    //         const ctx = canvas.getContext('2d');
    //         ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
    //         const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
    //         const code = =jsQR(imageData.data, imageData.width, imageData.height);
    //         if (code) {
    //             outputDiv.innerHTML = code.data;
    //         }
    //         }
    //         requestAnimationFrame(tick);
    //     }


    //     var videoSelect = document.querySelector('select#videoSource');

    //     navigator.mediaDevices.enumerateDevices()
    //     .then(gotDevices).then(getStream).catch(handleError);

    //     videoSelect.onchange = getStream;

    //     function gotDevices(deviceInfos) {
    //     for (var i = deviceInfos.length - 1; i >= 0; --i) {
    //         var deviceInfo = deviceInfos[i];
    //         var option = document.createElement('option');
    //         option.value = deviceInfo.deviceId;
    //         if (deviceInfo.kind === 'videoinput') {
    //         option.text = deviceInfo.label || 'camera ' +
    //             (videoSelect.length + 1);
    //         videoSelect.appendChild(option);
    //         } else {455
    //         console.log('Found one other kind of source/device: ', deviceInfo);
    //         }
    //     }
    //     }

    //     function getStream() {
    //     buttonGo.disabled = false;
    //     if (window.stream) {
    //         window.stream.getTracks().forEach(function(track) {
    //         track.stop();
    //         });
    //     }

    //     var constraints = {
    //         video: {
    //         deviceId: {exact: videoSelect.value}
    //         }
    //     };

    //     navigator.mediaDevices.getUserMedia(constraints).
    //         then(gotStream).catch(handleError);
    //     }

    //     function gotStream(stream) {
    //     window.stream = stream; // make stream available to console
    //     videoElement.srcObject = stream;
    //     }

    //     function handleError(error) {
    //     console.log('Error: ', error);
    //     }



    //     let html5QRCodeScanner = new Html5QrcodeScanner(
    //     // target id dengan nama reader, lalu sertakan juga 
    //     // pengaturan untuk qrbox (tinggi, lebar, dll)
    //     "reader", {
    //         fps: 10,
    //         qrbox: {
    //             width: 200,
    //             height: 200,
    //         },
    //     }
    // );

    // // function yang dieksekusi ketika scanner berhasil
    // // membaca suatu QR Code
    // function onScanSuccess(decodedText, decodedResult) {
    //     // redirect ke link hasil scan
    //     window.location.href = decodedResult.decodedText;

    //     // membersihkan scan area ketika sudah menjalankan 
    //     // action diatas
    //     html5QRCodeScanner.clear();
    // }

    // // render qr code scannernya
    // html5QRCodeScanner.render(onScanSuccess);
        </script>
        
        <!-- JavaScript Libraries -->
        <script src="{{ asset('html5-qrcode.min.js') }}"></script>
        <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
