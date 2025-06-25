<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Stiker</title>
</head>
<style>
    @page {
        margin: 0px;
        size: auto;
    }

    body {
        margin-top: 1px;
        margin-left: 1px;
        margin-right: 1px;
        font-size: 8pt;
        font-weight: bold;
    }

    .container {
        margin-left: 15;
        margin-right: 10;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-style: :bold;
        scale: 100%;
    }

    #main {
        font-size: 7pt;
    }

    #footer {
        font-size: 5pt;
        margin-top: 10px;
    }

    .barcode {
        position: fixed;
        bottom: 10px;
        left: -10px;
        top: 5px;
        right: 0px;
        z-index: -10;
    }
</style>

<body>
    <div class="container">
        <table id="main" border="0" width="100%">
            <tbody>
                <tr>
                    <td style="width: 50px; height: 25px;"></td>
                    <td colspan=""></td>
                    <td colspan="">
                        {{ strlen($data->getRS->Nama) > 18 ? substr($data->getRS->Nama, 0, 18) . '..' : $data->getRS->Nama }}
                    </td>
                </tr>
                <tr>
                    <td rowspan="4" style="padding: 0; margin: 0;"></td>
                    <td></td>
                    <td>
                        <i
                            style="color: rgb(214, 29, 29)">{{ strlen($data->getItem->Nama) > 18 ? substr($data->getItem->Nama, 0, 18) . '..' : $data->getItem->Nama }}</i>
                    </td>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>{{ strlen($data->NoInventaris) > 18 ? substr($data->NoInventaris, 0, 18) . '..' : $data->NoInventaris }}
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>{{$data->getDepartemen->NamaDepartemen}} - {{$data->getUnit->NamaUnit}}
                    </td>
                </tr>

            </tbody>
        </table>

        <!-- Display the barcode -->
        <div class="barcode">
            <img src="data:image/png;base64,{{ $barcode[$data->id] }}" alt="barcode" width="85px" />
        </div>
    </div>

</body>

</html>