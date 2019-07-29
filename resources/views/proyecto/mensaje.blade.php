@if ($mensaje->tipo == 'text')
  <li>
    <div class="chat-img"><img src="{{empty ($mensaje->emisor->img_perfil) ? '/assets/img/default.jpg' : 'https://inegociotestbucket.s3-us-east-2.amazonaws.com/'.$mensaje->emisor->img_perfil}}" alt="user"></div>
    <div class="chat-content">
      <h5>{{$mensaje->emisor->nombres}}</h5>
      <div class="box bg-light-info">{{$mensaje->mensaje}}.</div>
      <div class="chat-time">{{$mensaje->created_at}}</div>
    </div>
  </li>
@elseif ($mensaje->tipo == 'archivo')
  <li>
    <div class="chat-img"><img src="{{empty ($mensaje->emisor->img_perfil) ? '/assets/img/default.jpg' : 'https://inegociotestbucket.s3-us-east-2.amazonaws.com/'.$mensaje->emisor->img_perfil}}" alt="user"></div>
    <div class="chat-content">
      <h5>{{$mensaje->emisor->nombres}}</h5>
      <div class="box bg-light-success">{{$mensaje->mensaje}}.</div>
      <div class="chat-time">{{$mensaje->created_at}}</div>
    </div>
  </li>
@endif
