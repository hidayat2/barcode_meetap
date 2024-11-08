<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ID CARD</title>


    <style>
	 h1 {
		text-align:center;
        }
	</style>

</head>
<body class="">
    <div class="">
      <h1 style="font-size:60pt">Meet Ap</h1>
        <div class="text-align:center">
          <img style="" width="150px" height="150px" src="data:image/png;base64,{{ $qr_code }}" alt="" />
        </div>

        <table style="margin: top 60px; width:100%; font-size:16pt;">
            <tr>
                <td style="width:20%">&nbsp;</td>
                <td style="width:20%">nama</td>
                <td style="width:60%">{{ $participant->name }}</td>
            </tr>

            <tr>
                <td>&nbsp;</td>
                <td>Email</td>
                <td>{{ $participant->email }}</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>No Hp</td>
                <td>{{ $participant->phone }}</td>
            </tr>

        </table>
    </div>
    </body>
    </html>
