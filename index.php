<!doctype html>
<html>
<head>
 
   <meta name="robots" content="noindex,nofollow">
   <title>AJAX Pet Adoption Agency</title>
   <style>
        @import url('https://fonts.googleapis.com/css2?family=Balsamiq+Sans&family=Fredoka+One&display=swap');


       #myForm div{
        margin-bottom:2%;
        }

        .petName {
          background-color: #EEBB4D;
          font-size: 20px;}

   </style>
   <script src="https://code.jquery.com/jquery-latest.js"></script>
   
</head>
<body>
<h2>AJAX Pet Adoption Agency</h2>
<div id="output">
<p>In this page, I demonstrate a way to use jQuery AJAX to make an pet adoption agency. In here, jQuery uses data from the user and allow to perform some functions. In this case, to choose the right pet for yourself. Enjoy.</p>
<p>Choose a pet below</p>
<form id="myForm" action="" method="get">

   <div id="pet_feels">
       <h3>Feels</h3>
       <p>Please choose how you would like your pet to feel:</p>
       <input type="radio" name="feels" value="fluffy" required="required">fluffy <br />
       <input type="radio" name="feels" value="scaly">scaly <br />
   </div>
   <div id="pet_likes">
       <h3>Likes</h3>
       <p>Please tell us what your pet will like:</p>
       <input type="radio" name="likes" value="petted" required="required">to be petted <br />
       <input type="radio" name="likes" value="ridden">to be ridden <br />
   </div>
    <div id="pet_eats">
       <h3>Eats</h3>
       <p>Please tell us what your pet likes to eat:</p>
       <input type="radio" name="eats" value="carrots" required="required">carrots <br />
       <input type="radio" name="eats" value="pets">other people's pets <br />
   </div>
    <div id="pet_name">
       <h3>Name</h3>
       <p>Please name your pet:</p>
       <input type="text" name="petName" placeholder="Name" required="required" />
   </div>
  
   <div><input type="submit" value="submit it!" /></div>
</form>
</div>
<p><a href="index.php">RESET</a></p>
<script>

    // titleCase function

    function titleCase(str){
      str = str.toLowerCase().split(' ');
      for (var i = 0; i < str.length; i++) {
        str[i] = str[i].charAt(0).toUpperCase() + str[i].slice(1);
      }
      return str.join(' ');
    };
  

    $("document").ready(function(){
        
        //hide likes and eats and name
        $('#pet_likes').hide();
        $('#pet_eats').hide();
        $('#pet_name').hide();

        //click feels and show likes
        $('#pet_feels').click(function(e){
          $('#pet_likes').slideDown(200);
        });

        //click likes and show eats
        $('#pet_likes').click(function(e){
          $('#pet_eats').slideDown(200);
        });

        
        //click eats and show name
        $('#pet_eats').click(function(e){
          $('#pet_name').slideDown(200);
        });




        $('#myForm').submit(function(e){
            e.preventDefault();//no need to submit as you'll be doing AJAX on this page
            let feels = $("input[name=feels]:checked").val();
            let likes = $("input[name=likes]:checked").val();
            let eats = $("input[name=eats]:checked").val();
            let petName = $("input[name=petName]:contains()").val();
            let pet = "ERROR";
            let output = "";

            if (feels == "fluffy" && likes =="petted" && eats=="carrots"){
              pet = "rabbit";
            }

            if (feels == "scaly" && likes =="ridden" && eats=="pets"){
              pet = "velociraptor";
            }

            if(feels=="fluffy" && likes== "ridden" && eats=="pets"){
              pet ="greyhound";
            }
            if(feels=="fluffy" && likes== "petted" && eats=="pets"){
              pet ="pom";
            }
            if(feels=="fluffy" && likes== "ridden" && eats=="carrots"){
              pet ="hedgehog";
            }
            if(feels=="scaly" && likes== "ridden" && eats=="pets"){
              pet ="pig";
            }
            if(feels=="scaly" && likes== "petted" && eats=="pets"){
              pet ="lab";
            }
            if(feels=="scaly" && likes== "ridden" && eats=="carrots"){
              pet ="bird";
            }
            if(feels=="scaly" && likes== "petted" && eats=="carrots"){
              pet ="dane";
            }

            // titleCase is applied to pet name when user make an input

            petName = titleCase(petName);

            output += `<p>Congrats, you have a ${pet} as a pet.Your pet's name is <span class="petName">${petName}</span>. ${petName} feels ${feels} and likes to be ${likes}.He loves all kinds of food that a ${pet} eats, especially ${eats}</p> 
            <p>Take good care of your pet!</p>`

            output += `<p>Your pet is a ${pet}.</p>`;
            output += `<p>Your pet feels ${feels}.</p>`;
            output += `<p>Your pet likes to be ${likes}.</p>`;
            output += `<p>Your pet likes to eat ${eats}.</p>`;
            //alert(feels);
            //output submitted info and replace form
            $.get( "includes/get_pet.php", { critter: pet} )
            .done(function( data ) {



              $('#output').html(data + output);
            
                })
                .fail(function(xhr, status, error) {
               //Ajax request failed.
               var errorMessage = xhr.status + ': ' + xhr.statusText
               alert('Error - ' + errorMessage);
            });


            


        });

    });

   </script>
</body>
</html>
