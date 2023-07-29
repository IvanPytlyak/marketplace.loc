<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Symfony\Component\Mime\Part\DataPart;
use Telegram\Bot\Laravel\Facades\Telegram;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Mime\Part\Multipart\FormDataPart;
use Symfony\Component\HttpClient\Exception\ClientException;

class TelegramController extends Controller
{
    private const API = 'https://api.telegram.org/bot';
    private const SEND_MESSAGE = 'sendMessage';
    private const GET_UPDATES = 'getUpdates';
    private const SEND_DOCUMENT = 'sendDocument'; //TG API
    private const SEND_PHOTO = 'sendPhoto';
    private const SEND_AUDIO = 'sendAudio';

    private string $token;
    private HttpClientInterface $httpClient;

    public function sendMessage(Request $request)
    {
        $name = $request->input('review_name');
        $phone = $request->input('review_phone');
        $email = $request->input('review_email');
        $description = $request->input('review_description');
        $token = env('TELEGRAM_BOT_TOKEN');
        $chatId = '1123756923';
        // dd($chatId, $token);
        $text = "Имя: $name\nНомер телефона: $phone\nEmail: $email\nСообщение: $description";
        Telegram::bot(env('TELEGRAM_BOT_TOKEN'))->sendMessage([
            'chat_id' => $chatId,
            'text' => $text
        ]);
        // return response()->json([
        //     'name' => 'send to telegram',
        //     'phone' => 'send to telegram',
        //     'email' => 'send to telegram',
        //     'description' => 'send to telegram',
        // ]);
        return redirect()->route('index');
    }





































    // public function __construct(string $token)
    // {
    //     $this->token = $token;
    //     $this->httpClient = HttpClient::create();
    // }

    // public function getUpdates(): array
    // {
    //     $response = $this->httpClient->request(
    //         Request::METHOD_GET,
    //         self::API . $this->token . '/' . self::GET_UPDATES
    //     );

    //     return $response->toArray();
    // }




    // public function sendMessage(int $chatId, string $text): array
    // {
    //     $url = 'https://api.telegram.org/bot' . $this->token . '/sendMessage';
    //     $params = ['chat_id' => $chatId, 'text' => $text,];
    //     // $response = $this->httpClient->request(Request::METHOD_POST, $url, ['form_params' => $params]);
    //     $response = $this->httpClient->request(Request::METHOD_POST, $url, ['headers' => ['Content-Type' => 'application/x-www-form-urlencoded',], 'body' => http_build_query($params),]);
    //     // return $response->toArray();
    //     return $response->toArray();
    // }

    // public function telegram()
    // {
    //     $telegramBotClient = new TelegramController('6007033888:AAHd2EEPqBS_LrZCUsMC5W5hX2R9I3SNECQ');
    //     $name = $_POST['review_name'];
    //     $phone = $_POST['review_phone'];
    //     $email = $_POST['review_email'];
    //     $description = $_POST['review_description'];
    //     $chatId = '975008471';
    //     $text = "Имя: $name\nНомер телефона: $phone\nEmail: $email\nСообщение: $description";
    //     $response = $telegramBotClient->sendMessage($chatId, $text);
    //     return view('index');
    // }














    // private const API = 'https://api.telegram.org/bot';
    // private const SEND_MESSAGE = 'sendMessage';
    // private string $token;
    // private HttpClientInterface $httpClient;
    // public function __construct(string $token)
    // {
    //     $this->token = $token;
    //     $this->httpClient = HttpClient::create();
    // }
    // public function sendMessage(int $chatId, string $text): array
    // {
    //     $url = self::API . $this->token . '/' . self::SEND_MESSAGE;
    //     $params = ['chat_id' => $chatId, 'text' => $text];
    //     $response = $this->httpClient->request(Request::METHOD_POST, $url, ['headers' => ['Content-Type' => 'application/x-www-form-urlencoded',], 'body' => http_build_query($params),]);
    //     return $response->toArray();
    // }
    // public function telegram(Request $request)
    // {
    //     $name = $request->input('review_name');
    //     $phone = $request->input('review_phone');
    //     $email = $request->input('review_email');
    //     $description = $request->input('review_description');
    //     $chatId = '975008471';
    //     $text = "Имя: $name\nНомер телефона: $phone\nEmail: $email\nСообщение: $description";
    //     $response = $this->sendMessage($chatId, $text);
    //     return view('index');
    // }

















    // public function sendMessage(
    //     int $chatId,
    //     string $text
    // ): array {
    //     $response = $this->httpClient->request(
    //         Request::METHOD_GET,
    //         self::API . $this->token . '/' . self::SEND_MESSAGE . '?chat_id=' . $chatId . '&text=' . $text,
    //     );

    //     return $response->toArray();
    // }


    // public function sendMessage(Request $request)
    // {
    //     $chatId = '6007033888:AAHd2EEPqBS_LrZCUsMC5W5hX2R9I3SNECQ';
    //     $text = "Имя: " . $request->input('review_name') . "\n" . "Номер телефона: " . $request->input('review_phone') . "\n" . "Email: " . $request->input('review_email') . "\n" . "Сообщение: " . $request->input('review_description');
    //     $response = $this->httpClient->request(Request::METHOD_POST, self::API . $this->token . '/' . self::SEND_MESSAGE . '?chat_id=' . $chatId . '&text=' . urlencode($text));
    //     $statusCode = $response->getStatusCode();
    //     if ($statusCode !== 200) {
    //         throw new \Exception('Telegram API returned status code: ' . $statusCode);
    //     }
    //     $content = $response->getContent();
    //     $responseData = json_decode($content, true);
    //     if (!$responseData['ok']) {
    //         throw new \Exception('Telegram API response error: ' . $responseData['description']);
    //     }
    //     return view('index');
    // }








    // public function sendDocument(string $chatId, string $filePath)
    // {
    //     $formFields = [
    //         'chat_id' => $chatId,
    //         'document' => DataPart::fromPath($filePath),
    //     ];
    //     $formData = new FormDataPart($formFields);

    //     $response = $this->httpClient->request(
    //         Request::METHOD_POST,
    //         $this->getUri(self::SEND_DOCUMENT),
    //         // self::API . $this->token . '/' . self::SEND_DOCUMENT, // = строка 62
    //         [
    //             'headers' => $formData->getPreparedHeaders()->toArray(),
    //             'body' => $formData->bodyToIterable(),
    //         ]
    //     );

    //     return $response->toArray();
    // }

    // private function getUri(string $telegramMethod): string
    // {
    //     return self::API . $this->token . '/' . $telegramMethod;
    // }



    // public function sendPhoto(string $chatId, string $photoPath)
    // {
    //     $formFields = [
    //         'chat_id' => $chatId,
    //         'photo' => DataPart::fromPath($photoPath),
    //     ];
    //     $formData = new FormDataPart($formFields);
    //     $response = $this->httpClient->request(
    //         Request::METHOD_POST,
    //         $this->getUri(self::SEND_PHOTO),
    //         [
    //             'headers' => $formData->getPreparedHeaders()->toArray(),
    //             'body' => $formData->bodyToIterable(),
    //         ]
    //     );
    //     return $response->toArray();
    // }

    // public function sendAudio(string $chatId, string $audioPath)
    // {
    //     $formFields = [
    //         'chat_id' => $chatId,
    //         'audio' => DataPart::fromPath($audioPath),
    //     ];
    //     $formData = new FormDataPart($formFields);
    //     $response = $this->httpClient->request(
    //         Request::METHOD_POST,
    //         $this->getUri(self::SEND_AUDIO),
    //         [
    //             'headers' => $formData->getPreparedHeaders()->toArray(),
    //             'body' => $formData->bodyToIterable(),
    //         ]
    //     );
    //     return $response->toArray();
    // }











    // public function telegram()
    // {
    //     $telegramBotClient = new TelegramController('6007033888:AAHd2EEPqBS_LrZCUsMC5W5hX2R9I3SNECQ');
    //     $name = $_POST['review_name'];
    //     $phone = $_POST['review_phone'];
    //     $email = $_POST['review_email'];
    //     $description = $_POST['review_description'];

    //     $chatId = '975008471';
    //     $text = "Имя: $name\nНомер телефона: $phone\nEmail: $email\nСообщение: $description";
    //     $response = $telegramBotClient->sendMessage($chatId, $text);
    //     return view('index');
    // }


}
