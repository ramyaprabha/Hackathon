<!DOCTYPE html>
<html>

<head>
    <style>
        .button {
            position: relative;
            bottom: 2%;
            color: white;
            background-color: green;
            padding: 16px;
            border: 1px solid black;
            border-radius: 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            width: 100%;
            left: 5%;
            font-size: 16px;
            border: none;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            margin: 0px auto;
        }


        .button1 {
            position: relative;
            bottom: 2%;
            color: white;
            background-color: blue;
            padding: 16px;
            border: 1px solid black;
            border-radius: 1px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            width: 80%;
            left: 5%;
            font-size: 14px;
            border: none;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            margin: 0px auto;
        }
        
        .button:hover,
        .button:focus {
            background-color: lightgrey;
            color: black;
        }
        
        .dropdown {
            position: absolute;
            float: top;
            top: 35%;
            right: 2%;
        }
        
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            overflow: auto;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 3;
            right: 5%;
        }
        
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        
        .dropdown a:hover {
            background-color: #f1f1f1;
        }
        
        .show {
            display: block;
        }


        
            .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 3; /* Sit on top */
    padding-top: 70px; /* Location of the box */
    right: 50%;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

    </style>
</head>

<body>

    <div class="dropdown">
        <button onclick="myFunction()" style="vertical-align:middle" class="button">Did u feel it??? </button>
        <div id="myDropdown" class="dropdown-content">
            <h2>Unknown event!!!</h2>
            <p>
            Felt Report-Tell us!!
            </p>
            <button id="myBtn" style="vertical-align:middle" class="button1">Show Form</button>
        </div>
    </div>


<script>
var myWindow;

function openWin() {
    myWindow = window.open("", "", "width=100, height=100");
}
</script>

    <script>
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.button')) {

                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>



    <!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3>Felt reporting!!-Tell us</h3>
     <form method="post" action="phpfiles/front1.php">
            <label for="location">Location:</label><br>
            <input type="text" name="location" class="form-control input-md"><br>
            
            <label for="date">Date:</label><br>
            <input type="varchar" name="date" class="form-control input-md"><br>
            
            <label for="time">Time(hr/min/sec):  </label><br>
            <input type="varchar" name="time" class="form-control input-md"><br>
            
            <p>Additional comments:</p>
            <input type="text" name = "comment" class="form-control input-md"><br>
  
            <p>Contact Information(Optional):</p>
            <label for="details">Name:</label><br>
            <input type="text" name="name" class="form-control input-md"><br>
            
            <label for="phone">Phone:</label><br>
            <input type="varchar" name="phone" class="form-control input-md"><br>
            
            <label for="mail">Email:</label><br>
            <input type="varchar" name="mail" class="form-control input-md"><br>
            
            <button type="submit" value="Submit">Submit</button>
            </form>
  </div>

</div>

<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}






</script>


</body>

</html>