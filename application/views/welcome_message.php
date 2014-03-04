
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>whooing example</title>

    <!-- Bootstrap core CSS -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        body {
            padding-top: 50px;
            padding-bottom: 20px;
        }
    </style>
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
                <h1>Rest of API : <?php echo $this->rest_of_api ?></h1>
            </div>
        </div>
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

        <div class="row">
            <div class="col-md-12">
                <h2>Latest Entries Example</h2>
                <table id='latest-entries' class='table table-bordered'>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Item(Detail)</th>
                            <th>Money</th>
                            <th>Debit</th>
                            <th>Credit</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
                <a id="btn-more" href="javascript:;" class="btn btn-block btn-info btn-lg">More</a>
                <script>
                    $(function(){
                        $('#btn-more').on('click', function(){
                            $(this).fadeOut();
                            $.get('<?php echo site_url('welcome/get_latest') ?>', {
                                'max' : $('#latest-entries > tbody > tr:last').data('entry_id')
                            }).done(function(responseHTML){
                                if(responseHTML==''){
                                    alert('더 이상 내용이 없습니다.');
                                    return;
                                }
                                $('#latest-entries > tbody').append(responseHTML);
                                $('#btn-more').show();
                            });
                        }).triggerHandler('click');
                    });
                </script>
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
