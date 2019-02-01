<style type="text/css">
  table,th,td {
    width: 100%;border:1px;border-style: solid;
    border-collapse: collapse;
  }
  #watermark
  {
     position:fixed;
     bottom:60%;
     left:30%;
     opacity:0.5;
     z-index:99;
     color:red;
     letter-spacing: 3px;
     font-size: 30px;
     -ms-transform: rotate(300deg);
    -webkit-transform: rotate(300deg); 
    -moz-transform: rotate(300deg);
    -o-transform: rotate(300deg);
    -sand-transform: rotate(300deg);
    transform: rotate(300deg);
  }
</style>
<body>
  <div id="watermark">REDBOX</div>
    <h1 align="center">RED Box</h1>
    <div> 
    <table>
      <thead>
        <tr style="text-align: center;">
          <th>ID</th>
          <th>Name</th>
          <th>Money</th>
          <th>Phone</th>
        </tr>
      </thead>
      <tbody>
     @foreach($result as $row)
          <tr>
            <td>{{ $row['users_id'] }}</td>
            <td>
              Name : {{ $row['user_name'] }}
              <br />
              Address : {{ $row['address'] }}
            </td>
            <td>
              @if($loop->last)
                --
              @else
                350
              @endif  
            </td>
            <td>{{ $row['mobile_no'] === null ? 'N / A' : $row['mobile_no']  }}</td>
          </tr>
     @endforeach
      </tbody>
    </table>
    </div>
</body>    