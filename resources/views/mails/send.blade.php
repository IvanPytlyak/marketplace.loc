<!DOCTYPE html> 
{{-- <html> 
    <head> 
        <title>Test Email</title> 
    </head> 
    <body> 
        <h1>Hello!</h1> 
        <p>This is a test email sent from Laravel using the Yandex SMTP with SSL.</p> 
    </body> 
</html> --}}

<html> 
    <head> 
        <title>{{$subject}}</title> 
    </head> 
    <body> 
        <h1>Hello!</h1> 
        <p>{{ $mailMessage }}</p> 
    </body> 
</html>