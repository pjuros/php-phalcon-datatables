<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Phalcon PHP + Datatables</title>
        <meta name="description" content="Phalcon PHP and datatables demo site">
		<meta name="author" content="petar.juros@gmail.com">
        <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    </head>
    <body>
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Phalcon PHP + Datatables</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
        		<li><a href="https://github.com/pjuros/php-phalcon-datatables">Github - pjuros/php-phalcon-datatables</a></li>
        	</ul>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>
    
    <div class="container">
    	{{ content() }}
    </div>
    
    </body>
</html>
