<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Post Form</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <a href="{{route('home')}}">Назад</a>

  <div class="container mt-4">
    <h2>Форма для отправки сообщения</h2>
    <form action="{{route('mail_send')}}" method="post">
        @csrf
      <div class="form-group">
        <label for="inputSubject">Тема</label>
        <input type="text" class="form-control" id="inputSubject" name="subject" required>
      </div>
      <div class="form-group">
        <label for="inputMessage">Сообщение</label>
        {{-- <input type="text" class="form-control" id="inputMessage" name="message" required> --}}
        <textarea class="form-control" id="inputMessage" name="message" rows="5" required></textarea>
      </div>
      <div class="form-group">
        <label for="inputEmails">Email's (разделенные запятыми)</label>
        <input type="text" class="form-control" id="inputEmails" name="emails" required>
        <small id="emailsHelp" class="form-text text-muted">Введите список email-ов через запятую, куда будет отправлено сообщение.</small>
      </div>
      <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
  </div>


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>