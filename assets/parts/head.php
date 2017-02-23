<meta charset="utf-8">
        <title>RunaBetterSet - Better Than a PA in Everyone's Pocket</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        
        <!-- CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        
        <!-- FONT -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet">
        <link rel="stylesheet" href="assets/font/FontAwesome/font-awesome.css">

        <!-- Favicon -->
        <link rel="apple-touch-icon-precomposed" sizes="57x57" href="assets/img/favicon/apple-touch-icon-57x57.png" />
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/img/favicon/apple-touch-icon-114x114.png" />
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/img/favicon/apple-touch-icon-72x72.png" />
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/img/favicon/apple-touch-icon-144x144.png" />
        <link rel="apple-touch-icon-precomposed" sizes="60x60" href="assets/img/favicon/apple-touch-icon-60x60.png" />
        <link rel="apple-touch-icon-precomposed" sizes="120x120" href="assets/img/favicon/apple-touch-icon-120x120.png" />
        <link rel="apple-touch-icon-precomposed" sizes="76x76" href="assets/img/favicon/apple-touch-icon-76x76.png" />
        <link rel="apple-touch-icon-precomposed" sizes="152x152" href="assets/img/favicon/apple-touch-icon-152x152.png" />
        <link rel="icon" type="image/png" href="assets/img/favicon/favicon-196x196.png" sizes="196x196" />
        <link rel="icon" type="image/png" href="assets/img/favicon/favicon-96x96.png" sizes="96x96" />
        <link rel="icon" type="image/png" href="assets/img/favicon/favicon-32x32.png" sizes="32x32" />
        <link rel="icon" type="image/png" href="assets/img/favicon/favicon-16x16.png" sizes="16x16" />
        <link rel="icon" type="image/png" href="assets/img/favicon/favicon-128.png" sizes="128x128" />
        <meta name="application-name" content="&nbsp;"/>
        <meta name="msapplication-TileColor" content="#FFFFFF" />
        <meta name="msapplication-TileImage" content="assets/img/favicon/mstile-144x144.png" />
        <meta name="msapplication-square70x70logo" content="assets/img/favicon/mstile-70x70.png" />
        <meta name="msapplication-square150x150logo" content="assets/img/favicon/mstile-150x150.png" />
        <meta name="msapplication-wide310x150logo" content="assets/img/favicon/mstile-310x150.png" />
        <meta name="msapplication-square310x310logo" content="assets/img/favicon/mstile-310x310.png" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

        <!-- FACEBOOK SHARE -->
        <meta property="fb:app_id" content=""/>
        <meta property="og:title" content="RunaBetterSet - Better Than a PA in Everyone's Pocket" />
        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="RunaBetterSet" />
        <meta property="og:description" content="Wrapid Instantly Manages Any Number of Extras" />
        <meta property="og:url" content="http://www.runabetterset.com/" />
        <meta property="og:image" content="http://www.runabetterset.com/assets/img/facebook-image.jpg" />

        <script type="text/javascript">
        $(document).ready(function() {
            $("#submit_btn").click(function() { 

                var proceed = true;
                //simple validation at client's end
                //loop through each field and we simply change border color to red for invalid fields		
                $("#contact_form input[required=true], #contact_form textarea[required=true]").each(function(){
                    $(this).css('border-color',''); 
                    if(!$.trim($(this).val())){ //if this field is empty 
                        $(this).css('border-color','red'); //change border color to red   
                        proceed = false; //set do not proceed flag
                    }
                    //check invalid email
                    var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/; 
                    if($(this).attr("type")=="email" && !email_reg.test($.trim($(this).val()))){
                        $(this).css('border-color','red'); //change border color to red   
                        proceed = false; //set do not proceed flag				
                    }	
                });

                if(proceed) //everything looks good! proceed...
                {
                    //get input field values data to be sent to server
                    post_data = {
                        'user_name'		: $('input[name=name]').val(), 
                        'user_email'	: $('input[name=email]').val(), 
                        'i_am_a'	    : $('input[name=iama]').val(),
                        'phone_number'	: $('input[name=phone2]').val(), 
                        'subject'		: $('select[name=subject]').val(), 
                        'msg'			: $('textarea[name=message]').val()
                    };

                    //Ajax post data to server
                    $.post('contact_me.php', post_data, function(response){  
                        if(response.type == 'error'){ //load json data from server and output message     
                            output = '<div class="error">'+response.text+'</div>';
                        }else{
                            output = '<div class="success">'+response.text+'</div>';
                            //reset values in all input fields
                            $("#contact_form  input[required=true], #contact_form textarea[required=true]").val(''); 
                            $("#contact_form #contact_body").slideUp(); //hide form after success
                        }
                        $("#contact_form #contact_results").hide().html(output).slideDown();
                    }, 'json');
                }
            });

            //reset previously set border colors and hide all message on .keyup()
            $("#contact_form  input[required=true], #contact_form textarea[required=true]").keyup(function() { 
                $(this).css('border-color',''); 
                $("#result").slideUp();
            });
        });
        </script>