
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Jumbotron Template for Bootstrap</title>

    <!-- Custom styles for this template -->
    <link href="/css/whooing.css" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

    <body>
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <script src="http://code.highcharts.com/highcharts.js"></script>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">SampleSite</a>
            </div>
            <div class="navbar-collapse collapse">
                <form class="navbar-form navbar-right" role="form">
                    <?php if ($this->session->userdata('user_id')): ?>
                    <a href="<?php echo site_url('welcome/clear_oauth'); ?>" class="btn btn-success">Logout</a>
                    <?php else: ?>
                    <a href="<?php echo site_url('welcome/start_oauth'); ?>" class="btn btn-success">Sign in with whooing</a>
                    <?php endif ?>
                </form>
            </div><!--/.navbar-collapse -->
        </div>
    </div>


    <?php if ($this->session->userdata('user_id')): ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Balance Sheet Example</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <!-- bs-assets -->
                <?php echo $this->load->view('bs_assets_chart_view', array('rows'=> $bs['assets'], 'accounts'=>$accounts), FALSE); ?>
            </div>
            <div class="col-md-6">
                <!-- bs-liabilities -->
                <?php echo $this->load->view('bs_liabilities_chart_view', array('rows'=> $bs['liabilities'], 'accounts'=>$accounts), FALSE); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h2>Profit/Loss Example</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <!-- bs-assets -->
                <?php echo $this->load->view('pl_expenses_chart_view', array('rows'=> $pl['expenses'], 'accounts'=>$accounts), FALSE); ?>
            </div>
            <div class="col-md-6">
                <!-- bs-liabilities -->
                <?php echo $this->load->view('pl_income_chart_view', array('rows'=> $pl['income'], 'accounts'=>$accounts), FALSE); ?>
            </div>
        </div>
    </div>


    <?php else: ?>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1>Hello, world!</h1>
            <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
            <p>
                <a href="<?php echo site_url('welcome/start_oauth'); ?>" class="btn btn-primary btn-lg">Sign in with whooing</a>
            </p>
        </div>
    </div>

    <div class="container">
        <!-- Example row of columns -->
        <div class="row">
            <div class="col-md-4">
                <h2>Heading</h2>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
            </div>
            <div class="col-md-4">
                <h2>Heading</h2>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
            </div>
            <div class="col-md-4">
                <h2>Heading</h2>
                <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
            </div>
        </div>
    </div> <!-- /container -->
    <?php endif; ?>


    <div class="container">
        <hr>
        <footer>
            <p>&copy; Company 2014</p>
        </footer>
    </div>

  </body>
</html>
