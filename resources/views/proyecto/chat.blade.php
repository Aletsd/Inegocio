
    <!--chat Row -->

    @foreach ($conversacion as $mensaje)

        @if ($mensaje->emisor_id == Auth::user()->id)
          @if ($mensaje->tipo == 'texto')
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
                    <div class="box bg-light-info text-success">{{$mensaje->mensaje}}.</div>
                    <div class="chat-time">{{$mensaje->created_at}}</div>
                </div>
            </li>
          @endif
        @endif
        @if ($mensaje->emisor_id == $emisor_id)
          @if ($mensaje->tipo == 'texto')
          <li class="reverse @if ($mensaje->visto == null) bg-light @endif">
              <div class="chat-content">
                  <h5>{{$mensaje->emisor->nombres}}</h5>
                  <div class="box bg-light-inverse">{{$mensaje->mensaje}}</div>
                  <div class="chat-time">{{$mensaje->created_at}}</div>
              </div>
              <div class="chat-img"><img src="{{empty ($mensaje->emisor->img_perfil) ? '/assets/img/default.jpg' : 'https://inegociotestbucket.s3-us-east-2.amazonaws.com/'.$mensaje->emisor->img_perfil}}" alt="user"></div>
          </li>
          @elseif ($mensaje->tipo == 'archivo')
            <li class="reverse @if ($mensaje->visto == null) bg-light @endif">
                <div class="chat-content">
                    <h5>{{$mensaje->emisor->nombres}}</h5>
                    <div class="box bg-light-inverse text-success">{{$mensaje->mensaje}}</div>
                    <div class="chat-time">{{$mensaje->created_at}}</div>
                </div>
                <div class="chat-img"><img src="{{empty ($mensaje->emisor->img_perfil) ? '/assets/img/default.jpg' : 'https://inegociotestbucket.s3-us-east-2.amazonaws.com/'.$mensaje->emisor->img_perfil}}" alt="user"></div>
            </li>
          @endif
        @endif

    @endforeach
