<?php 
    session_start();
    include 'session.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Invoice Generator</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Datatable CSS AND JS CDN -->

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="buttons.html5.min.js"></script>
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/fancybox/lib/jquery.mousewheel.pack.js"></script>
    <link rel="stylesheet" href="/fancybox/source/jquery.fancybox.css?v=2.1.7" type="text/css" media="screen" />
    <script type="text/javascript" src="/fancybox/source/jquery.fancybox.pack.js?v=2.1.7"></script>
    <link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
    <script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
    <script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
    <!-- <script src="bootstable.js" ></script> -->
    <link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
    <script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
</head>

<body>
    <!-- <h1 style="text-align: center;">Invoice Generator</h1> -->
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="img/cpc-LOGO.png" alt="CPC LOGO" align="center">
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="#"  class="sidebarlink" onclick="generateinvoice()">Generate Invoice</a>
                </li>
                <li>
                   <a href="#" class="sidebarlink" onclick="productdetail()">Product Master</a>
                </li>
                <li>
                    <a href="#" id="stockupdate" class="sidebarlink" onclick="stockupdate()">Stock Update</a>
                </li>
                <li>
                    <a href="#" class="sidebarlink" onclick="showreport()">Daily Report</a>
                </li>
                <li>
                    <a href="#" class="sidebarlink" onclick="getreport()">Report Master</a>
                </li>
                <li>
                    <a href="#" class="sidebarlink" onclick="customerdetail()">Customer Master</a>
                </li>
                <li>
                    <a href="#" class="sidebarlink" onclick="showinvoice()">Invoice Master</a>
                </li>
                <li>
                    <a href="#" class="sidebarlink" onclick="categorydetail()">Category Master</a>
                </li>
                <li>
                    <a href="#" class="sidebarlink" onclick="generatebarcode()">Generate Bar Code</a>
                </li>
                <li>
                    <a href="logout.php" class="sidebarlink" onclick="logout()">Logout</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin: auto;">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <!-- <span>Toggle Sidebar</span> -->
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" id="navigateSidebar">
                        <i class="fas fa-align-justify"></i>
                    </button>
                    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <h1 style="margin: auto;text-align: center;">Invoice Generator</h1>
                        <h4 style="float: right;margin: 0px">Welcome <?php echo $_SESSION['userid']; ?></h4> 
                        <ul class="nav navbar-nav ml-auto" id="navigationbar">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="loginnav" href="login.php">Login/Signup</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav><br><br>
            <p id="getid" style="display: none;">
                        Enter Invoice ID:<br>
                        <input type="number" value="" id="getinvoiceid" class="numericvalidation col-md-6" placeholder="">
                        <input type="button" name="invoice" value="Submit" id="getinvoice"><br><br><br>
                    </p>
                    <p id="getdate" style="display: none;">
                        Enter Date to generate report:<br>
                        <input type="date" name="" value="" id="dateofpurchase" placeholder="" class="col-md-6">
                        <input type="button" name="date" value="Submit" id="getreport">
                        <br><br><br>
                    </p>
                    <p id="getdates" style="display: none;">
                        Enter initial date :<br>
                        <input type="date" name="" value="" id="dateofpurchase1" placeholder="" class="col-md-6"><br>
                        Enter final date :<br>
                        <input type="date" name="" value="" id="dateofpurchase2" placeholder="" class="col-md-6"><br>
                        <input type="button" name="date" value="Submit" id="getfinalreport">
                        <br><br><br>
                    </p>
                    <p id="showresult"></p>
                    <p id="showamount"></p>
        </div>
    </div>

    <script type="text/javascript" src="sample.js">
    </script>
    <script type="text/javascript">
    </script>
    <?php 
        if (isset($_SESSION['userid'])) {
            ?>
            <script>
                document.getElementById('loginnav').style.display="none";
                var element = document.getElementById('navigationbar');
                element.remove();
            </script>
            <?php
        }
    ?>
</body>
<!-- Footer -->
<footer class="page-footer font-small blue">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3" style="background-color: #eeeeee">© 2018 Copyright:
    <a href="http://www.codepotatoinc.com/projects/cpc/"> CodePotato INC</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
</html>