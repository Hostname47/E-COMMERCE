<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        echo <<<EOS
            SERVER_SIGNATURE: Apache/2.4.46 (Win64) OpenSSL/1.1.1g PHP/7.4.11 Server at localhost Port 443
            SERVER_SOFTWARE: Apache/2.4.46 (Win64) OpenSSL/1.1.1g PHP/7.4.11 
            SERVER_NAME: localhost 
            SERVER_ADDR: ::1 
            SERVER_PORT: 443 
            REMOTE_ADDR: ::1 
            DOCUMENT_ROOT: C:/xampp/htdocs 
            REQUEST_SCHEME: https
            GATEWAY_INTERFACE: CGI/1.1
            SERVER_PROTOCOL: HTTP/1.1
        EOS;
    ?>
</body>
</html>