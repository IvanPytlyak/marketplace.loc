{{-- 
// require_once('./vendor/autoload.php');

// use service\TelegramController;

// $telegramBotClient = new TelegramController('6007033888:AAHd2EEPqBS_LrZCUsMC5W5hX2R9I3SNECQ');

// $name = $_POST['review_name'];
// $phone = $_POST['review_phone'];
// $email = $_POST['review_email'];
// $description = $_POST['review_description'];

// $chatId = '6007033888:AAHd2EEPqBS_LrZCUsMC5W5hX2R9I3SNECQ';
// $text = "Имя: $name\nНомер телефона: $phone\nEmail: $email\nСообщение: $description";
// $response = $telegramBotClient->sendMessage($chatId, $text);

// header('location: /resources/views/master.blade.php');
// exit;
// --}}

    {{-- <div class="tg_wrapper">
        <form method="post"  action="{{route('send_tg_messages')}}">
            @csrf
            <input type="text" name="review_name" placeholder="Имя">
            <input type="text" name="review_phone" placeholder="Телефон">
            <input type="email" name="review_email" placeholder="Email">
            <textarea name="review_description" placeholder="Описание"></textarea>
            <button type="submit">Отправить</button>
        </form>
    </div> --}}

    {{-- <div class="container"> 
        <div class="row"> 
            <div class="col-md-8 offset-md-2"> 
                <div class="card chat-card"> 
                    <div class="card-body"> 
                        <form method="post" action="{{ route('send_tg_messages') }}"> 
                            @csrf 
                            <div class="form-group"> 
                                <input type="text" class="form-control" name="review_name" placeholder="Имя"> 
                            </div> 
                            <div class="form-group"> 
                                <input type="text" class="form-control" name="review_phone" placeholder="Телефон"> 
                            </div> 
                            <div class="form-group"> 
                                <input type="email" class="form-control" name="review_email" placeholder="Email"> 
                            </div> 
                            <div class="form-group"> 
                                <textarea class="form-control" name="review_description" placeholder="Описание"></textarea> 
                            </div> 
                            <button type="submit" class="btn btn-primary">Отправить</button> 
                        </form> 
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> --}}

    <div class="wrapper-container">
        <div class="chat-container">
          <div class="chat">
            <div class="chat-messages">
               <h4>Форма для обратной связи</h4> 
            </div>
            <div class="chat-input">
              <form method="post" action="{{ route('send_tg_messages') }}">
                @csrf
                <input type="text" class="form-control" name="review_name" placeholder="Имя">
                <input type="text" class="form-control" name="review_phone" placeholder="Телефон">
                <input type="email" class="form-control" name="review_email" placeholder="Email">
                <textarea id="textarea_tg" class="form-control" name="review_description" placeholder="Описание"></textarea>
                <button type="submit" class="btn btn-primary">Отправить</button>
              </form>
            </div>
          </div>
        </div>
      </div>