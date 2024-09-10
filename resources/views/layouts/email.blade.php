<!DOCTYPE html>
<html>

<head>
  <style>
    body {
      font-family: Arial, sans-serif;
      color: #333;
      margin: 0;
      padding: 0;
      background-color: #f8f8f8;
    }

    .container {
      width: 80%;
      max-width: 600px;
      margin: 40px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      color: #007bff;
      font-size: 24px;
      margin-bottom: 20px;
    }

    p {
      font-size: 16px;
      line-height: 1.6;
      margin: 0 0 10px;
    }

    .highlight {
      background-color: #e9ecef;
      padding: 10px;
      border-radius: 4px;
      font-weight: bold;
    }

    .footer {
      margin-top: 20px;
      font-size: 14px;
      color: #6c757d;
      text-align: center;
    }

    .img-fluid {
      max-width: 100%;
      height: auto;
      border-radius: 4px;
    }

    .w-50 {
      width: 50%;
    }

    .mb-3 {
      margin-bottom: 1rem;
    }
  </style>
</head>

<body>
  <div class="container">
    @yield('content')
    <p class="footer">Grazie per aver usato il nostro servizio.</p>
  </div>
</body>

</html>
