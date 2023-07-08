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

    <div class="tg_wrapper">
        <form method="post"  action="{{route('send_tg_messages')}}">
            @csrf
            <input type="text" name="review_name" placeholder="Имя">
            <input type="text" name="review_phone" placeholder="Телефон">
            <input type="email" name="review_email" placeholder="Email">
            <textarea name="review_description" placeholder="Описание"></textarea>
            <button type="submit">Отправить</button>
        </form>
    </div>



    