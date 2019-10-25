<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  @includeFirst(['icommerce.emails.style', 'icommerce::emails.base.style'])

</head>

<body>
<div id="body">
  <div id="template-mail">

    @includeFirst(['icommerce.emails.header', 'icommerce::emails.base.header'])



    {{-- ***** Order Content  ***** --}}
    <div id="contend-mail" class="p-3">

      {{-- ***** Title  ***** --}}
      <h3 class="text-center text-uppercase">
        Canjeo # {{$redeem->id}}
      </h3>

      <br>
      {{-- ***** Customer  ***** --}}
      <p class="px-3">
        <strong>El usuario {{$redeem->user->first_name}} {{$redeem->user->last_name}}, ha canjeado el siguiente artículo con sus puntos:</strong>
        <br>
      </p>

      <br>
      <br>

      <div style="margin-bottom: 5px">

        {{-- ***** Table Infor ***** --}}
        <table width="100%" style="margin-bottom: 15px">
          <th bgcolor="f5f5f5">Descripción</th>
          <th bgcolor="f5f5f5">Puntos utilizados</th>
          <tr>
            <td style="text-align:center;">
              {{$redeem->description}}<br>
            </td>
            <td style="text-align:center;">
              {{$redeem->points}}<br>
            </td>
          </tr>
        </table>

      </div>
    </div>
    {{-- ***** End Order Content  ***** --}}



    @includeFirst(['icommerce.emails.footer', 'icommerce::emails.base.footer'])


  </div>
</div>
</body>

</html>
