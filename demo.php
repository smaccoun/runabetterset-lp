<!doctype html>
<html lang="en">

    <head>
        
        <?php require_once('assets/parts/head.php'); ?>

    </head>
    
    <body>
        
        <?php require_once('assets/parts/nav.php'); ?>
        
        <article class="sign-up content">
            <section>
                <h5>What Are Your Set's Needs?</h5>
                <p>See How Powerful Wrapid Can Be With a Free Demo!</p>
                <div id="contact_form">
                    <div id="contact_results"></div>
                    <div id="contact_body">
                        <div class="form-name"><input type="text" name="name" placeholder="Name" required="true"></div>

                        <div class="form-iama"><input type="text" name="iama" placeholder="I am a" required="true"></div>

                        <input type="email" name="email" placeholder="Email" required="true">
                        <input type="text" name="phone2" placeholder="Phone Number" required="true">
                        <textarea name="message" placeholder="Few words about you..." required="true"></textarea>

                        <input type="submit" id="submit_btn" value="Sign Up" class="submit-form" />
                    </div>
                </div>
            </section>
        </article>
    
        
        <?php require_once('assets/parts/footer.php'); ?>
        
    
    </body>
</html>