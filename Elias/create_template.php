<!DOCTYPE html>
<html lang="en">                    <!-- OPENING HTML TAG -->


<!-------------------------------->
<!--          HEAD              -->
<!-------------------------------->

<head>
    <title>Page Title - in chrome tab</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!------------------------------- >         These link to the div sections in the body:
    <--          STYLE              -->
    <!------------------------------- >         body / .header / .header h1 / navbar / row / side / footer etc. -->

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<style>
        #grad {
        /*height: 55px; */
        /*background-color: white; /* For browsers that do not support gradients */
        background-image: linear-gradient(lightgray, white);
        }
        #grad1 {
        /*height: 55px; */
        /*background-color: white; /* For browsers that do not support gradients */
        background-image: linear-gradient(grey, lightgray);
        }
</style>
    
</head>


<!-------------------------------->
<!--          BODY              -->
<!-------------------------------->

<body>


    <nav class="navbar navbar-inverse">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="WireFrame00.php">HappyTech HR</a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="WireFrame33.php">Feedback</a></li>
              <li class="active"><a href="#">Templates</a></li>
              <li><a href="WireFrame22.php">Roles</a></li>
              
            </ul>
          </div><!--/.nav-collapse -->
        </div>
    </nav>

    
    </div>

    <div class="container theme-showcase" role="main">


                                <!-- Main jumbotron   -->
        <div class="jumbotron">
            <h3 style="text-align:center">Template Builder</h3>
        
        </div>

        <div class="page-header">
            <h5><em>Select elements to build a template..</em></h5>
        </div>
    
        <div style="text-align:center" class="col-md-2">
            <button type="button" class="btn btn-primary" onclick="addSetText()">Set Text</button>
        </div>
        <div style="text-align:center" class="col-md-2">
            <button type="button" class="btn btn-primary" onclick="addFreeText()">Free Text</button>
        </div>
        <div style="text-align:center" class="col-md-2">
            <button type="button" class="btn btn-primary" onclick="addCheckBox()">Check-box </button>
        </div>
        <div style="text-align:center" class="col-md-2">
            <button type="button" class="btn btn-primary" onclick="addRadio2()">Radio Button x2</button>
        </div>
        <div style="text-align:center" class="col-md-2">
            <button type="button" class="btn btn-primary">Radio Button x3</button>
        </div><br>
        <div style="text-align:right" class="col-md-2">
            <button type="button" class="btn btn-success">Save</button>
        </div><br>

        <div class="page-header">
            <h5><em>Add Text to customise template..</em></h5>
        </div>

        <div id="cont">
            <div class="col-md-8">Text</div>
            <div class="col-md-2">Type</div>
            <div class="col-md-2">Remove</div>
            <br><br>

            <!--    CONTAINER FOR DYNAMIC ELEMENTS  -->

        </div>

    </div>


</body>


<script type="text/javascript" src="temp_builder.js"></script>



</html>                             <!-- CLOSING HTML TAG -->





<!-- <div class="container">
//             <div class="container">
//                 <div class="row">
//                     <div class="col-md">
//                         <img data-src="holder.js/200x200" src="bulletList.png" class="img-thumbnail" alt="A generic square placeholder image with a white border around it, making it resemble a photograph taken with an old instant camera">
//                         <h3> Give Feedback </h3>
//                     </div>
//                     <div class="col-md">
//                         <img data-src="holder.js/200x200" src="bulletList.png" class="img-thumbnail" alt="A generic square placeholder image with a white border around it, making it resemble a photograph taken with an old instant camera">
//                         <h3> Select Template </h3>
//                     </div>
//                     <div class="col-md">
//                         <img data-src="holder.js/200x200" src="bulletList.png" class="img-thumbnail" alt="A generic square placeholder image with a white border around it, making it resemble a photograph taken with an old instant camera">
//                         <h3> Roles / Candidates </h3>
//                     </div>
//                 </div>
//             </div>
      
//         </div> -->